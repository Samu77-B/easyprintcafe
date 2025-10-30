<?php
/**
 * Login API Endpoint
 * Handles user authentication and session creation
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Start session for CSRF protection
session_start();

require_once __DIR__ . '/../../includes/auth.php';

try {
    // Get POST data
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;
    
    // Validate required fields
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required']);
        exit;
    }
    
    // Validate email format
    if (!validateEmail($email)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }
    
    // Initialize auth system
    $auth = new Auth();
    
    // Attempt login
    $result = $auth->login($email, $password);
    
    if ($result['success']) {
        // Set longer session timeout if remember me is checked
        if ($remember) {
            $sessionToken = $_COOKIE['session_token'] ?? '';
            if ($sessionToken) {
                // Extend session to 30 days
                $expiresAt = date('Y-m-d H:i:s', time() + (30 * 24 * 60 * 60));
                $db = Database::getInstance()->getConnection();
                $stmt = $db->prepare("UPDATE user_sessions SET expires_at = ? WHERE session_token = ?");
                $stmt->execute([$expiresAt, $sessionToken]);
                
                // Update cookie expiration
                setcookie('session_token', $sessionToken, time() + (30 * 24 * 60 * 60), '/', '', true, true);
            }
        }
    }
    
    echo json_encode($result);
    
} catch (Exception $e) {
    error_log("Login API error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred during login']);
}
?>
