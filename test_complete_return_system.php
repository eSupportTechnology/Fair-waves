<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\CustomerOrder;
use App\Models\SystemUser;
use App\Models\ReturnRequest;
use App\Http\Controllers\ReturnRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

try {
    echo "=== Complete Return Request System Test ===\n\n";
    
    // 1. Check admin users
    echo "1. Checking Admin Users:\n";
    $adminUsers = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
        ->where('status', 'Active')
        ->get();
    
    echo "   Found " . $adminUsers->count() . " active admin users:\n";
    foreach ($adminUsers as $admin) {
        echo "   - {$admin->name} ({$admin->email}) - Role: {$admin->role}\n";
    }
    echo "\n";
    
    // 2. Check customer orders
    echo "2. Checking Customer Orders:\n";
    $customerOrders = CustomerOrder::take(3)->get();
    echo "   Sample orders in database:\n";
    foreach ($customerOrders as $order) {
        echo "   - Order: {$order->order_code}, Customer: {$order->customer_name}, Date: {$order->date}\n";
    }
    echo "\n";
    
    // 3. Test with a real order
    if ($customerOrders->count() > 0) {
        $testOrder = $customerOrders->first();
        echo "3. Testing Return Request with Real Order:\n";
        echo "   Using Order: {$testOrder->order_code}\n";
        echo "   Customer: {$testOrder->customer_name}\n";
        echo "   Phone: {$testOrder->phone}\n";
        echo "   Email: {$testOrder->email}\n";
        echo "   Date: {$testOrder->date}\n\n";
        
        // Clear any existing return requests for this order
        ReturnRequest::where('order_code', $testOrder->order_code)->delete();
        
        // Create a simulated request
        $requestData = [
            'order_id' => $testOrder->order_code,
            'customer_name' => $testOrder->customer_name,
            'phone' => $testOrder->phone,
            'email' => $testOrder->email,
            'order_date' => $testOrder->date,
            'request_type' => 'return',
            'reason' => 'Test return request - product defective'
        ];
        
        // Create request object
        $request = new Request($requestData);
        
        // Create controller and test
        $controller = new ReturnRequestController();
        
        echo "   Submitting return request...\n";
        
        // Capture any output
        ob_start();
        try {
            $response = $controller->submit($request);
            $output = ob_get_clean();
            
            // Check if return request was created
            $returnRequest = ReturnRequest::where('order_code', $testOrder->order_code)->first();
            if ($returnRequest) {
                echo "   ✓ Return request created successfully (ID: {$returnRequest->id})\n";
                echo "   ✓ Request Type: {$returnRequest->request_type}\n";
                echo "   ✓ Status: {$returnRequest->status}\n";
                echo "   ✓ Reason: {$returnRequest->reason}\n";
            } else {
                echo "   ✗ Return request not created\n";
            }
            
        } catch (Exception $e) {
            ob_end_clean();
            echo "   ✗ Error during submission: " . $e->getMessage() . "\n";
        }
    } else {
        echo "3. No customer orders found to test with.\n";
    }
    
    echo "\n4. Email Configuration Check:\n";
    echo "   MAIL_MAILER: " . config('mail.default') . "\n";
    echo "   MAIL_HOST: " . config('mail.mailers.smtp.host') . "\n";
    echo "   QUEUE_CONNECTION: " . config('queue.default') . "\n";
    
    echo "\n=== Test Complete ===\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
?>
