<?php
/**
 * Product API - Get Products
 * Endpoints:
 * - GET /api/products/get.php?slug=product-slug (single product)
 * - GET /api/products/get.php?category=category-slug (products by category)
 * - GET /api/products/get.php?featured=1 (featured products)
 * - GET /api/products/get.php (all active products)
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

require_once __DIR__ . '/../../config/database.php';

try {
    $db = Database::getInstance()->getConnection();
    
    // Get single product by slug
    if (isset($_GET['slug'])) {
        $slug = $_GET['slug'];
        
        $stmt = $db->prepare("
            SELECT 
                p.*,
                c.name as category_name,
                c.slug as category_slug
            FROM products p
            LEFT JOIN product_categories c ON p.category_id = c.id
            WHERE p.slug = ? AND p.is_active = 1
        ");
        $stmt->execute([$slug]);
        $product = $stmt->fetch();
        
        if (!$product) {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
            exit;
        }
        
        // Increment view count
        $updateStmt = $db->prepare("UPDATE products SET view_count = view_count + 1 WHERE id = ?");
        $updateStmt->execute([$product['id']]);
        
        // Get product options
        $optionsStmt = $db->prepare("
            SELECT * FROM product_options 
            WHERE product_id = ? 
            ORDER BY display_order, option_type
        ");
        $optionsStmt->execute([$product['id']]);
        $product['options'] = $optionsStmt->fetchAll();
        
        // Get related products
        $relatedStmt = $db->prepare("
            SELECT p.id, p.name, p.slug, p.short_description, p.main_image
            FROM product_related pr
            JOIN products p ON pr.related_product_id = p.id
            WHERE pr.product_id = ? AND p.is_active = 1
            LIMIT 4
        ");
        $relatedStmt->execute([$product['id']]);
        $product['related_products'] = $relatedStmt->fetchAll();
        
        echo json_encode(['success' => true, 'product' => $product]);
        
    }
    // Get products by category
    elseif (isset($_GET['category'])) {
        $categorySlug = $_GET['category'];
        
        $stmt = $db->prepare("
            SELECT 
                p.id, p.name, p.slug, p.short_description, p.main_image, 
                p.base_price, p.price_note, p.show_price, p.is_featured,
                c.name as category_name
            FROM products p
            JOIN product_categories c ON p.category_id = c.id
            WHERE c.slug = ? AND p.is_active = 1
            ORDER BY p.display_order, p.name
        ");
        $stmt->execute([$categorySlug]);
        $products = $stmt->fetchAll();
        
        echo json_encode(['success' => true, 'products' => $products]);
        
    }
    // Get featured products
    elseif (isset($_GET['featured'])) {
        $stmt = $db->prepare("
            SELECT 
                p.id, p.name, p.slug, p.short_description, p.main_image,
                p.base_price, p.price_note, p.show_price,
                c.name as category_name
            FROM products p
            JOIN product_categories c ON p.category_id = c.id
            WHERE p.is_featured = 1 AND p.is_active = 1
            ORDER BY p.display_order, p.name
            LIMIT 8
        ");
        $stmt->execute();
        $products = $stmt->fetchAll();
        
        echo json_encode(['success' => true, 'products' => $products]);
        
    }
    // Get all active products
    else {
        $stmt = $db->prepare("
            SELECT 
                p.id, p.name, p.slug, p.short_description, p.main_image,
                p.base_price, p.price_note, p.show_price, p.is_featured,
                c.name as category_name, c.slug as category_slug
            FROM products p
            JOIN product_categories c ON p.category_id = c.id
            WHERE p.is_active = 1
            ORDER BY p.is_featured DESC, c.display_order, p.display_order, p.name
        ");
        $stmt->execute();
        $products = $stmt->fetchAll();
        
        echo json_encode(['success' => true, 'products' => $products]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);
}
?>

