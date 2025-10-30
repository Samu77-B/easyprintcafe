<?php
/**
 * Demo Data API Endpoint
 * Provides sample data for dashboard demonstration
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
    
    // Sample statistics
    $stats = [
        'total_orders' => 12,
        'total_files' => 8,
        'total_spent' => '£1,247.50'
    ];
    
    // Sample recent orders
    $orders = [
        [
            'order_number' => 'EPC-2024-001',
            'status' => 'completed',
            'total_amount' => '£89.50',
            'created_at' => '2024-12-15 14:30:00',
            'product_name' => 'Business Cards - Premium Quality'
        ],
        [
            'order_number' => 'EPC-2024-002',
            'status' => 'processing',
            'total_amount' => '£156.75',
            'created_at' => '2024-12-12 09:15:00',
            'product_name' => 'Feather Flags - Custom Design'
        ],
        [
            'order_number' => 'EPC-2024-003',
            'status' => 'completed',
            'total_amount' => '£234.00',
            'created_at' => '2024-12-08 16:45:00',
            'product_name' => 'Poster Printing - A2 Size'
        ],
        [
            'order_number' => 'EPC-2024-004',
            'status' => 'pending',
            'total_amount' => '£67.25',
            'created_at' => '2024-12-05 11:20:00',
            'product_name' => 'Table Talkers - Restaurant Menu'
        ],
        [
            'order_number' => 'EPC-2024-005',
            'status' => 'completed',
            'total_amount' => '£189.90',
            'created_at' => '2024-12-01 13:10:00',
            'product_name' => 'Window Graphics - Vinyl Cut'
        ]
    ];
    
    // Sample saved files
    $files = [
        [
            'id' => 1,
            'original_filename' => 'Company_Logo_Final.eps',
            'file_size' => 2048576, // 2MB
            'file_type' => 'application/postscript',
            'upload_date' => '2024-12-10 10:30:00',
            'description' => 'Main company logo for all branding'
        ],
        [
            'id' => 2,
            'original_filename' => 'Event_Banner_Design.jpg',
            'file_size' => 5242880, // 5MB
            'file_type' => 'image/jpeg',
            'upload_date' => '2024-12-08 15:45:00',
            'description' => 'Summer promotion banner design'
        ],
        [
            'id' => 3,
            'original_filename' => 'Menu_Template_v2.pdf',
            'file_size' => 1536000, // 1.5MB
            'file_type' => 'application/pdf',
            'upload_date' => '2024-12-05 12:15:00',
            'description' => 'Updated restaurant menu template'
        ],
        [
            'id' => 4,
            'original_filename' => 'Business_Card_Design.ai',
            'file_size' => 3145728, // 3MB
            'file_type' => 'application/vnd.adobe.illustrator',
            'upload_date' => '2024-12-03 14:20:00',
            'description' => 'Professional business card design'
        ],
        [
            'id' => 5,
            'original_filename' => 'Window_Sticker_Design.png',
            'file_size' => 1048576, // 1MB
            'file_type' => 'image/png',
            'upload_date' => '2024-12-01 09:30:00',
            'description' => 'Store window promotional sticker'
        ]
    ];
    
    echo json_encode([
        'success' => true,
        'stats' => $stats,
        'orders' => $orders,
        'files' => $files,
        'demo_mode' => true
    ]);
    
} catch (Exception $e) {
    error_log("Demo data error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Failed to load demo data'
    ]);
}
?>
