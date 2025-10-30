<?php
/**
 * Product Categories API
 * GET /api/products/categories.php - Get all active categories
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

require_once __DIR__ . '/../../config/database.php';

try {
    $db = Database::getInstance()->getConnection();
    
    $stmt = $db->prepare("
        SELECT 
            c.*,
            COUNT(p.id) as product_count
        FROM product_categories c
        LEFT JOIN products p ON c.id = p.category_id AND p.is_active = 1
        WHERE c.is_active = 1
        GROUP BY c.id
        ORDER BY c.display_order, c.name
    ");
    $stmt->execute();
    $categories = $stmt->fetchAll();
    
    echo json_encode(['success' => true, 'categories' => $categories]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);
}
?>

