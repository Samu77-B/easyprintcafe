<?php
/**
 * Insert Sample Products
 * Run this AFTER products-migration.php to add sample data
 */

require_once __DIR__ . '/database.php';

function insertSampleData() {
    $db = Database::getInstance()->getConnection();
    
    echo "Inserting sample product data...\n\n";
    
    // 1. Insert Categories
    echo "Adding categories...\n";
    $categories = [
        ['name' => 'Flags & Banners', 'slug' => 'flags-banners', 'description' => 'Eye-catching flags and banners for outdoor advertising'],
        ['name' => 'Exhibition Displays', 'slug' => 'exhibition-displays', 'description' => 'Professional display solutions for events and trade shows'],
        ['name' => 'Outdoor Signage', 'slug' => 'outdoor-signage', 'description' => 'Durable outdoor advertising solutions'],
        ['name' => 'Small Format Printing', 'slug' => 'small-format', 'description' => 'Business cards, flyers, and marketing materials'],
    ];
    
    $stmt = $db->prepare("INSERT INTO product_categories (name, slug, description, display_order) VALUES (?, ?, ?, ?)");
    foreach ($categories as $index => $cat) {
        $stmt->execute([$cat['name'], $cat['slug'], $cat['description'], $index + 1]);
        echo "  ✓ {$cat['name']}\n";
    }
    
    // 2. Insert Sample Products
    echo "\nAdding products...\n";
    
    // Get category IDs
    $flagsId = $db->query("SELECT id FROM product_categories WHERE slug = 'flags-banners'")->fetch()['id'];
    $exhibitionId = $db->query("SELECT id FROM product_categories WHERE slug = 'exhibition-displays'")->fetch()['id'];
    $outdoorId = $db->query("SELECT id FROM product_categories WHERE slug = 'outdoor-signage'")->fetch()['id'];
    $smallFormatId = $db->query("SELECT id FROM product_categories WHERE slug = 'small-format'")->fetch()['id'];
    
    $products = [
        [
            'category_id' => $flagsId,
            'name' => 'Feather Flag',
            'slug' => 'feather-flag',
            'short_description' => 'Eye-catching feather flags perfect for outdoor advertising',
            'full_description' => 'Our feather flags are designed to grab attention with their unique shape and movement. Perfect for outdoor events, retail locations, and exhibitions. Made from durable, weather-resistant materials.',
            'features' => '• UV-resistant printing\n• Durable aluminum pole\n• Ground spike or cross base options\n• Single or double-sided printing\n• Multiple size options',
            'specifications' => 'Material: 115gsm Polyester\nPole: Aluminum 3.5m\nBase: Ground spike included\nPrinting: Dye sublimation',
            'main_image' => './images/products/feather-flag.png',
            'turnaround_time' => '3-5 working days',
            'weather_resistant' => 1,
            'is_featured' => 1
        ],
        [
            'category_id' => $flagsId,
            'name' => 'Teardrop Flag',
            'slug' => 'teardrop-flag',
            'short_description' => 'Professional teardrop banners for maximum visibility',
            'full_description' => 'Teardrop flags offer excellent visibility and professional appearance. The teardrop shape provides maximum print area and stays taut even in light wind.',
            'features' => '• Weather-resistant fabric\n• Rotating mechanism prevents tangling\n• Available in multiple sizes\n• Full-color printing\n• Easy setup',
            'specifications' => 'Material: 115gsm Polyester\nSizes: Small (2.5m), Medium (3.5m), Large (5m)\nBase options: Ground spike, water fillable, cross base',
            'main_image' => './images/products/feather flag.png',
            'turnaround_time' => '3-5 working days',
            'weather_resistant' => 1,
            'is_featured' => 1
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Roller Banner',
            'slug' => 'roller-banner',
            'short_description' => 'Premium pull-up banner stands for professional presentations',
            'full_description' => 'Our roller banners are perfect for exhibitions, conferences, and retail displays. Easy to transport and set up in seconds, these portable displays make a big impact.',
            'features' => '• Premium cassette mechanism\n• Easy pull-up setup\n• Includes carry bag\n• Replaceable graphics\n• Stable base',
            'specifications' => 'Standard size: 800mm x 2000mm\nMaterial: 510gsm PVC\nWeight: 3.5kg\nSetup time: 30 seconds',
            'main_image' => './images/products/RollerBanner.png',
            'turnaround_time' => '2-3 working days',
            'is_featured' => 1
        ],
        [
            'category_id' => $smallFormatId,
            'name' => 'Business Cards',
            'slug' => 'business-cards',
            'short_description' => 'Premium business cards to make a lasting impression',
            'full_description' => 'High-quality business cards printed on premium card stock. Available in various finishes including matt, gloss, and silk.',
            'features' => '• 400gsm premium card\n• Matt, gloss, or silk finish\n• Full-color both sides\n• Standard or custom sizes\n• Fast turnaround',
            'specifications' => 'Size: 85mm x 55mm (standard)\nMaterial: 400gsm Card\nFinish options: Matt laminated, Gloss laminated, Uncoated',
            'main_image' => './images/products/smallformat-bueinsscards.png',
            'base_price' => 25.00,
            'show_price' => 1,
            'price_note' => 'From £25 per 100',
            'turnaround_time' => '1-2 working days'
        ]
    ];
    
    $stmt = $db->prepare("
        INSERT INTO products (
            category_id, name, slug, short_description, full_description, 
            features, specifications, main_image, turnaround_time, 
            weather_resistant, is_featured, base_price, show_price, price_note
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    foreach ($products as $product) {
        $stmt->execute([
            $product['category_id'],
            $product['name'],
            $product['slug'],
            $product['short_description'],
            $product['full_description'],
            $product['features'],
            $product['specifications'],
            $product['main_image'],
            $product['turnaround_time'],
            $product['weather_resistant'] ?? 0,
            $product['is_featured'] ?? 0,
            $product['base_price'] ?? null,
            $product['show_price'] ?? 0,
            $product['price_note'] ?? 'Get a Quote'
        ]);
        echo "  ✓ {$product['name']}\n";
    }
    
    // 3. Insert Product Tags
    echo "\nAdding tags...\n";
    $tags = ['outdoor', 'exhibition', 'portable', 'weather-resistant', 'cafe', 'restaurant'];
    $stmt = $db->prepare("INSERT INTO product_tags (name, slug) VALUES (?, ?)");
    foreach ($tags as $tag) {
        $stmt->execute([$tag, $tag]);
        echo "  ✓ {$tag}\n";
    }
    
    echo "\n✅ Sample data inserted successfully!\n";
    echo "\nYou can now view your products at: /product.php?slug=feather-flag\n";
}

// Run the insertion
try {
    insertSampleData();
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>

