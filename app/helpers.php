
<?php

if (!function_exists('hexToColorName')) {
    function hexToColorName($hex) {
        // Ensure the hex code is in the correct format
        $hex = strtoupper(trim($hex));
        if (!preg_match('/^#?[0-9A-F]{6}$/', $hex)) {
            return 'Invalid Color';
        }
        
        // API URL for color name lookup
        $url = "https://www.thecolorapi.com/id?hex=" . ltrim($hex, '#');
        
        // Get the color name
        $response = file_get_contents($url);
        if ($response === FALSE) {
            return 'Unknown Color';
        }

        $data = json_decode($response, true);
        return $data['name']['value'] ?? 'Unknown Color';
    }
}


