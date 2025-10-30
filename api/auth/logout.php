<?php
/**
 * Logout API Endpoint
 * Handles user logout and session cleanup
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

require_once __DIR__ . '/../../includes/auth.php';

try {
    // Initialize auth system
    $auth = new Auth();
    
    // Logout user
    $auth->logout();
    
    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
    
} catch (Exception $e) {
    error_log("Logout API error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred during logout']);
}
?>
