<?php
// Direct database connection using environment values
$host = '127.0.0.1';
$database = 'fairwaves';
$username = 'root';
$password = 'pramu@MYSQL123';

try {
    $dsn = "mysql:host=$host;dbname=$database";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== RETURN REQUESTS TABLE SCHEMA ===\n";
    
    // Check the structure of return_requests table
    $stmt = $pdo->query("DESCRIBE return_requests");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Current columns in return_requests table:\n";
    foreach ($columns as $column) {
        echo "- {$column['Field']} ({$column['Type']}) - {$column['Null']} - Default: {$column['Default']}\n";
    }
    
    echo "\n=== SAMPLE DATA ===\n";
    
    // Check sample data without request_type
    $stmt = $pdo->query("SELECT * FROM return_requests LIMIT 3");
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Sample return requests:\n";
    foreach ($requests as $request) {
        echo "Record ID: {$request['id']}\n";
        foreach ($request as $key => $value) {
            echo "  $key: $value\n";
        }
        echo "\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
