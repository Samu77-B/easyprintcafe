<?php
/**
 * Authentication System for EasyPrintCafe
 * Handles user authentication, sessions, and security
 */

require_once __DIR__ . '/../config/database.php';

class Auth {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Generate a secure random token
     */
    private function generateToken($length = 32) {
        return bin2hex(random_bytes($length));
    }
    
    /**
     * Hash password securely
     */
    private function hashPassword($password) {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536, // 64 MB
            'time_cost' => 4,       // 4 iterations
            'threads' => 3          // 3 threads
        ]);
    }
    
    /**
     * Verify password
     */
    private function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    /**
     * Check if user is locked due to failed login attempts
     */
    private function isUserLocked($email) {
        $stmt = $this->db->prepare("SELECT login_attempts, locked_until FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user) return false;
        
        if ($user['locked_until'] && strtotime($user['locked_until']) > time()) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Increment login attempts
     */
    private function incrementLoginAttempts($email) {
        $stmt = $this->db->prepare("
            UPDATE users 
            SET login_attempts = login_attempts + 1,
                locked_until = CASE 
                    WHEN login_attempts >= ? THEN DATE_ADD(NOW(), INTERVAL ? SECOND)
                    ELSE locked_until
                END
            WHERE email = ?
        ");
        $stmt->execute([MAX_LOGIN_ATTEMPTS - 1, LOGIN_LOCKOUT_TIME, $email]);
    }
    
    /**
     * Reset login attempts
     */
    private function resetLoginAttempts($email) {
        $stmt = $this->db->prepare("UPDATE users SET login_attempts = 0, locked_until = NULL WHERE email = ?");
        $stmt->execute([$email]);
    }
    
    /**
     * Create user session
     */
    private function createSession($userId) {
        $sessionToken = $this->generateToken(64);
        $expiresAt = date('Y-m-d H:i:s', time() + SESSION_TIMEOUT);
        
        $stmt = $this->db->prepare("
            INSERT INTO user_sessions (user_id, session_token, expires_at, ip_address, user_agent)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $userId,
            $sessionToken,
            $expiresAt,
            $_SERVER['REMOTE_ADDR'] ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
        
        return $sessionToken;
    }
    
    /**
     * Clean expired sessions
     */
    private function cleanExpiredSessions() {
        $stmt = $this->db->prepare("DELETE FROM user_sessions WHERE expires_at < NOW()");
        $stmt->execute();
    }
    
    /**
     * Validate invitation token
     */
    public function validateInvitationToken($token) {
        $stmt = $this->db->prepare("
            SELECT id, email, invitation_expires 
            FROM users 
            WHERE invitation_token = ? AND is_active = TRUE
        ");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        
        if (!$user || strtotime($user['invitation_expires']) < time()) {
            return false;
        }
        
        return $user;
    }
    
    /**
     * Sign up user with invitation token
     */
    public function signup($invitationToken, $password, $firstName, $lastName, $phone = null) {
        try {
            // Validate invitation token
            $user = $this->validateInvitationToken($invitationToken);
            if (!$user) {
                return ['success' => false, 'message' => 'Invalid or expired invitation token'];
            }
            
            // Validate password strength
            if (strlen($password) < 8) {
                return ['success' => false, 'message' => 'Password must be at least 8 characters long'];
            }
            
            // Hash password
            $passwordHash = $this->hashPassword($password);
            
            // Update user with password and personal info
            $stmt = $this->db->prepare("
                UPDATE users 
                SET password_hash = ?, 
                    first_name = ?, 
                    last_name = ?, 
                    phone = ?,
                    is_verified = TRUE,
                    invitation_token = NULL,
                    invitation_expires = NULL
                WHERE id = ?
            ");
            $stmt->execute([$passwordHash, $firstName, $lastName, $phone, $user['id']]);
            
            return ['success' => true, 'message' => 'Account created successfully'];
            
        } catch (Exception $e) {
            error_log("Signup error: " . $e->getMessage());
            return ['success' => false, 'message' => 'An error occurred during signup'];
        }
    }
    
    /**
     * Login user
     */
    public function login($email, $password) {
        try {
            // Clean expired sessions first
            $this->cleanExpiredSessions();
            
            // Check if user is locked
            if ($this->isUserLocked($email)) {
                return ['success' => false, 'message' => 'Account temporarily locked due to multiple failed login attempts'];
            }
            
            // Get user data
            $stmt = $this->db->prepare("
                SELECT id, email, password_hash, first_name, last_name, is_active, is_verified
                FROM users 
                WHERE email = ?
            ");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if (!$user) {
                return ['success' => false, 'message' => 'Invalid email or password'];
            }
            
            if (!$user['is_active']) {
                return ['success' => false, 'message' => 'Account is deactivated'];
            }
            
            if (!$user['is_verified']) {
                return ['success' => false, 'message' => 'Account not verified'];
            }
            
            // Verify password
            if (!$this->verifyPassword($password, $user['password_hash'])) {
                $this->incrementLoginAttempts($email);
                return ['success' => false, 'message' => 'Invalid email or password'];
            }
            
            // Reset login attempts on successful login
            $this->resetLoginAttempts($email);
            
            // Create session
            $sessionToken = $this->createSession($user['id']);
            
            // Update last login
            $stmt = $this->db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);
            
            // Set session cookie
            setcookie('session_token', $sessionToken, time() + SESSION_TIMEOUT, '/', '', true, true);
            
            return [
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name']
                ]
            ];
            
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return ['success' => false, 'message' => 'An error occurred during login'];
        }
    }
    
    /**
     * Logout user
     */
    public function logout() {
        if (isset($_COOKIE['session_token'])) {
            $stmt = $this->db->prepare("DELETE FROM user_sessions WHERE session_token = ?");
            $stmt->execute([$_COOKIE['session_token']]);
        }
        
        setcookie('session_token', '', time() - 3600, '/', '', true, true);
        session_destroy();
    }
    
    /**
     * Check if user is authenticated
     */
    public function isAuthenticated() {
        if (!isset($_COOKIE['session_token'])) {
            return false;
        }
        
        $stmt = $this->db->prepare("
            SELECT u.id, u.email, u.first_name, u.last_name, u.company_name, u.phone
            FROM users u
            JOIN user_sessions s ON u.id = s.user_id
            WHERE s.session_token = ? AND s.expires_at > NOW() AND u.is_active = TRUE
        ");
        $stmt->execute([$_COOKIE['session_token']]);
        $user = $stmt->fetch();
        
        return $user ? $user : false;
    }
    
    /**
     * Require authentication for page access
     */
    public function requireAuth() {
        $user = $this->isAuthenticated();
        if (!$user) {
            header('Location: /login.html');
            exit;
        }
        return $user;
    }
    
    /**
     * Send invitation email (placeholder - implement with your email service)
     */
    public function sendInvitation($email, $companyName = null) {
        try {
            // Generate invitation token
            $invitationToken = $this->generateToken();
            $expiresAt = date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60)); // 7 days
            
            // Check if user already exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'User already exists'];
            }
            
            // Create user record with invitation token
            $stmt = $this->db->prepare("
                INSERT INTO users (email, invitation_token, invitation_expires, company_name, created_at)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->execute([$email, $invitationToken, $expiresAt, $companyName]);
            
            // Send invitation email (implement with your email service)
            $invitationLink = "https://yourdomain.com/signup.html?token=" . $invitationToken;
            
            // TODO: Implement actual email sending
            // For now, log the invitation link
            error_log("Invitation sent to {$email}: {$invitationLink}");
            
            return ['success' => true, 'message' => 'Invitation sent successfully', 'link' => $invitationLink];
            
        } catch (Exception $e) {
            error_log("Send invitation error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Failed to send invitation'];
        }
    }
    
    /**
     * Clean expired files (artwork)
     */
    public function cleanExpiredFiles() {
        $stmt = $this->db->prepare("
            UPDATE user_files 
            SET is_deleted = TRUE 
            WHERE expires_at < NOW() AND is_deleted = FALSE
        ");
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}

// Security helper functions
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validatePassword($password) {
    // At least 8 characters, 1 uppercase, 1 lowercase, 1 number
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/', $password);
}

function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>
