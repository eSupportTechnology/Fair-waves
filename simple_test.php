<?php

// Simple test for database access
require_once 'bootstrap/app.php';

use App\Models\CustomerOrder;

echo "Testing customer order data...\n";

$order = CustomerOrder::where('order_code', 'ORD-OMETMD7C')->first();

if ($order) {
    echo "✅ Found order: {$order->order_code}\n";
    echo "Customer: {$order->customer_name}\n";
    echo "Phone: {$order->phone}\n";
    echo "Email: {$order->email}\n";
    echo "Date: {$order->date}\n";
    
    // Test the API response structure
    $data = [
        'customer_name' => $order->customer_name,
        'phone' => $order->phone,
        'email' => $order->email,
        'order_date' => $order->date
    ];
    
    echo "\nAPI data structure:\n";
    echo json_encode($data, JSON_PRETTY_PRINT) . "\n";
} else {
    echo "❌ Order not found\n";
}
