<?php
/**
 * Dashboard Data API Endpoint
 * Returns user dashboard statistics and recent data
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../../includes/auth.php';

try {
    // Check authentication
    $auth = new Auth();
    $user = $auth->requireAuth();
    
    $db = Database::getInstance()->getConnection();
    
    // Get user statistics
    $stats = [];
    
    // Total orders count
    $stmt = $db->prepare("SELECT COUNT(*) as total_orders FROM orders WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $stats['total_orders'] = $stmt->fetch()['total_orders'];
    
    // Total files count
    $stmt = $db->prepare("SELECT COUNT(*) as total_files FROM user_files WHERE user_id = ? AND is_deleted = FALSE");
    $stmt->execute([$user['id']]);
    $stats['total_files'] = $stmt->fetch()['total_files'];
    
    // Total spent
    $stmt = $db->prepare("SELECT SUM(total_amount) as total_spent FROM orders WHERE user_id = ? AND status = 'completed'");
    $stmt->execute([$user['id']]);
    $totalSpent = $stmt->fetch()['total_spent'];
    $stats['total_spent'] = $totalSpent ? '£' . number_format($totalSpent, 2) : '£0';
    
    // Recent orders (last 5)
    $stmt = $db->prepare("
        SELECT o.order_number, o.status, o.total_amount, o.created_at,
               GROUP_CONCAT(oi.product_name SEPARATOR ', ') as product_name
        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        WHERE o.user_id = ?
        GROUP BY o.id
        ORDER BY o.created_at DESC
        LIMIT 5
    ");
    $stmt->execute([$user['id']]);
    $orders = $stmt->fetchAll();
    
    // Recent files (last 5)
    $stmt = $db->prepare("
        SELECT id, original_filename, file_size, file_type, upload_date
        FROM user_files
        WHERE user_id = ? AND is_deleted = FALSE
        ORDER BY upload_date DESC
        LIMIT 5
    ");
    $stmt->execute([$user['id']]);
    $files = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'stats' => $stats,
        'orders' => $orders,
        'files' => $files
    ]);
    
} catch (Exception $e) {
    error_log("Dashboard data error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Failed to load dashboard data'
    ]);
}
?>
