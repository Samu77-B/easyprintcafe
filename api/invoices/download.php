<?php
/**
 * Invoice Download API Endpoint
 * Generates and downloads invoices for orders
 */

require_once __DIR__ . '/../../includes/auth.php';

try {
    // Check authentication
    $auth = new Auth();
    $user = $auth->requireAuth();
    
    // Get order number from query parameter
    $orderNumber = sanitizeInput($_GET['order'] ?? '');
    
    if (empty($orderNumber)) {
        http_response_code(400);
        echo json_encode(['error' => 'Order number is required']);
        exit;
    }
    
    $db = Database::getInstance()->getConnection();
    
    // Get order details
    $stmt = $db->prepare("
        SELECT o.*, u.first_name, u.last_name, u.email, u.company_name, u.phone,
               da.address_line1, da.address_line2, da.city, da.postcode, da.country as delivery_country,
               ba.address_line1 as billing_address_line1, ba.address_line2 as billing_address_line2, 
               ba.city as billing_city, ba.postcode as billing_postcode, ba.country as billing_country
        FROM orders o
        JOIN users u ON o.user_id = u.id
        LEFT JOIN user_addresses da ON o.delivery_address_id = da.id
        LEFT JOIN user_addresses ba ON o.billing_address_id = ba.id
        WHERE o.order_number = ? AND o.user_id = ?
    ");
    $stmt->execute([$orderNumber, $user['id']]);
    $order = $stmt->fetch();
    
    if (!$order) {
        http_response_code(404);
        echo json_encode(['error' => 'Order not found']);
        exit;
    }
    
    // Get order items
    $stmt = $db->prepare("
        SELECT product_name, quantity, unit_price, total_price, specifications
        FROM order_items
        WHERE order_id = ?
    ");
    $stmt->execute([$order['id']]);
    $orderItems = $stmt->fetchAll();
    
    // Generate PDF invoice
    $invoiceHtml = generateInvoiceHTML($order, $orderItems);
    $pdfContent = generatePDF($invoiceHtml);
    
    // Set headers for PDF download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="invoice-' . $orderNumber . '.pdf"');
    header('Content-Length: ' . strlen($pdfContent));
    
    echo $pdfContent;
    
} catch (Exception $e) {
    error_log("Invoice download error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Failed to generate invoice']);
}

/**
 * Generate invoice HTML
 */
function generateInvoiceHTML($order, $orderItems) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Invoice ' . $order['order_number'] . '</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
            .header { text-align: center; margin-bottom: 30px; }
            .company-name { font-size: 24px; font-weight: bold; color: #8eb442; }
            .invoice-title { font-size: 18px; margin-top: 10px; }
            .invoice-details { margin-bottom: 30px; }
            .row { display: flex; justify-content: space-between; margin-bottom: 20px; }
            .column { flex: 1; }
            .column:first-child { margin-right: 20px; }
            .label { font-weight: bold; color: #333; }
            .value { margin-top: 5px; }
            .items-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
            .items-table th, .items-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
            .items-table th { background-color: #8eb442; color: white; }
            .total-row { font-weight: bold; }
            .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="company-name">Easy Print Cafe</div>
            <div class="invoice-title">INVOICE</div>
        </div>
        
        <div class="invoice-details">
            <div class="row">
                <div class="column">
                    <div class="label">Bill To:</div>
                    <div class="value">
                        ' . htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) . '<br>
                        ' . ($order['company_name'] ? htmlspecialchars($order['company_name']) . '<br>' : '') . '
                        ' . htmlspecialchars($order['email']) . '<br>
                        ' . ($order['phone'] ? htmlspecialchars($order['phone']) : '') . '
                    </div>
                </div>
                <div class="column">
                    <div class="label">Invoice Details:</div>
                    <div class="value">
                        Invoice Number: ' . htmlspecialchars($order['order_number']) . '<br>
                        Invoice Date: ' . date('d/m/Y', strtotime($order['created_at'])) . '<br>
                        Due Date: ' . date('d/m/Y', strtotime($order['created_at']) + (30 * 24 * 60 * 60)) . '
                    </div>
                </div>
            </div>
        </div>
        
        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';
    
    $subtotal = 0;
    foreach ($orderItems as $item) {
        $subtotal += $item['total_price'];
        $html .= '
                <tr>
                    <td>
                        ' . htmlspecialchars($item['product_name']) . '
                        ' . ($item['specifications'] ? '<br><small>' . htmlspecialchars($item['specifications']) . '</small>' : '') . '
                    </td>
                    <td>' . $item['quantity'] . '</td>
                    <td>£' . number_format($item['unit_price'], 2) . '</td>
                    <td>£' . number_format($item['total_price'], 2) . '</td>
                </tr>';
    }
    
    $vat = $subtotal * 0.2; // 20% VAT
    $total = $subtotal + $vat;
    
    $html .= '
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total-row">Subtotal:</td>
                    <td class="total-row">£' . number_format($subtotal, 2) . '</td>
                </tr>
                <tr>
                    <td colspan="3" class="total-row">VAT (20%):</td>
                    <td class="total-row">£' . number_format($vat, 2) . '</td>
                </tr>
                <tr>
                    <td colspan="3" class="total-row">Total:</td>
                    <td class="total-row">£' . number_format($total, 2) . '</td>
                </tr>
            </tfoot>
        </table>
        
        <div class="footer">
            <p>Thank you for your business!</p>
            <p>Easy Print Cafe - Professional Printing Services</p>
        </div>
    </body>
    </html>';
    
    return $html;
}

/**
 * Generate PDF from HTML (placeholder - implement with actual PDF library)
 */
function generatePDF($html) {
    // For now, return a simple text-based invoice
    // In production, use a library like TCPDF, FPDF, or wkhtmltopdf
    
    $pdfContent = "INVOICE PDF CONTENT\n\n";
    $pdfContent .= "This is a placeholder for the actual PDF generation.\n";
    $pdfContent .= "In production, implement with a proper PDF library.\n\n";
    $pdfContent .= "HTML Content Length: " . strlen($html) . " characters\n";
    
    // For demonstration, you could use a service like:
    // - TCPDF (PHP library)
    // - wkhtmltopdf (command line tool)
    // - Puppeteer (Node.js)
    // - Online PDF generation service
    
    return $pdfContent;
}
?>
