<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "=== Return Requests Table Structure ===\n";
    $columns = DB::select('SHOW COLUMNS FROM return_requests');
    foreach ($columns as $column) {
        echo $column->Field . " (" . $column->Type . ")\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
