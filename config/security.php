<?php
/**
 * Security Configuration and Functions
 * Implements security measures for the EasyPrintCafe application
 */

// Security headers
function setSecurityHeaders() {
    // Prevent clickjacking
    header('X-Frame-Options: DENY');
    
    // Prevent MIME type sniffing
    header('X-Content-Type-Options: nosniff');
    
    // Enable XSS protection
    header('X-XSS-Protection: 1; mode=block');
    
    // Strict Transport Security (HTTPS only)
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
    
    // Referrer Policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // Content Security Policy
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self'; frame-ancestors 'none';");
}

// Rate limiting
class RateLimiter {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function checkRateLimit($identifier, $action, $limit, $window) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as attempts
            FROM rate_limits
            WHERE identifier = ? AND action = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? SECOND)
        ");
        $stmt->execute([$identifier, $action, $window]);
        $result = $stmt->fetch();
        
        return $result['attempts'] < $limit;
    }
    
    public function recordAttempt($identifier, $action) {
        $stmt = $this->db->prepare("
            INSERT INTO rate_limits (identifier, action, ip_address, created_at)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$identifier, $action, $_SERVER['REMOTE_ADDR'] ?? '']);
    }
    
    public function cleanupOldRecords() {
        $stmt = $this->db->prepare("
            DELETE FROM rate_limits
            WHERE created_at < DATE_SUB(NOW(), INTERVAL 1 HOUR)
        ");
        $stmt->execute();
    }
}

// Input validation
class InputValidator {
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public static function validatePassword($password) {
        // At least 8 characters, 1 uppercase, 1 lowercase, 1 number
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/', $password);
    }
    
    public static function validatePhone($phone) {
        return preg_match('/^[\+]?[0-9\s\-\(\)]{10,}$/', $phone);
    }
    
    public static function sanitizeString($input, $maxLength = 255) {
        $input = trim($input);
        $input = substr($input, 0, $maxLength);
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    
    public static function validateFileUpload($file) {
        $errors = [];
        
        // Check if file was uploaded
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'No file uploaded or upload error';
            return $errors;
        }
        
        // Check file size (50MB max)
        $maxSize = 50 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            $errors[] = 'File size too large. Maximum size is 50MB.';
        }
        
        // Check file type
        $allowedTypes = [
            'image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff',
            'application/pdf', 'application/postscript',
            'application/vnd.adobe.illustrator',
            'application/vnd.corel-draw',
            'application/vnd.ms-publisher',
            'application/vnd.oasis.opendocument.graphics',
            'application/x-photoshop'
        ];
        
        if (!in_array($file['type'], $allowedTypes)) {
            $errors[] = 'File type not allowed.';
        }
        
        // Check file extension
        $allowedExtensions = [
            'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif',
            'pdf', 'eps', 'ai', 'cdr', 'pub', 'odg', 'psd'
        ];
        
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions)) {
            $errors[] = 'File extension not allowed.';
        }
        
        // Check for malicious files
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mimeType, $allowedTypes)) {
            $errors[] = 'Invalid file type detected.';
        }
        
        return $errors;
    }
}

// CSRF Protection
class CSRFProtection {
    public static function generateToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    public static function validateToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    public static function getTokenField() {
        return '<input type="hidden" name="csrf_token" value="' . self::generateToken() . '">';
    }
}

// Security logging
class SecurityLogger {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function logSecurityEvent($event, $details = '', $severity = 'info') {
        $stmt = $this->db->prepare("
            INSERT INTO security_logs (event, details, severity, ip_address, user_agent, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $event,
            $details,
            $severity,
            $_SERVER['REMOTE_ADDR'] ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
    }
    
    public function logFailedLogin($email, $reason) {
        $this->logSecurityEvent('failed_login', "Email: $email, Reason: $reason", 'warning');
    }
    
    public function logSuccessfulLogin($email) {
        $this->logSecurityEvent('successful_login', "Email: $email", 'info');
    }
    
    public function logFileUpload($filename, $filesize, $success) {
        $this->logSecurityEvent('file_upload', "File: $filename, Size: $filesize, Success: $success", $success ? 'info' : 'warning');
    }
    
    public function logRateLimitExceeded($identifier, $action) {
        $this->logSecurityEvent('rate_limit_exceeded', "Identifier: $identifier, Action: $action", 'warning');
    }
}

// Initialize security tables
function initializeSecurityTables() {
    $db = Database::getInstance()->getConnection();
    
    // Rate limits table
    $sql = "CREATE TABLE IF NOT EXISTS rate_limits (
        id INT AUTO_INCREMENT PRIMARY KEY,
        identifier VARCHAR(255) NOT NULL,
        action VARCHAR(100) NOT NULL,
        ip_address VARCHAR(45),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_identifier_action (identifier, action),
        INDEX idx_created_at (created_at)
    )";
    $db->exec($sql);
    
    // Security logs table
    $sql = "CREATE TABLE IF NOT EXISTS security_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        event VARCHAR(100) NOT NULL,
        details TEXT,
        severity ENUM('info', 'warning', 'error', 'critical') DEFAULT 'info',
        ip_address VARCHAR(45),
        user_agent TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_event (event),
        INDEX idx_severity (severity),
        INDEX idx_created_at (created_at)
    )";
    $db->exec($sql);
}

// Initialize security tables on load
initializeSecurityTables();

// Set security headers
setSecurityHeaders();
?>
