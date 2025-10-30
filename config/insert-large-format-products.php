<?php
/**
 * Insert Large Format Products
 * Run this to add all large format printing products
 */

require_once __DIR__ . '/database.php';

function insertLargeFormatProducts() {
    $db = Database::getInstance()->getConnection();
    
    echo "Inserting Large Format Products...\n\n";
    
    // Get category IDs
    $flagsId = $db->query("SELECT id FROM product_categories WHERE slug = 'flags-banners'")->fetch()['id'];
    $exhibitionId = $db->query("SELECT id FROM product_categories WHERE slug = 'exhibition-displays'")->fetch()['id'];
    $outdoorId = $db->query("SELECT id FROM product_categories WHERE slug = 'outdoor-signage'")->fetch()['id'];
    
    echo "Category IDs - Flags: {$flagsId}, Exhibition: {$exhibitionId}, Outdoor: {$outdoorId}\n\n";
    
    $products = [
        // FLAGS & BANNERS
        [
            'category_id' => $flagsId,
            'name' => 'Arch Flag',
            'slug' => 'arch-flag',
            'short_description' => 'Eye-catching arch-shaped flags perfect for outdoor events and promotions',
            'full_description' => 'Our arch flags feature a distinctive curved design that creates maximum visual impact. Perfect for outdoor events, exhibitions, and retail locations. The arch shape provides excellent brand visibility from multiple angles and remains stable even in windy conditions.',
            'features' => '• Unique arch-shaped design\n• UV-resistant printing\n• Durable aluminum frame\n• Weather-resistant fabric\n• Ground spike base included\n• Easy assembly',
            'specifications' => 'Material: 115gsm Polyester\nFrame: Aluminum arch frame\nBase: Ground spike included\nPrinting: Dye sublimation full color\nHeight: 2.5m-4m (various sizes)',
            'main_image' => './images/products/arch-flag.png',
            'turnaround_time' => '3-5 working days',
            'weather_resistant' => 1,
            'is_featured' => 1
        ],
        [
            'category_id' => $flagsId,
            'name' => 'Blade Flag',
            'slug' => 'blade-flag',
            'short_description' => 'Sleek blade-shaped flags with modern angular design',
            'full_description' => 'Blade flags offer a contemporary angular design that stands out at events and retail locations. The sharp, modern profile creates excellent brand visibility and the unique shape makes your brand memorable. Ideal for outdoor advertising and promotional events.',
            'features' => '• Modern blade shape design\n• Full-color printing\n• Rotating mechanism\n• Weather-resistant fabric\n• Multiple size options\n• Ground spike or cross base',
            'specifications' => 'Material: 115gsm Polyester\nFrame: Flexible fiberglass poles\nSizes: Small (2.5m), Medium (3.5m), Large (4.5m)\nBase options: Ground spike, water base, cross base\nPrinting: Full color dye sublimation',
            'main_image' => './images/products/blade flag.png',
            'turnaround_time' => '3-5 working days',
            'weather_resistant' => 1,
            'is_featured' => 0
        ],
        [
            'category_id' => $flagsId,
            'name' => 'Crest Flag',
            'slug' => 'crest-flag',
            'short_description' => 'Professional crest-shaped flags for premium brand presentation',
            'full_description' => 'Our crest flags feature an elegant shield-like design that conveys professionalism and prestige. Perfect for corporate events, golf tournaments, and upscale promotional activities. The distinctive crest shape provides excellent branding opportunities and creates a premium impression.',
            'features' => '• Prestigious crest shape\n• Premium fabric quality\n• UV-resistant printing\n• Stable base system\n• Professional appearance\n• Weather-resistant construction',
            'specifications' => 'Material: 115gsm Polyester\nFrame: Aluminum poles with crest top\nBase: Heavy-duty ground spike or water base\nPrinting: Full color dye sublimation\nHeight: 3.5m-4.5m',
            'main_image' => './images/products/crest flag.png',
            'turnaround_time' => '3-5 working days',
            'weather_resistant' => 1,
            'is_featured' => 1
        ],
        [
            'category_id' => $flagsId,
            'name' => 'Fin Flag',
            'slug' => 'fin-flag',
            'short_description' => 'Unique fin-shaped flags with streamlined modern design',
            'full_description' => 'Fin flags feature a sleek, aerodynamic design that looks modern and professional. The streamlined fin shape reduces wind resistance while maintaining excellent visibility. Perfect for events, retail locations, and outdoor advertising where you want to make a contemporary statement.',
            'features' => '• Streamlined fin design\n• Wind-resistant shape\n• Rotating base mechanism\n• Full-color printing\n• Durable construction\n• Easy setup',
            'specifications' => 'Material: 115gsm Polyester\nFrame: Flexible fiberglass with aluminum base\nSizes: 2.5m, 3.5m, 4.5m\nBase: Ground spike or cross base included\nPrinting: Dye sublimation',
            'main_image' => './images/products/fin flag.png',
            'turnaround_time' => '3-5 working days',
            'weather_resistant' => 1,
            'is_featured' => 0
        ],
        [
            'category_id' => $flagsId,
            'name' => 'Flamingo Economy Flag',
            'slug' => 'flamingo-economy-flag',
            'short_description' => 'Cost-effective flamingo flags without compromising on quality',
            'full_description' => 'Our economy flamingo flags provide excellent value while maintaining professional quality. Perfect for budget-conscious events, pop-up shops, and short-term promotions. The unique flamingo shape offers great visibility at an affordable price point.',
            'features' => '• Budget-friendly option\n• Flamingo-shaped design\n• Quality 110gsm fabric\n• Full-color printing\n• Lightweight frame\n• Easy to transport',
            'specifications' => 'Material: 110gsm Polyester\nFrame: Lightweight fiberglass\nHeight: 2.5m or 3.5m\nBase: Ground spike included\nPrinting: Full color\nWeight: Ultra-lightweight',
            'main_image' => './images/products/flamingo eco flag.png',
            'turnaround_time' => '2-4 working days',
            'weather_resistant' => 1,
            'is_featured' => 0
        ],
        
        // EXHIBITION DISPLAYS
        [
            'category_id' => $exhibitionId,
            'name' => 'Raptor Roller Banner',
            'slug' => 'raptor-roller-banner',
            'short_description' => 'Premium roller banner with ultra-stable base system',
            'full_description' => 'The Raptor roller banner represents the pinnacle of pull-up banner design. Featuring an ultra-stable base, premium cassette mechanism, and superior print quality, it\'s perfect for high-profile exhibitions and corporate events. The Raptor system ensures your graphics stay perfectly taut and professional.',
            'features' => '• Premium Raptor cassette\n• Ultra-stable wide base\n• Twist-out poles\n• Deluxe padded carry bag\n• Replaceable graphics\n• Professional appearance',
            'specifications' => 'Size: 850mm x 2000mm (also available in 1000mm, 1200mm widths)\nMaterial: 510gsm premium PVC\nBase: Extra-wide stable base (450mm)\nWeight: 4.5kg\nSetup time: 30 seconds',
            'main_image' => './images/products/raptor-banner.png',
            'turnaround_time' => '2-3 working days',
            'is_featured' => 1
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'SEG Fabric Free-Standing Lightbox',
            'slug' => 'seg-fabric-lightbox',
            'short_description' => 'Stunning illuminated displays with seamless fabric graphics',
            'full_description' => 'Our SEG (Silicone Edge Graphic) fabric lightboxes create stunning illuminated displays that captivate audiences. The seamless fabric graphics are held taut in aluminum frames with edge-lit LED technology, creating a premium, frameless appearance. Perfect for exhibitions, retail displays, and high-end presentations.',
            'features' => '• LED edge lighting\n• Seamless fabric graphics\n• Tool-free assembly\n• Replaceable graphics\n• Energy-efficient LEDs\n• Premium aluminum frame',
            'specifications' => 'Sizes: Various (custom sizes available)\nFrame: Aluminum with SEG channel\nLighting: LED edge-lit system\nFabric: SEG polyester fabric\nPower: UK plug, low voltage\nGraphics: Easily replaceable',
            'main_image' => './images/products/seg-fabric-lightbox.png',
            'turnaround_time' => '5-7 working days',
            'is_featured' => 1
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Stretch Fabric Walls',
            'slug' => 'stretch-fabric-wall',
            'short_description' => 'Large-format fabric walls for impactful exhibition backdrops',
            'full_description' => 'Create impressive exhibition backdrops with our stretch fabric walls. These large-format fabric displays create seamless, wrinkle-free graphics that transform your exhibition space. The lightweight aluminum frame system makes setup quick and easy, while the printed fabric creates a premium, professional appearance.',
            'features' => '• Seamless fabric graphics\n• Lightweight aluminum frame\n• Tool-free assembly\n• Wrinkle-free appearance\n• Washable fabric\n• Carry bag included',
            'specifications' => 'Sizes: Various modular sizes\nFrame: Aluminum tube frame\nFabric: Stretch polyester fabric\nPrinting: Dye sublimation\nWeight: Lightweight, portable\nSetup: Tool-free, 10-15 minutes',
            'main_image' => './images/products/stretchfabricWallLarge.png',
            'turnaround_time' => '5-7 working days',
            'is_featured' => 1
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Pop-Out Banners',
            'slug' => 'pop-out-banner',
            'short_description' => 'Quick-setup fabric banners with instant pop-up frame',
            'full_description' => 'Pop-out banners offer the fastest setup time of any display system. The spring-loaded frame literally pops into shape in seconds, and the fabric graphic attaches with velcro for a taut, professional finish. Perfect for events, retail spaces, and any situation where quick setup is essential.',
            'features' => '• Instant pop-up frame\n• 30-second setup\n• Lightweight and portable\n• Durable carrying bag\n• Velcro attachment\n• Curved or straight options',
            'specifications' => 'Sizes: Various (curved and straight)\nFrame: Spring-loaded steel\nGraphic: Fabric with velcro attachment\nWeight: 3-5kg depending on size\nStorage: Compact circular bag',
            'main_image' => './images/products/pop-out-banners.png',
            'turnaround_time' => '3-5 working days',
            'is_featured' => 0
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Stretch Fabric Poseur Table',
            'slug' => 'stretch-fabric-poseur-table',
            'short_description' => 'Branded poseur tables with printed stretch fabric covers',
            'full_description' => 'Transform ordinary poseur tables into branded marketing tools with our custom printed stretch fabric covers. These form-fitting covers feature your branding and create a professional, cohesive look at exhibitions and events. The stretch fabric fits snugly and looks crisp and professional.',
            'features' => '• Custom printed fabric cover\n• Form-fitting design\n• Easy to fit and remove\n• Machine washable\n• Wrinkle-resistant\n• Available in multiple sizes',
            'specifications' => 'Fits: Standard poseur tables\nMaterial: Stretch polyester fabric\nPrinting: Full color dye sublimation\nCare: Machine washable\nSizes: Various heights (standard, bar height)\nNote: Table not included, cover only',
            'main_image' => './images/products/poseur-table.png',
            'turnaround_time' => '3-5 working days',
            'is_featured' => 0
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Fabric Exhibition Solutions',
            'slug' => 'fabric-exhibition-banner',
            'short_description' => 'Complete fabric display systems for professional exhibitions',
            'full_description' => 'Our comprehensive fabric exhibition solutions provide everything you need for professional trade show displays. These modular systems combine fabric walls, banners, and accessories to create cohesive, impactful exhibition stands. Easy to transport, quick to assemble, and create a premium impression.',
            'features' => '• Modular design\n• Complete exhibition system\n• Lightweight fabric graphics\n• Tool-free assembly\n• Premium appearance\n• Customizable configurations',
            'specifications' => 'Systems: Various sizes and configurations\nFrame: Aluminum modular frame\nGraphics: Dye sublimation fabric\nTransport: Wheeled cases available\nSetup time: 15-30 minutes\nCustomization: Fully customizable',
            'main_image' => './images/products/fabric-exhibition-banner.png',
            'turnaround_time' => '7-10 working days',
            'is_featured' => 1
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Shell Transformer',
            'slug' => 'shell-transformation',
            'short_description' => 'Versatile modular display system for multiple configurations',
            'full_description' => 'The Shell Transformer is a revolutionary modular display system that adapts to your needs. Create various configurations from banner stands to exhibition walls using the same core components. Perfect for businesses that attend different types of events and need flexibility in their display solutions.',
            'features' => '• Multiple configurations\n• Modular system\n• Interchangeable graphics\n• Versatile usage\n• Tool-free assembly\n• Cost-effective solution',
            'specifications' => 'Configurations: Banner stand, wall, counter, and more\nFrame: Aluminum modular system\nGraphics: Fabric or PVC options\nWeight: Varies by configuration\nTransport: Wheeled case included',
            'main_image' => './images/products/shell transformation.png',
            'turnaround_time' => '5-7 working days',
            'is_featured' => 0
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Stretch Fabric Premium Stands',
            'slug' => 'stretch-fabric-premium-stands',
            'short_description' => 'High-end stretch fabric display stands with premium finish',
            'full_description' => 'Our premium stretch fabric stands represent the highest quality in portable display solutions. Featuring superior fabric quality, robust aluminum frames, and impeccable printing, these stands create an ultra-professional impression at exhibitions and corporate events. The seamless fabric graphics and sturdy construction justify the premium investment.',
            'features' => '• Premium fabric quality\n• Robust aluminum frame\n• Seamless appearance\n• Superior printing\n• Professional finish\n• Durable construction',
            'specifications' => 'Sizes: Various sizes available\nFrame: Premium aluminum construction\nFabric: High-quality stretch polyester\nPrinting: High-resolution dye sublimation\nAccessories: Premium carry bag, lighting options\nWarranty: Extended warranty included',
            'main_image' => './images/products/stretch premium stands.png',
            'turnaround_time' => '5-7 working days',
            'is_featured' => 1
        ],
        [
            'category_id' => $exhibitionId,
            'name' => 'Stretch Fabric Economy Stands',
            'slug' => 'stretch-fabric-economy-stands',
            'short_description' => 'Budget-friendly fabric stands without compromising on appearance',
            'full_description' => 'Our economy stretch fabric stands provide excellent value for budget-conscious exhibitors. While more affordable than our premium range, these stands still deliver professional results with quality fabric graphics and reliable aluminum frames. Perfect for businesses attending multiple events or those needing cost-effective display solutions.',
            'features' => '• Budget-friendly\n• Professional appearance\n• Quality fabric graphics\n• Aluminum frame\n• Easy setup\n• Carry bag included',
            'specifications' => 'Sizes: Standard sizes available\nFrame: Standard aluminum frame\nFabric: Quality stretch polyester\nPrinting: Dye sublimation\nWeight: Lightweight\nSetup: Simple tool-free assembly',
            'main_image' => './images/products/stretch eco stand.png',
            'turnaround_time' => '3-5 working days',
            'is_featured' => 0
        ],
        
        // OUTDOOR SIGNAGE
        [
            'category_id' => $outdoorId,
            'name' => 'Heras Fencing Banners',
            'slug' => 'heras-banner',
            'short_description' => 'Durable PVC banners designed specifically for Heras fencing',
            'full_description' => 'Our Heras fencing banners are specifically designed to fit standard Heras temporary fencing panels. Perfect for construction sites, events, and outdoor venues, these heavy-duty PVC banners withstand harsh weather while promoting your brand. Easy to attach with cable ties or banner clips (supplied separately).',
            'features' => '• Heavy-duty 510gsm PVC\n• Weather-resistant\n• Eyelets every 50cm\n• UV-resistant inks\n• Fits standard Heras panels\n• Wind slots available',
            'specifications' => 'Size: 3450mm x 1730mm (standard Heras size)\nMaterial: 510gsm PVC banner\nEyelets: Rust-proof, every 50cm\nPrinting: UV-resistant eco-solvent inks\nFinishing: Hemmed edges, welded eyelets',
            'main_image' => './images/products/heras-banner.png',
            'turnaround_time' => '2-3 working days',
            'weather_resistant' => 1,
            'is_featured' => 1
        ],
        [
            'category_id' => $outdoorId,
            'name' => 'Crowd Barrier Graphics',
            'slug' => 'crowd-barrier-graphics',
            'short_description' => 'Custom printed banners for crowd control barriers',
            'full_description' => 'Transform crowd control barriers into powerful branding opportunities with our custom printed barrier graphics. These durable banners are designed to fit standard crowd barrier frames, turning functional safety equipment into marketing tools. Ideal for festivals, sporting events, and public gatherings.',
            'features' => '• Custom sizes for any barrier\n• Heavy-duty PVC material\n• Full-color printing\n• Weather-resistant\n• Easy attachment system\n• Reinforced edges',
            'specifications' => 'Sizes: Custom to fit your barriers\nMaterial: 510gsm PVC\nEyelets: Welded brass eyelets\nPrinting: Full color UV-resistant\nAttachment: Cable ties or clips (sold separately)\nDurability: Long-term outdoor use',
            'main_image' => './images/products/crowd-barriers.png',
            'turnaround_time' => '3-5 working days',
            'weather_resistant' => 1,
            'is_featured' => 0
        ]
    ];
    
    $stmt = $db->prepare("
        INSERT INTO products (
            category_id, name, slug, short_description, full_description, 
            features, specifications, main_image, turnaround_time, 
            weather_resistant, is_active, is_featured
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?)
    ");
    
    $count = 0;
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
            $product['is_featured'] ?? 0
        ]);
        $count++;
        echo "  ✓ {$product['name']}\n";
    }
    
    echo "\n✅ Successfully inserted {$count} large format products!\n";
    echo "\nYou now have:\n";
    echo "- Feather Flag (already existed)\n";
    echo "- Teardrop Flag (already existed)\n";
    echo "- Roller Banner (already existed)\n";
    echo "+ {$count} new large format products\n";
    echo "= " . ($count + 3) . " total large format products\n\n";
    
    echo "Example product URLs:\n";
    echo "- https://easyprintcafe.com/build/product.php?slug=arch-flag\n";
    echo "- https://easyprintcafe.com/build/product.php?slug=crest-flag\n";
    echo "- https://easyprintcafe.com/build/product.php?slug=raptor-roller-banner\n";
    echo "- https://easyprintcafe.com/build/product.php?slug=heras-banner\n";
}

// Run the insertion
try {
    insertLargeFormatProducts();
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>

