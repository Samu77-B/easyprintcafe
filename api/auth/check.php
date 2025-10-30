<?php
/**
 * Authentication Check API Endpoint
 * Verifies if user is authenticated and returns user data
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../../includes/auth.php';

try {
    // Initialize auth system
    $auth = new Auth();
    
    // Check if user is authenticated
    $user = $auth->isAuthenticated();
    
    if ($user) {
        echo json_encode([
            'success' => true,
            'user' => $user
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Not authenticated'
        ]);
    }
    
} catch (Exception $e) {
    error_log("Auth check error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Authentication check failed'
    ]);
}
?>
