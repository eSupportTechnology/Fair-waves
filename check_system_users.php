<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "=== System Users Table Structure ===\n";
    $columns = DB::select('SHOW COLUMNS FROM system_users');
    foreach ($columns as $column) {
        echo $column->Field . " (" . $column->Type . ")\n";
    }

    echo "\n=== System Users Data ===\n";
    $users = DB::select('SELECT * FROM system_users LIMIT 5');
    foreach ($users as $user) {
        echo "User: ";
        foreach ($user as $key => $value) {
            echo "$key=$value ";
        }
        echo "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
