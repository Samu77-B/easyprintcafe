<?php
/**
 * Signup API Endpoint
 * Handles user registration with invitation token validation
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
    $invitationToken = sanitizeInput($_POST['invitation_token'] ?? '');
    $firstName = sanitizeInput($_POST['first_name'] ?? '');
    $lastName = sanitizeInput($_POST['last_name'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validate required fields
    if (empty($invitationToken) || empty($firstName) || empty($lastName) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
        exit;
    }
    
    // Validate password strength
    if (!validatePassword($password)) {
        echo json_encode(['success' => false, 'message' => 'Password does not meet security requirements']);
        exit;
    }
    
    // Validate names (basic validation)
    if (strlen($firstName) < 2 || strlen($lastName) < 2) {
        echo json_encode(['success' => false, 'message' => 'Name must be at least 2 characters long']);
        exit;
    }
    
    // Validate phone if provided
    if (!empty($phone) && !preg_match('/^[\+]?[0-9\s\-\(\)]{10,}$/', $phone)) {
        echo json_encode(['success' => false, 'message' => 'Invalid phone number format']);
        exit;
    }
    
    // Initialize auth system
    $auth = new Auth();
    
    // Attempt signup
    $result = $auth->signup($invitationToken, $password, $firstName, $lastName, $phone);
    
    echo json_encode($result);
    
} catch (Exception $e) {
    error_log("Signup API error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred during signup']);
}
?>
