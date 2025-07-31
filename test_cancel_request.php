<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\CustomerOrder;
use App\Models\ReturnRequest;
use App\Http\Controllers\ReturnRequestController;
use Illuminate\Http\Request;

try {
    echo "=== Testing Cancel Request ===\n";
    
    // Get a different order for testing
    $customerOrders = CustomerOrder::take(3)->get();
    if ($customerOrders->count() > 1) {
        $testOrder = $customerOrders->skip(1)->first(); // Use second order
        
        echo "Using Order: {$testOrder->order_code}\n";
        
        // Clear any existing return requests for this order
        ReturnRequest::where('order_code', $testOrder->order_code)->delete();
        
        // Create a cancel request
        $requestData = [
            'order_id' => $testOrder->order_code,
            'customer_name' => $testOrder->customer_name,
            'phone' => $testOrder->phone,
            'email' => $testOrder->email,
            'order_date' => $testOrder->date,
            'request_type' => 'cancel',
            'reason' => 'Test cancel request - changed mind'
        ];
        
        $request = new Request($requestData);
        $controller = new ReturnRequestController();
        
        echo "Submitting cancel request...\n";
        
        ob_start();
        try {
            $response = $controller->submit($request);
            $output = ob_get_clean();
            
            $returnRequest = ReturnRequest::where('order_code', $testOrder->order_code)->first();
            if ($returnRequest) {
                echo "✓ Cancel request created successfully (ID: {$returnRequest->id})\n";
                echo "✓ Request Type: {$returnRequest->request_type}\n";
                echo "✓ Status: {$returnRequest->status}\n";
            } else {
                echo "✗ Cancel request not created\n";
            }
            
        } catch (Exception $e) {
            ob_end_clean();
            echo "✗ Error during submission: " . $e->getMessage() . "\n";
        }
    } else {
        echo "Not enough orders to test with.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
