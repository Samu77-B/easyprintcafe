<?php
/**
 * File Upload API Endpoint
 * Handles secure file uploads for user artwork with 3-month expiration
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../../includes/auth.php';

try {
    // Check authentication
    $auth = new Auth();
    $user = $auth->requireAuth();
    
    // Check if file was uploaded
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
        exit;
    }
    
    $uploadedFile = $_FILES['file'];
    
    // Validate file
    $validation = validateUploadedFile($uploadedFile);
    if (!$validation['valid']) {
        echo json_encode(['success' => false, 'message' => $validation['message']]);
        exit;
    }
    
    // Generate unique filename
    $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid() . '_' . time() . '.' . $fileExtension;
    $uploadDir = __DIR__ . '/../../uploads/';
    $uploadPath = $uploadDir . $uniqueFilename;
    
    // Create upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Move uploaded file
    if (!move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to save file']);
        exit;
    }
    
    // Calculate expiration date (3 months from now)
    $expiresAt = date('Y-m-d H:i:s', time() + (90 * 24 * 60 * 60));
    
    // Save file record to database
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("
        INSERT INTO user_files (user_id, filename, original_filename, file_path, file_size, file_type, description, expires_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $description = sanitizeInput($_POST['description'] ?? '');
    $stmt->execute([
        $user['id'],
        $uniqueFilename,
        $uploadedFile['name'],
        $uniqueFilename,
        $uploadedFile['size'],
        $uploadedFile['type'],
        $description,
        $expiresAt
    ]);
    
    $fileId = $db->lastInsertId();
    
    echo json_encode([
        'success' => true,
        'message' => 'File uploaded successfully',
        'file_id' => $fileId,
        'filename' => $uploadedFile['name'],
        'expires_at' => $expiresAt
    ]);
    
} catch (Exception $e) {
    error_log("File upload error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred during file upload']);
}

/**
 * Validate uploaded file
 */
function validateUploadedFile($file) {
    // Check file size (max 50MB)
    $maxSize = 50 * 1024 * 1024; // 50MB
    if ($file['size'] > $maxSize) {
        return ['valid' => false, 'message' => 'File size too large. Maximum size is 50MB.'];
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
        return ['valid' => false, 'message' => 'File type not allowed. Please upload images, PDFs, or design files.'];
    }
    
    // Check file extension
    $allowedExtensions = [
        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif',
        'pdf', 'eps', 'ai', 'cdr', 'pub', 'odg', 'psd'
    ];
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions)) {
        return ['valid' => false, 'message' => 'File extension not allowed.'];
    }
    
    // Check for malicious files
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedTypes)) {
        return ['valid' => false, 'message' => 'Invalid file type detected.'];
    }
    
    return ['valid' => true];
}
?>
