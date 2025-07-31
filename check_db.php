<?php
// Direct database connection using environment values
$host = '127.0.0.1';
$database = 'fairwaves';
$username = 'root';
$password = 'pramu@MYSQL123';

echo "Database Configuration:\n";
echo "Host: $host\n";
echo "Database: $database\n";
echo "Username: $username\n";
echo "\n";

// Try direct PDO connection
try {
    $dsn = "mysql:host=$host;dbname=$database";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful!\n\n";
    
    // Check if system_users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'system_users'");
    if ($stmt->rowCount() > 0) {
        echo "✅ system_users table exists\n";
        
        // Check all users first
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM system_users");
        $totalUsers = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Total users in system_users table: " . $totalUsers['count'] . "\n";
        
        // Check admin users with different case variations
        $stmt = $pdo->query("SELECT id, name, email, status, role FROM system_users WHERE role LIKE '%Admin%' OR role LIKE '%admin%' LIMIT 10");
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Admin users found: " . count($admins) . "\n";
        foreach ($admins as $admin) {
            echo "- ID: {$admin['id']}, Name: {$admin['name']}, Email: {$admin['email']}, Status: {$admin['status']}, Role: {$admin['role']}\n";
        }
        
        // Check active admin users with different case variations
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM system_users WHERE (role LIKE '%Admin%' OR role LIKE '%admin%') AND (status = 'Active' OR status = 'active')");
        $activeCount = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "\nActive admin users: " . $activeCount['count'] . "\n";
        
        // If no admin users exist, let's check all users
        if (count($admins) == 0) {
            echo "\nNo admin users found. Checking all users:\n";
            $stmt = $pdo->query("SELECT id, name, email, status, role FROM system_users LIMIT 10");
            $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($allUsers as $user) {
                echo "- ID: {$user['id']}, Name: {$user['name']}, Email: {$user['email']}, Status: {$user['status']}, Role: {$user['role']}\n";
            }
        }
        
    } else {
        echo "❌ system_users table does not exist\n";
        
        // Let's see what tables do exist
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "Available tables:\n";
        foreach ($tables as $table) {
            echo "- $table\n";
        }
    }
    
    echo "\n" . str_repeat("-", 50) . "\n";
    
    // Check customer_orders table
    $stmt = $pdo->query("SHOW TABLES LIKE 'customer_orders'");
    if ($stmt->rowCount() > 0) {
        echo "\n✅ customer_orders table exists\n";
        
        // Check sample orders
        $stmt = $pdo->query("SELECT order_code, customer_name, phone FROM customer_orders LIMIT 5");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Sample orders:\n";
        foreach ($orders as $order) {
            echo "- Order: {$order['order_code']}, Customer: {$order['customer_name']}, Phone: {$order['phone']}\n";
        }
    } else {
        echo "\n❌ customer_orders table does not exist\n";
    }
    
    // Check return_requests table
    $stmt = $pdo->query("SHOW TABLES LIKE 'return_requests'");
    if ($stmt->rowCount() > 0) {
        echo "\n✅ return_requests table exists\n";
        
        // Check sample return requests
        $stmt = $pdo->query("SELECT id, order_code, request_type, status FROM return_requests LIMIT 5");
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Sample return requests:\n";
        foreach ($requests as $request) {
            echo "- ID: {$request['id']}, Order: {$request['order_code']}, Type: {$request['request_type']}, Status: {$request['status']}\n";
        }
    } else {
        echo "\n❌ return_requests table does not exist\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
