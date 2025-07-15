<?php
require_once 'vendor/autoload.php';

use App\Models\User;

// Bootstrap Laravel
if (!app()->bound('config')) {
    $app = require_once 'bootstrap/app.php';
    $app->boot();
}

echo "=== Profile Image Check ===" . PHP_EOL;

// Get all users with profile images
$users = User::whereNotNull('profile_image')->get(['id', 'name', 'profile_image']);

if ($users->isEmpty()) {
    echo "No users found with profile images." . PHP_EOL;
} else {
    foreach ($users as $user) {
        echo "User ID: {$user->id}" . PHP_EOL;
        echo "Name: {$user->name}" . PHP_EOL;
        echo "Profile Image: {$user->profile_image}" . PHP_EOL;
        echo "Profile Image URL: {$user->profile_image_url}" . PHP_EOL;
        echo "---" . PHP_EOL;
    }
}

// Check if storage directory exists
$storagePath = storage_path('app/public/profile_images');
echo "Storage path exists: " . (file_exists($storagePath) ? 'YES' : 'NO') . PHP_EOL;
echo "Storage path: {$storagePath}" . PHP_EOL;

// Check if public storage link exists
$publicStoragePath = public_path('storage');
echo "Public storage link exists: " . (file_exists($publicStoragePath) ? 'YES' : 'NO') . PHP_EOL;
echo "Public storage link: {$publicStoragePath}" . PHP_EOL;

// Check if the profile_images folder exists in public storage
$profileImagesPath = public_path('storage/profile_images');
echo "Profile images path exists: " . (file_exists($profileImagesPath) ? 'YES' : 'NO') . PHP_EOL;
echo "Profile images path: {$profileImagesPath}" . PHP_EOL;
