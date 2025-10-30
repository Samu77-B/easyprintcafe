<?php
/**
 * Insert Small Format Products
 * Run this to add all small format printing products
 */

require_once __DIR__ . '/database.php';

function insertSmallFormatProducts() {
    $db = Database::getInstance()->getConnection();
    
    echo "Inserting Small Format Products...\n\n";
    
    // Get Small Format category ID
    $smallFormatId = $db->query("SELECT id FROM product_categories WHERE slug = 'small-format'")->fetch()['id'];
    
    $products = [
        // BUSINESS CARDS
        [
            'name' => 'Standard Business Cards',
            'slug' => 'standard-business-cards',
            'short_description' => 'Professional business cards with budget and premium options available',
            'full_description' => 'Make a lasting first impression with our high-quality business cards. Available in both budget-friendly and premium options, our standard business cards are printed on quality card stock with your choice of finishes. Perfect for networking, meetings, and professional events. Fast turnaround available for urgent orders.',
            'features' => '• Budget and premium options\n• 400gsm quality card stock\n• Matt, gloss, or silk finish\n• Single or double-sided printing\n• Quick turnaround available\n• Standard size 85mm x 55mm',
            'specifications' => 'Size: 85mm x 55mm (standard)\nMaterial: 400gsm Card Stock\nFinish: Matt laminated, Gloss laminated, or Silk\nPrinting: Full color CMYK\nMinimum order: 50 cards',
            'main_image' => './images/products/smallformat-bueinsscards.png',
            'base_price' => 14.99,
            'show_price' => 1,
            'price_note' => 'From £14.99',
            'turnaround_time' => '1-2 working days',
            'is_featured' => 1
        ],
        [
            'name' => 'Economy Business Cards',
            'slug' => 'economy-business-cards',
            'short_description' => 'Budget-friendly business cards without compromising on quality',
            'full_description' => 'Our economy business cards offer excellent value for money while maintaining professional quality. Perfect for startups, students, or bulk orders. These cards are printed on quality stock and deliver great results at an affordable price point.',
            'features' => '• Most affordable option\n• Quality 350gsm card stock\n• Full color printing\n• Standard finish\n• Ideal for bulk orders\n• Fast production',
            'specifications' => 'Size: 85mm x 55mm\nMaterial: 350gsm Card Stock\nFinish: Standard (uncoated)\nPrinting: Full color CMYK\nMinimum order: 100 cards',
            'main_image' => './images/products/smallformat-bueinsscards.png',
            'base_price' => 9.99,
            'show_price' => 1,
            'price_note' => 'From £9.99',
            'turnaround_time' => '2-3 working days'
        ],
        [
            'name' => 'Square Business Cards',
            'slug' => 'square-business-cards',
            'short_description' => 'Stand out with unique square-shaped business cards',
            'full_description' => 'Make a memorable impression with our premium square business cards. The unique shape sets you apart from traditional rectangular cards and creates instant visual interest. Available in various finishes including luxury options like spot UV and foil.',
            'features' => '• Unique square shape\n• Premium 450gsm card stock\n• Multiple finish options\n• Luxury finishes available\n• Spot UV option\n• High-end professional look',
            'specifications' => 'Size: 55mm x 55mm (square)\nMaterial: 450gsm Premium Card\nFinish: Matt laminated, Gloss laminated, Spot UV, Soft-touch\nPrinting: Full color CMYK',
            'main_image' => './images/products/smallformat-bueinsscards.png',
            'base_price' => 0,
            'show_price' => 0,
            'price_note' => 'Premium pricing - Get a Quote',
            'turnaround_time' => '3-5 working days'
        ],
        [
            'name' => 'Folded Business Cards',
            'slug' => 'folded-business-cards',
            'short_description' => 'Double the space with folded appointment and loyalty cards',
            'full_description' => 'Our folded business cards provide twice the space for information, making them perfect for appointment cards, loyalty cards, or mini-brochures. The folded format allows you to include appointment grids, loyalty stamps, detailed service information, or promotional offers.',
            'features' => '• Double-sided folded format\n• Extra space for information\n• Perfect for appointments\n• Ideal for loyalty programs\n• Multiple finish options\n• Professional presentation',
            'specifications' => 'Size: 85mm x 55mm (folded)\nMaterial: 400gsm Card Stock\nFormat: Folded (170mm x 55mm flat)\nFinish: Matt or Gloss laminated',
            'main_image' => './images/products/smallformat-bueinsscards.png',
            'base_price' => 0,
            'show_price' => 0,
            'price_note' => 'Specialty pricing - Get a Quote',
            'turnaround_time' => '3-5 working days'
        ],
        
        // BOOKLETS & MAGAZINES
        [
            'name' => 'Stapled Booklets & Magazines',
            'slug' => 'stapled-booklets-magazines',
            'short_description' => 'Professional saddle-stitched booklets with next-day options',
            'full_description' => 'High-quality stapled booklets and magazines perfect for catalogues, programs, menus, newsletters, and promotional materials. Our saddle-stitched binding provides a professional finish at an affordable price. Available with next-day turnaround for urgent projects.',
            'features' => '• Saddle-stitched binding\n• 8 to 80 pages\n• Multiple paper options\n• Gloss or matt finish\n• Next-day available\n• Perfect for catalogues & menus',
            'specifications' => 'Pages: 8-80 pages (multiples of 4)\nCover: 170gsm gloss or silk\nInner pages: 130gsm gloss or silk\nBinding: Saddle-stitched (stapled)\nSizes: A4, A5, A6, DL',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 49.99,
            'show_price' => 1,
            'price_note' => 'From £49.99',
            'turnaround_time' => '1-3 working days',
            'is_featured' => 1
        ],
        [
            'name' => 'Perfect Bound Booklets',
            'slug' => 'perfect-bound-booklets',
            'short_description' => 'Premium square-spine booklets for a professional finish',
            'full_description' => 'Perfect bound booklets offer a premium, professional appearance with a square spine that can be printed on. Ideal for reports, manuals, catalogues, yearbooks, and high-page-count documents. The glued binding creates a book-like finish that\'s perfect for corporate publications.',
            'features' => '• Square spine for branding\n• Professional book-like finish\n• 40 to 400 pages\n• Printable spine\n• Durable glued binding\n• Premium presentation',
            'specifications' => 'Pages: 40-400 pages\nCover: 300gsm gloss or silk\nInner pages: 130gsm gloss, silk, or uncoated\nBinding: Perfect bound (glued spine)\nSizes: A4, A5',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 0,
            'show_price' => 0,
            'price_note' => 'Premium option - Request Quote',
            'turnaround_time' => '5-7 working days'
        ],
        [
            'name' => 'Hardback Books',
            'slug' => 'hardback-hardcover-books',
            'short_description' => 'Premium hardcover books for lasting impressions',
            'full_description' => 'Our hardback books provide the ultimate in presentation and durability. Perfect for corporate yearbooks, coffee table books, portfolios, and special publications. The rigid cover provides superior protection and a luxury feel that reflects the quality of your content.',
            'features' => '• Rigid hardcover binding\n• Premium luxury finish\n• Full-color cover printing\n• Matt or gloss lamination\n• Durable and long-lasting\n• Professional presentation',
            'specifications' => 'Pages: 40-400 pages\nCover: Rigid board with printed wrap\nInner pages: 150gsm silk or uncoated\nBinding: Case bound (hardback)\nSizes: A4, A5, custom sizes available',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 99.99,
            'show_price' => 1,
            'price_note' => 'From £99.99 per book',
            'turnaround_time' => '7-10 working days'
        ],
        
        // BUSINESS STATIONERY
        [
            'name' => 'Compliment Slips',
            'slug' => 'compliment-slips',
            'short_description' => 'Professional compliment slips for business correspondence',
            'full_description' => 'Add a professional touch to your business correspondence with custom compliment slips. Perfect for accompanying deliveries, gifts, or documents. Printed on quality paper stock and available in various sizes and finishes.',
            'features' => '• Professional appearance\n• Quality paper stock\n• Full-color printing\n• Standard or custom sizes\n• Matt or gloss finish\n• Quick turnaround',
            'specifications' => 'Size: DL (210mm x 99mm) or custom\nMaterial: 150gsm silk or uncoated\nPrinting: Full color CMYK\nFinish: Matt or uncoated',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 19.99,
            'show_price' => 1,
            'price_note' => 'From £19.99 per 100',
            'turnaround_time' => '2-3 working days'
        ],
        [
            'name' => 'Letterheads',
            'slug' => 'letterheads',
            'short_description' => 'Professional printed letterheads for your business',
            'full_description' => 'Create a professional image with custom printed letterheads. Essential for official correspondence, quotes, and business letters. Available in various paper weights and finishes to suit your brand. Can be supplied loose or as pads.',
            'features' => '• Professional branding\n• Multiple paper weights\n• Full-color printing\n• Loose sheets or pads\n• Quality paper stock\n• Corporate presentation',
            'specifications' => 'Size: A4 (210mm x 297mm)\nMaterial: 100gsm, 120gsm, or 160gsm\nPaper: Bond, wove, or laid finish\nPrinting: Full color CMYK\nFormat: Loose sheets or glued pads',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 34.99,
            'show_price' => 1,
            'price_note' => 'From £34.99 per 250',
            'turnaround_time' => '2-3 working days'
        ],
        [
            'name' => 'Swing Tags',
            'slug' => 'swing-tags',
            'short_description' => 'Custom swing tags for products and gifts',
            'full_description' => 'Professional swing tags perfect for product labeling, gift tags, or promotional materials. Available in various shapes, sizes, and finishes. Can include hole drilling and string attachment for easy use.',
            'features' => '• Custom shapes and sizes\n• Hole drilling included\n• String attachment available\n• Multiple finish options\n• Full-color printing\n• Perfect for branding',
            'specifications' => 'Sizes: Various (custom available)\nMaterial: 350gsm-450gsm card\nFinish: Matt, gloss, uncoated\nOptions: Hole drilling, string/ribbon\nPrinting: Full color CMYK',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 0,
            'show_price' => 0,
            'price_note' => 'Custom pricing - Request Quote',
            'turnaround_time' => '3-5 working days'
        ],
        [
            'name' => 'NCR Pads',
            'slug' => 'ncr-pads',
            'short_description' => 'Duplicate and triplicate carbonless pads for invoices and receipts',
            'full_description' => 'NCR (No Carbon Required) pads are essential for creating instant copies of invoices, receipts, delivery notes, and order forms. Available in duplicate, triplicate, or quadruplicate sets with glued pads for easy tear-off.',
            'features' => '• Duplicate or triplicate sets\n• Carbonless paper\n• Numbered options available\n• Glued pad format\n• Professional finish\n• Perfect for invoices & receipts',
            'specifications' => 'Sizes: A4, A5, A6, DL\nParts: Duplicate, Triplicate, or Quadruplicate\nSets per pad: 50 or 100\nOptions: Numbering, perforation\nBinding: Glued pad with backing board',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 32.99,
            'show_price' => 1,
            'price_note' => 'From £32.99 per pad',
            'turnaround_time' => '3-5 working days'
        ],
        
        // FLYERS & LEAFLETS
        [
            'name' => 'Heavyweight Flyers',
            'slug' => 'heavyweight-flyers-leaflets',
            'short_description' => 'Premium heavyweight flyers for maximum impact',
            'full_description' => 'Our heavyweight flyers are printed on thick, quality stock for a premium feel. Perfect for promotions, events, menus, and marketing materials. The substantial weight makes your flyers feel more valuable and less likely to be discarded.',
            'features' => '• Premium heavyweight stock\n• 350gsm card\n• Matt or gloss finish\n• Full-color printing\n• Professional quality\n• Various sizes available',
            'specifications' => 'Sizes: A6, A5, A4, DL\nMaterial: 350gsm silk card\nFinish: Matt or gloss laminated\nPrinting: Full color both sides\nMinimum order: 50',
            'main_image' => './images/products/smallformat-flyers.png',
            'base_price' => 19.99,
            'show_price' => 1,
            'price_note' => 'From £19.99 per 100',
            'turnaround_time' => '1-2 working days',
            'is_featured' => 1
        ],
        [
            'name' => 'Folded Invitations',
            'slug' => 'folded-invitations-greeting-cards',
            'short_description' => 'Elegant folded cards for invitations and greetings',
            'full_description' => 'Beautiful folded invitations and greeting cards perfect for weddings, events, celebrations, and corporate functions. The folded format provides a premium presentation with space for detailed information inside.',
            'features' => '• Premium folded format\n• High-quality card stock\n• Matt or gloss finish\n• Perfect for events\n• Professional presentation\n• Envelopes available',
            'specifications' => 'Sizes: A6, A5, DL (folded)\nMaterial: 350gsm silk card\nFormat: Folded (creased)\nFinish: Matt or gloss laminated\nPrinting: Full color',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 29.99,
            'show_price' => 1,
            'price_note' => 'From £29.99 per 50',
            'turnaround_time' => '2-3 working days'
        ],
        [
            'name' => 'Postcards',
            'slug' => 'postcards-invitations',
            'short_description' => 'Quality postcards for invitations and direct mail',
            'full_description' => 'Professional postcards ideal for invitations, announcements, direct mail campaigns, and promotional materials. Printed on quality card stock with a choice of finishes for maximum impact.',
            'features' => '• Quality card stock\n• Full-color printing\n• Matt or gloss finish\n• Perfect for direct mail\n• Various sizes\n• Quick turnaround',
            'specifications' => 'Sizes: A6, A5, DL\nMaterial: 350gsm silk card\nFinish: Matt or gloss laminated\nPrinting: Full color both sides\nMinimum order: 50',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 19.99,
            'show_price' => 1,
            'price_note' => 'From £19.99 per 50',
            'turnaround_time' => '1-2 working days'
        ],
        
        // FOLDERS
        [
            'name' => 'Glued Presentation Folders',
            'slug' => 'glued-presentation-folders',
            'short_description' => 'Professional presentation folders for documents and proposals',
            'full_description' => 'High-quality presentation folders perfect for proposals, corporate documents, sales materials, and client presentations. Features internal pockets to hold documents securely. Available in various finishes including matt lamination for a luxury feel.',
            'features' => '• Professional presentation\n• Internal document pockets\n• Matt or gloss lamination\n• Business card slits\n• High-quality card stock\n• Custom printing',
            'specifications' => 'Size: A4 capacity (310mm x 220mm)\nMaterial: 350gsm silk board\nPockets: Twin glued internal pockets\nFinish: Matt or gloss laminated\nOptions: Business card slits',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 79.99,
            'show_price' => 1,
            'price_note' => 'From £79.99 per 100',
            'turnaround_time' => '3-5 working days'
        ],
        [
            'name' => 'Interlocking Folders',
            'slug' => 'interlocking-folders',
            'short_description' => 'No-glue interlocking folders for quick production',
            'full_description' => 'Innovative interlocking folders that require no glue, allowing for faster production and lower costs. The clever interlocking design creates secure pockets for your documents while maintaining a professional appearance.',
            'features' => '• No-glue construction\n• Fast production time\n• Secure interlocking design\n• Cost-effective solution\n• Professional finish\n• Full-color printing',
            'specifications' => 'Size: A4 capacity\nMaterial: 350gsm silk board\nConstruction: Die-cut interlocking design\nFinish: Matt or gloss laminated\nPockets: Interlocking flaps',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 84.99,
            'show_price' => 1,
            'price_note' => 'From £84.99 per 100',
            'turnaround_time' => '2-3 working days'
        ],
        
        // STICKERS
        [
            'name' => 'Stickers on a Sheet',
            'slug' => 'stickers-on-sheet',
            'short_description' => 'Custom printed stickers on sheets for easy application',
            'full_description' => 'High-quality stickers printed on sheets for convenient storage and application. Perfect for product labeling, promotional giveaways, packaging, or brand marketing. Available in various shapes, sizes, and finishes.',
            'features' => '• Custom shapes and sizes\n• Matt or gloss finish\n• Easy peel backing\n• Weather-resistant option\n• Full-color printing\n• Multiple stickers per sheet',
            'specifications' => 'Sheet size: A4 or A5\nMaterial: Self-adhesive vinyl or paper\nFinish: Matt, gloss, or clear\nCutting: Kiss-cut or die-cut\nPrinting: Full color CMYK',
            'main_image' => './images/products/smallformat-stickers.png',
            'base_price' => 12.99,
            'show_price' => 1,
            'price_note' => 'From £12.99 per sheet',
            'turnaround_time' => '2-3 working days',
            'weather_resistant' => 1
        ],
        [
            'name' => 'Vinyl Floor Stickers',
            'slug' => 'vinyl-floor-stickers',
            'short_description' => 'Durable floor stickers for indoor wayfinding and promotions',
            'full_description' => 'Heavy-duty vinyl floor stickers designed specifically for floor applications. Perfect for social distancing markers, directional arrows, promotional messages, and wayfinding. Features anti-slip laminate for safety and durability.',
            'features' => '• Heavy-duty vinyl\n• Anti-slip laminate\n• Weather-resistant\n• Strong adhesive\n• Perfect for wayfinding\n• Easy to apply and remove',
            'specifications' => 'Sizes: Various (custom available)\nMaterial: Heavy-duty vinyl with anti-slip laminate\nAdhesive: Strong permanent adhesive\nPrinting: Full color\nSuitable for: Indoor floors',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 14.99,
            'show_price' => 1,
            'price_note' => 'From £14.99 each',
            'turnaround_time' => '2-3 working days',
            'weather_resistant' => 1
        ],
        
        // POSTERS & LARGE PRINTS
        [
            'name' => 'A2 Posters',
            'slug' => 'a2-posters',
            'short_description' => 'High-quality A2 posters for advertising and promotions',
            'full_description' => 'Professional A2 posters printed on premium paper for maximum impact. Perfect for retail displays, events, exhibitions, and advertising. Available in various finishes to suit your requirements.',
            'features' => '• High-quality printing\n• Various paper options\n• Matt or gloss finish\n• Vibrant colors\n• Quick turnaround\n• Perfect for displays',
            'specifications' => 'Size: A2 (420mm x 594mm)\nMaterial: 170gsm silk or 200gsm silk\nFinish: Matt or gloss\nPrinting: Full color CMYK\nMinimum order: 1',
            'main_image' => './images/products/poster-printing.png',
            'base_price' => 14.99,
            'show_price' => 1,
            'price_note' => 'From £14.99',
            'turnaround_time' => '1-2 working days'
        ],
        [
            'name' => 'A1 Posters',
            'slug' => 'a1-posters',
            'short_description' => 'Large format A1 posters for maximum visibility',
            'full_description' => 'Eye-catching A1 posters that demand attention. Ideal for retail windows, exhibitions, conferences, and large venue advertising. Printed on quality stock with vibrant, fade-resistant inks.',
            'features' => '• Large A1 format\n• High-impact printing\n• Quality paper stock\n• Fade-resistant inks\n• Matt or gloss finish\n• Fast turnaround',
            'specifications' => 'Size: A1 (594mm x 841mm)\nMaterial: 170gsm silk or 200gsm silk\nFinish: Matt or gloss\nPrinting: Full color CMYK\nMinimum order: 1',
            'main_image' => './images/products/poster-printing.png',
            'base_price' => 19.99,
            'show_price' => 1,
            'price_note' => 'From £19.99',
            'turnaround_time' => '1-2 working days'
        ],
        [
            'name' => 'Canvas Prints',
            'slug' => 'canvas-prints',
            'short_description' => 'Premium canvas prints for artistic displays',
            'full_description' => 'Museum-quality canvas prints perfect for artwork reproductions, photography displays, and decorative pieces. Stretched over wooden frames and ready to hang. UV-resistant inks ensure your prints stay vibrant for years.',
            'features' => '• Museum-quality canvas\n• Stretched over wooden frame\n• Ready to hang\n• UV-resistant inks\n• Various sizes available\n• Professional finish',
            'specifications' => 'Sizes: Various (custom available)\nMaterial: 380gsm poly-cotton canvas\nFrame: Pine wood stretcher bars\nPrinting: Giclée quality\nFinish: Satin or gloss protective coating',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 39.99,
            'show_price' => 1,
            'price_note' => 'From £39.99',
            'turnaround_time' => '3-5 working days'
        ],
        [
            'name' => 'Plan Printing',
            'slug' => 'plan-printing',
            'short_description' => 'Technical drawings and architectural plans printed to scale',
            'full_description' => 'Professional plan printing for architects, engineers, and construction professionals. Accurate scale reproduction with sharp line work and clear text. Available in various sizes up to A0 and beyond.',
            'features' => '• Accurate scale reproduction\n• Sharp line work\n• Clear text rendering\n• Various sizes\n• Same-day available\n• Technical paper options',
            'specifications' => 'Sizes: A3, A2, A1, A0, and larger\nMaterial: 90gsm bond or technical paper\nPrinting: Black & white or color\nAccuracy: Scale accurate\nOptions: Folded or rolled',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 2.99,
            'show_price' => 1,
            'price_note' => 'From £2.99 per sheet',
            'turnaround_time' => 'Same day available'
        ],
        
        // SPECIAL PRINTS & FINISHING
        [
            'name' => 'Special Effect Printing',
            'slug' => 'special-effect-printing',
            'short_description' => 'Metallic, white ink, fluorescent and special effect printing',
            'full_description' => 'Stand out with our special effect printing options including metallic inks, white ink on dark stocks, fluorescent colors, spot UV, foiling, and embossing. Perfect for premium business cards, invitations, and marketing materials that demand attention.',
            'features' => '• Metallic ink printing\n• White ink on dark stock\n• Fluorescent colors\n• Spot UV coating\n• Hot foil stamping\n• Embossing/debossing',
            'specifications' => 'Effects: Metallic, white ink, fluorescent, spot UV, foil, emboss\nSubstrates: Various card stocks and papers\nFinishing: Multiple special finishes available\nApplications: Business cards, invitations, packaging',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 0,
            'show_price' => 0,
            'price_note' => 'Custom pricing - Request Quote',
            'turnaround_time' => '5-7 working days'
        ],
        [
            'name' => 'Book Binding Services',
            'slug' => 'book-binding-slip-cases',
            'short_description' => 'Professional book binding and protective slip cases',
            'full_description' => 'Professional book binding services for theses, dissertations, portfolios, and special documents. We offer wire binding, comb binding, and thermal binding. Protective slip cases available for premium presentations.',
            'features' => '• Multiple binding options\n• Wire, comb, or thermal binding\n• Custom slip cases\n• Professional finish\n• Same-day binding available\n• Perfect for theses',
            'specifications' => 'Binding types: Wire, comb, thermal\nCapacity: Up to 500 sheets\nCovers: Clear PVC or card covers\nSlip cases: Custom-made protective boxes\nSizes: A4, A5',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 19.99,
            'show_price' => 1,
            'price_note' => 'From £19.99 per bind',
            'turnaround_time' => 'Same day available'
        ],
        [
            'name' => 'Finishing & Mounting',
            'slug' => 'finishing-mounting-lamination',
            'short_description' => 'Professional mounting, lamination, and finishing services',
            'full_description' => 'Complete finishing services including dry mounting, foam board mounting, encapsulation, and lamination. Perfect for protecting and presenting posters, photographs, certificates, and important documents.',
            'features' => '• Dry mounting\n• Foam board mounting\n• Encapsulation\n• Matt or gloss lamination\n• Various board thicknesses\n• Professional finish',
            'specifications' => 'Services: Mounting, lamination, encapsulation\nBoards: Foam board, correx, dibond\nLamination: Matt or gloss, various thicknesses\nSizes: Up to A0 and larger',
            'main_image' => './images/products/placeholder.png',
            'base_price' => 14.99,
            'show_price' => 1,
            'price_note' => 'From £14.99',
            'turnaround_time' => '1-2 working days'
        ]
    ];
    
    $stmt = $db->prepare("
        INSERT INTO products (
            category_id, name, slug, short_description, full_description, 
            features, specifications, main_image, base_price, show_price, 
            price_note, turnaround_time, weather_resistant, is_active, is_featured
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?)
    ");
    
    $count = 0;
    foreach ($products as $product) {
        $stmt->execute([
            $smallFormatId,
            $product['name'],
            $product['slug'],
            $product['short_description'],
            $product['full_description'],
            $product['features'],
            $product['specifications'],
            $product['main_image'],
            $product['base_price'] ?? 0,
            $product['show_price'] ?? 0,
            $product['price_note'],
            $product['turnaround_time'],
            $product['weather_resistant'] ?? 0,
            $product['is_featured'] ?? 0
        ]);
        $count++;
        echo "  ✓ {$product['name']}\n";
    }
    
    echo "\n✅ Successfully inserted {$count} small format products!\n";
    echo "\nExample products:\n";
    echo "- https://easyprintcafe.com/build/product.php?slug=standard-business-cards\n";
    echo "- https://easyprintcafe.com/build/product.php?slug=heavyweight-flyers-leaflets\n";
    echo "- https://easyprintcafe.com/build/product.php?slug=stapled-booklets-magazines\n";
}

// Run the insertion
try {
    insertSmallFormatProducts();
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>

