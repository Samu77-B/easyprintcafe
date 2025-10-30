<?php
/**
 * File Download API Endpoint
 * Handles secure file downloads for user artwork
 */

require_once __DIR__ . '/../../includes/auth.php';

try {
    // Check authentication
    $auth = new Auth();
    $user = $auth->requireAuth();
    
    // Get file ID from query parameter
    $fileId = sanitizeInput($_GET['id'] ?? '');
    
    if (empty($fileId) || !is_numeric($fileId)) {
        http_response_code(400);
        echo json_encode(['error' => 'Valid file ID is required']);
        exit;
    }
    
    $db = Database::getInstance()->getConnection();
    
    // Get file details
    $stmt = $db->prepare("
        SELECT id, original_filename, file_path, file_size, file_type, upload_date, expires_at
        FROM user_files
        WHERE id = ? AND user_id = ? AND is_deleted = FALSE
    ");
    $stmt->execute([$fileId, $user['id']]);
    $file = $stmt->fetch();
    
    if (!$file) {
        http_response_code(404);
        echo json_encode(['error' => 'File not found']);
        exit;
    }
    
    // Check if file has expired
    if (strtotime($file['expires_at']) < time()) {
        http_response_code(410);
        echo json_encode(['error' => 'File has expired']);
        exit;
    }
    
    // Check if file exists on disk
    $fullPath = __DIR__ . '/../../uploads/' . $file['file_path'];
    if (!file_exists($fullPath)) {
        http_response_code(404);
        echo json_encode(['error' => 'File not found on server']);
        exit;
    }
    
    // Set headers for file download
    header('Content-Type: ' . $file['file_type']);
    header('Content-Disposition: attachment; filename="' . $file['original_filename'] . '"');
    header('Content-Length: ' . $file['file_size']);
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    
    // Output file
    readfile($fullPath);
    
} catch (Exception $e) {
    error_log("File download error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Failed to download file']);
}
?>
