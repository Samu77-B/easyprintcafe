<?php
/**
 * Cleanup Expired Files Script
 * Removes expired artwork files and updates database records
 * Run this script via cron job daily
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

try {
    echo "Starting cleanup of expired files...\n";
    
    $auth = new Auth();
    $db = Database::getInstance()->getConnection();
    
    // Get expired files
    $stmt = $db->prepare("
        SELECT id, file_path, original_filename, upload_date, expires_at
        FROM user_files
        WHERE expires_at < NOW() AND is_deleted = FALSE
    ");
    $stmt->execute();
    $expiredFiles = $stmt->fetchAll();
    
    $deletedCount = 0;
    $errorCount = 0;
    
    foreach ($expiredFiles as $file) {
        try {
            // Delete physical file
            $filePath = __DIR__ . '/../uploads/' . $file['file_path'];
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    echo "Deleted file: " . $file['original_filename'] . "\n";
                } else {
                    echo "Failed to delete file: " . $file['original_filename'] . "\n";
                    $errorCount++;
                    continue;
                }
            }
            
            // Mark as deleted in database
            $updateStmt = $db->prepare("UPDATE user_files SET is_deleted = TRUE WHERE id = ?");
            $updateStmt->execute([$file['id']]);
            
            $deletedCount++;
            
        } catch (Exception $e) {
            echo "Error processing file " . $file['original_filename'] . ": " . $e->getMessage() . "\n";
            $errorCount++;
        }
    }
    
    echo "Cleanup completed.\n";
    echo "Files deleted: $deletedCount\n";
    echo "Errors: $errorCount\n";
    
    // Clean up expired sessions
    $auth->cleanExpiredSessions();
    echo "Expired sessions cleaned up.\n";
    
} catch (Exception $e) {
    echo "Cleanup script error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
