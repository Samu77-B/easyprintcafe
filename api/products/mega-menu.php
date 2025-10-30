<?php
/**
 * Mega Menu Products API
 * Returns products organized for the mega menu dropdown
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../../config/database.php';

try {
    $db = Database::getInstance()->getConnection();
    
    // Get Large Format products (limit to 8 for menu)
    $largeFormatStmt = $db->prepare("
        SELECT p.name, p.slug
        FROM products p
        JOIN product_categories c ON p.category_id = c.id
        WHERE (c.slug = 'flags-banners' OR c.slug = 'exhibition-displays' OR c.slug = 'outdoor-signage')
        AND p.is_active = 1
        ORDER BY p.is_featured DESC, p.display_order, p.name
        LIMIT 8
    ");
    $largeFormatStmt->execute();
    $largeFormat = $largeFormatStmt->fetchAll();
    
    // Get Small Format products (limit to 8 for menu)
    $smallFormatStmt = $db->prepare("
        SELECT p.name, p.slug
        FROM products p
        JOIN product_categories c ON p.category_id = c.id
        WHERE c.slug = 'small-format'
        AND p.is_active = 1
        ORDER BY p.is_featured DESC, p.display_order, p.name
        LIMIT 8
    ");
    $smallFormatStmt->execute();
    $smallFormat = $smallFormatStmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'largeFormat' => $largeFormat,
        'smallFormat' => $smallFormat
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);
}
?>


