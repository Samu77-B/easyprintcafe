<?php
/**
 * Products Database Migration
 * Run this file ONCE to create product tables
 */

require_once __DIR__ . '/database.php';

function createProductTables() {
    $db = Database::getInstance()->getConnection();
    
    echo "Creating product tables...\n";
    
    // 1. Product Categories Table
    $sql = "CREATE TABLE IF NOT EXISTS product_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) UNIQUE NOT NULL,
        description TEXT,
        parent_id INT NULL,
        display_order INT DEFAULT 0,
        is_active BOOLEAN DEFAULT TRUE,
        image_url VARCHAR(500),
        meta_title VARCHAR(255),
        meta_description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (parent_id) REFERENCES product_categories(id) ON DELETE SET NULL,
        INDEX idx_slug (slug),
        INDEX idx_parent (parent_id),
        INDEX idx_active (is_active)
    )";
    $db->exec($sql);
    echo "✓ Created product_categories table\n";
    
    // 2. Products Table
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT NOT NULL,
        name VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        short_description TEXT,
        full_description TEXT,
        features TEXT,
        specifications TEXT,
        
        -- Pricing
        base_price DECIMAL(10,2) NULL,
        price_note VARCHAR(255) DEFAULT 'Get a Quote',
        show_price BOOLEAN DEFAULT FALSE,
        
        -- Images
        main_image VARCHAR(500),
        gallery_images TEXT,
        
        -- Product details
        turnaround_time VARCHAR(100),
        material_type VARCHAR(100),
        print_type VARCHAR(100),
        weather_resistant BOOLEAN DEFAULT FALSE,
        
        -- SEO
        meta_title VARCHAR(255),
        meta_description TEXT,
        meta_keywords TEXT,
        
        -- Status
        is_active BOOLEAN DEFAULT TRUE,
        is_featured BOOLEAN DEFAULT FALSE,
        display_order INT DEFAULT 0,
        
        -- Tracking
        view_count INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        
        FOREIGN KEY (category_id) REFERENCES product_categories(id) ON DELETE RESTRICT,
        INDEX idx_slug (slug),
        INDEX idx_category (category_id),
        INDEX idx_active (is_active),
        INDEX idx_featured (is_featured),
        FULLTEXT INDEX idx_search (name, short_description, full_description, features)
    )";
    $db->exec($sql);
    echo "✓ Created products table\n";
    
    // 3. Product Sizes/Options Table
    $sql = "CREATE TABLE IF NOT EXISTS product_options (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        option_type VARCHAR(50) NOT NULL,
        option_name VARCHAR(100) NOT NULL,
        price_modifier DECIMAL(10,2) DEFAULT 0,
        is_default BOOLEAN DEFAULT FALSE,
        display_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        INDEX idx_product (product_id)
    )";
    $db->exec($sql);
    echo "✓ Created product_options table\n";
    
    // 4. Product Tags Table
    $sql = "CREATE TABLE IF NOT EXISTS product_tags (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL UNIQUE,
        slug VARCHAR(50) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $db->exec($sql);
    echo "✓ Created product_tags table\n";
    
    // 5. Product-Tag Relationship Table
    $sql = "CREATE TABLE IF NOT EXISTS product_tag_relations (
        product_id INT NOT NULL,
        tag_id INT NOT NULL,
        PRIMARY KEY (product_id, tag_id),
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        FOREIGN KEY (tag_id) REFERENCES product_tags(id) ON DELETE CASCADE
    )";
    $db->exec($sql);
    echo "✓ Created product_tag_relations table\n";
    
    // 6. Product Related Items Table
    $sql = "CREATE TABLE IF NOT EXISTS product_related (
        product_id INT NOT NULL,
        related_product_id INT NOT NULL,
        PRIMARY KEY (product_id, related_product_id),
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        FOREIGN KEY (related_product_id) REFERENCES products(id) ON DELETE CASCADE
    )";
    $db->exec($sql);
    echo "✓ Created product_related table\n";
    
    echo "\n✅ All product tables created successfully!\n";
}

// Run the migration
try {
    createProductTables();
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>

