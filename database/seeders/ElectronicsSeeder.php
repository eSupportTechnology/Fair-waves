<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Shop;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ElectronicsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Electronics category
        $electronicsCategory = Category::firstOrCreate(['name' => 'Electronics']);

        // Create subcategories
        $audioVideoSubcategory = Subcategory::firstOrCreate([
            'name' => 'Audio & Video',
            'category_id' => $electronicsCategory->id
        ]);

        $camerasSubcategory = Subcategory::firstOrCreate([
            'name' => 'Cameras & Photography',
            'category_id' => $electronicsCategory->id
        ]);

        $gamingSubcategory = Subcategory::firstOrCreate([
            'name' => 'Gaming Consoles',
            'category_id' => $electronicsCategory->id
        ]);

        $wearableSubcategory = Subcategory::firstOrCreate([
            'name' => 'Wearable Technology',
            'category_id' => $electronicsCategory->id
        ]);

        $homeSecuritySubcategory = Subcategory::firstOrCreate([
            'name' => 'Home Security',
            'category_id' => $electronicsCategory->id
        ]);

        $portableElectronicsSubcategory = Subcategory::firstOrCreate([
            'name' => 'Portable Electronics',
            'category_id' => $electronicsCategory->id
        ]);

        // Create sub-subcategories for each subcategory
        // Audio & Video sub-subcategories
        $headphones = SubSubcategory::firstOrCreate([
            'name' => 'Headphones & Earphones',
            'subcategory_id' => $audioVideoSubcategory->id
        ]);

        $speakers = SubSubcategory::firstOrCreate([
            'name' => 'Speakers',
            'subcategory_id' => $audioVideoSubcategory->id
        ]);

        $soundbars = SubSubcategory::firstOrCreate([
            'name' => 'Soundbars',
            'subcategory_id' => $audioVideoSubcategory->id
        ]);

        // Cameras & Photography sub-subcategories
        $digitalCameras = SubSubcategory::firstOrCreate([
            'name' => 'Digital Cameras',
            'subcategory_id' => $camerasSubcategory->id
        ]);

        $actionCameras = SubSubcategory::firstOrCreate([
            'name' => 'Action Cameras',
            'subcategory_id' => $camerasSubcategory->id
        ]);

        $cameraAccessories = SubSubcategory::firstOrCreate([
            'name' => 'Camera Accessories',
            'subcategory_id' => $camerasSubcategory->id
        ]);

        // Gaming Consoles sub-subcategories
        $playstation = SubSubcategory::firstOrCreate([
            'name' => 'PlayStation',
            'subcategory_id' => $gamingSubcategory->id
        ]);

        $xbox = SubSubcategory::firstOrCreate([
            'name' => 'Xbox',
            'subcategory_id' => $gamingSubcategory->id
        ]);

        $nintendo = SubSubcategory::firstOrCreate([
            'name' => 'Nintendo',
            'subcategory_id' => $gamingSubcategory->id
        ]);

        // Wearable Technology sub-subcategories
        $smartwatches = SubSubcategory::firstOrCreate([
            'name' => 'Smartwatches',
            'subcategory_id' => $wearableSubcategory->id
        ]);

        $fitnessTrackers = SubSubcategory::firstOrCreate([
            'name' => 'Fitness Trackers',
            'subcategory_id' => $wearableSubcategory->id
        ]);

        $vrHeadsets = SubSubcategory::firstOrCreate([
            'name' => 'VR Headsets',
            'subcategory_id' => $wearableSubcategory->id
        ]);

        // Home Security sub-subcategories
        $securityCameras = SubSubcategory::firstOrCreate([
            'name' => 'Security Cameras',
            'subcategory_id' => $homeSecuritySubcategory->id
        ]);

        $doorbell = SubSubcategory::firstOrCreate([
            'name' => 'Smart Doorbells',
            'subcategory_id' => $homeSecuritySubcategory->id
        ]);

        $alarmSystems = SubSubcategory::firstOrCreate([
            'name' => 'Alarm Systems',
            'subcategory_id' => $homeSecuritySubcategory->id
        ]);

        // Portable Electronics sub-subcategories
        $powerBanks = SubSubcategory::firstOrCreate([
            'name' => 'Power Banks',
            'subcategory_id' => $portableElectronicsSubcategory->id
        ]);

        $bluetoothDevices = SubSubcategory::firstOrCreate([
            'name' => 'Bluetooth Devices',
            'subcategory_id' => $portableElectronicsSubcategory->id
        ]);

        $chargersAdapters = SubSubcategory::firstOrCreate([
            'name' => 'Chargers & Adapters',
            'subcategory_id' => $portableElectronicsSubcategory->id
        ]);

        // Get existing vendor and shop
        $vendor = Vendor::first();
        if (!$vendor) {
            $vendor = Vendor::create([
                'name' => 'Electronics Superstore',
                'email' => 'vendor@electronics.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Electronics Avenue',
                'status' => 'approved',
            ]);
        }

        $shop = Shop::first();
        if (!$shop) {
            $shop = Shop::create([
                'vendor_id' => $vendor->id,
                'shop_name' => 'ElectroWorld',
                'shop_description' => 'Your ultimate destination for electronics',
                'shop_logo' => 'default-shop-logo.png'
            ]);
        }

        // Electronics Products data
        $electronicsProducts = [
            // Audio & Video Products
            [
                'product_name' => 'Sony WH-1000XM5 Wireless Headphones',
                'product_description' => 'Industry-leading noise canceling with Auto NC Optimizer, exceptional sound quality, crystal clear hands-free calling.',
                'subcategory_id' => $audioVideoSubcategory->id,
                'sub_subcategory_id' => $headphones->id,
                'normal_price' => 34999.99,
                'quantity' => 25,
                'tags' => 'Sony, Wireless, Noise Canceling, Headphones, Bluetooth',
                'is_affiliate' => true,
                'affiliate_price' => 32999.99,
                'commission_percentage' => 4.00,
                'bv' => 250,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+WH-1000XM5+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+WH-1000XM5+2',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+WH-1000XM5+3'
                ]
            ],
            [
                'product_name' => 'JBL Flip 6 Portable Bluetooth Speaker',
                'product_description' => 'Bold JBL Original Pro Sound with IP67 waterproof and dustproof rating. 12 hours of playtime with wireless Bluetooth streaming.',
                'subcategory_id' => $audioVideoSubcategory->id,
                'sub_subcategory_id' => $speakers->id,
                'normal_price' => 8999.99,
                'quantity' => 40,
                'tags' => 'JBL, Bluetooth, Portable, Waterproof, Speaker',
                'is_affiliate' => false,
                'bv' => 75,
                'images' => [
                    'https://via.placeholder.com/500x400/FF6B35/FFFFFF?text=JBL+Flip+6+1',
                    'https://via.placeholder.com/500x400/FF6B35/FFFFFF?text=JBL+Flip+6+2'
                ]
            ],
            [
                'product_name' => 'Samsung HW-Q990B Soundbar',
                'product_description' => '11.1.4ch soundbar with Dolby Atmos, DTS:X, wireless rear speakers, and Q-Symphony technology for immersive audio.',
                'subcategory_id' => $audioVideoSubcategory->id,
                'sub_subcategory_id' => $soundbars->id,
                'normal_price' => 149999.99,
                'quantity' => 10,
                'tags' => 'Samsung, Soundbar, Dolby Atmos, Wireless, Premium',
                'is_affiliate' => true,
                'affiliate_price' => 139999.99,
                'commission_percentage' => 3.00,
                'bv' => 800,
                'images' => [
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+Soundbar+1',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+Soundbar+2'
                ]
            ],

            // Cameras & Photography
            [
                'product_name' => 'Canon EOS R6 Mark II Mirrorless Camera',
                'product_description' => '24.2MP full-frame CMOS sensor with DIGIC X processor, 4K 60p video recording, and advanced dual pixel CMOS AF II.',
                'subcategory_id' => $camerasSubcategory->id,
                'sub_subcategory_id' => $digitalCameras->id,
                'normal_price' => 249999.99,
                'quantity' => 8,
                'tags' => 'Canon, DSLR, Mirrorless, 4K Video, Professional',
                'is_affiliate' => true,
                'affiliate_price' => 239999.99,
                'commission_percentage' => 2.50,
                'bv' => 1500,
                'images' => [
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=Canon+EOS+R6+1',
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=Canon+EOS+R6+2',
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=Canon+EOS+R6+3'
                ]
            ],
            [
                'product_name' => 'GoPro HERO12 Black Action Camera',
                'product_description' => 'Revolutionary HyperSmooth 6.0 stabilization, 5.3K60 video recording, waterproof to 33ft, with enhanced low-light performance.',
                'subcategory_id' => $camerasSubcategory->id,
                'sub_subcategory_id' => $actionCameras->id,
                'normal_price' => 44999.99,
                'quantity' => 15,
                'tags' => 'GoPro, Action Camera, 5.3K, Waterproof, Stabilization',
                'is_affiliate' => false,
                'bv' => 350,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=GoPro+HERO12+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=GoPro+HERO12+2'
                ]
            ],

            // Gaming Consoles
            [
                'product_name' => 'Sony PlayStation 5 Console',
                'product_description' => 'Experience lightning-fast loading with an ultra-high speed SSD, deeper immersion with haptic feedback, and 3D Audio technology.',
                'subcategory_id' => $gamingSubcategory->id,
                'sub_subcategory_id' => $playstation->id,
                'normal_price' => 54999.99,
                'quantity' => 12,
                'tags' => 'PlayStation 5, Gaming Console, SSD, Haptic Feedback, Sony',
                'is_affiliate' => true,
                'affiliate_price' => 52999.99,
                'commission_percentage' => 3.50,
                'bv' => 400,
                'images' => [
                    'https://via.placeholder.com/500x400/003791/FFFFFF?text=PlayStation+5+1',
                    'https://via.placeholder.com/500x400/003791/FFFFFF?text=PlayStation+5+2',
                    'https://via.placeholder.com/500x400/003791/FFFFFF?text=PlayStation+5+3'
                ]
            ],
            [
                'product_name' => 'Microsoft Xbox Series X Console',
                'product_description' => 'Most powerful Xbox ever with 12 teraflops of GPU performance, 4K gaming, and backward compatibility with thousands of games.',
                'subcategory_id' => $gamingSubcategory->id,
                'sub_subcategory_id' => $xbox->id,
                'normal_price' => 54999.99,
                'quantity' => 10,
                'tags' => 'Xbox Series X, Gaming Console, 4K Gaming, Microsoft, Teraflops',
                'is_affiliate' => true,
                'affiliate_price' => 52999.99,
                'commission_percentage' => 3.50,
                'bv' => 400,
                'images' => [
                    'https://via.placeholder.com/500x400/107C10/FFFFFF?text=Xbox+Series+X+1',
                    'https://via.placeholder.com/500x400/107C10/FFFFFF?text=Xbox+Series+X+2'
                ]
            ],
            [
                'product_name' => 'Nintendo Switch OLED Console',
                'product_description' => '7-inch OLED screen with vivid colors and crisp contrast. Enhanced audio for handheld and tabletop play with 64GB internal storage.',
                'subcategory_id' => $gamingSubcategory->id,
                'sub_subcategory_id' => $nintendo->id,
                'normal_price' => 34999.99,
                'quantity' => 18,
                'tags' => 'Nintendo Switch, OLED, Handheld, Gaming Console, Portable',
                'is_affiliate' => false,
                'bv' => 250,
                'images' => [
                    'https://via.placeholder.com/500x400/E60012/FFFFFF?text=Nintendo+Switch+1',
                    'https://via.placeholder.com/500x400/E60012/FFFFFF?text=Nintendo+Switch+2'
                ]
            ],

            // Wearable Technology
            [
                'product_name' => 'Apple Watch Series 9 GPS + Cellular',
                'product_description' => 'Most advanced Apple Watch with S9 SiP, double tap gesture, precision finding for iPhone, and comprehensive health monitoring.',
                'subcategory_id' => $wearableSubcategory->id,
                'sub_subcategory_id' => $smartwatches->id,
                'normal_price' => 54900.99,
                'quantity' => 20,
                'tags' => 'Apple Watch, Smartwatch, GPS, Cellular, Health Monitoring',
                'is_affiliate' => true,
                'affiliate_price' => 52900.99,
                'commission_percentage' => 3.00,
                'bv' => 400,
                'images' => [
                    'https://via.placeholder.com/500x400/A8DADC/000000?text=Apple+Watch+1',
                    'https://via.placeholder.com/500x400/A8DADC/000000?text=Apple+Watch+2'
                ]
            ],
            [
                'product_name' => 'Fitbit Charge 6 Fitness Tracker',
                'product_description' => 'Built-in GPS, heart rate monitoring, sleep score, stress management tools, and 6+ day battery life with Google apps.',
                'subcategory_id' => $wearableSubcategory->id,
                'sub_subcategory_id' => $fitnessTrackers->id,
                'normal_price' => 15999.99,
                'quantity' => 30,
                'tags' => 'Fitbit, Fitness Tracker, GPS, Heart Rate, Sleep Monitoring',
                'is_affiliate' => true,
                'affiliate_price' => 14999.99,
                'commission_percentage' => 6.00,
                'bv' => 120,
                'images' => [
                    'https://via.placeholder.com/500x400/4285F4/FFFFFF?text=Fitbit+Charge+6+1',
                    'https://via.placeholder.com/500x400/4285F4/FFFFFF?text=Fitbit+Charge+6+2'
                ]
            ],
            [
                'product_name' => 'Meta Quest 3 VR Headset',
                'product_description' => 'Mixed reality headset with 4K+ Infinite Display, breakthrough Meta Reality technology, and immersive spatial audio.',
                'subcategory_id' => $wearableSubcategory->id,
                'sub_subcategory_id' => $vrHeadsets->id,
                'normal_price' => 54999.99,
                'quantity' => 8,
                'tags' => 'Meta Quest 3, VR Headset, Mixed Reality, 4K Display, Immersive',
                'is_affiliate' => true,
                'affiliate_price' => 52999.99,
                'commission_percentage' => 3.00,
                'bv' => 400,
                'images' => [
                    'https://via.placeholder.com/500x400/1877F2/FFFFFF?text=Meta+Quest+3+1',
                    'https://via.placeholder.com/500x400/1877F2/FFFFFF?text=Meta+Quest+3+2'
                ]
            ],

            // Home Security
            [
                'product_name' => 'Ring Video Doorbell Pro 2',
                'product_description' => 'Advanced motion detection, 1536p HD video, enhanced wifi, 3D motion detection, and Works with Alexa.',
                'subcategory_id' => $homeSecuritySubcategory->id,
                'sub_subcategory_id' => $doorbell->id,
                'normal_price' => 24999.99,
                'quantity' => 25,
                'tags' => 'Ring, Video Doorbell, HD Video, Motion Detection, Alexa',
                'is_affiliate' => true,
                'affiliate_price' => 22999.99,
                'commission_percentage' => 5.00,
                'bv' => 180,
                'images' => [
                    'https://via.placeholder.com/500x400/FF9900/FFFFFF?text=Ring+Doorbell+1',
                    'https://via.placeholder.com/500x400/FF9900/FFFFFF?text=Ring+Doorbell+2'
                ]
            ],
            [
                'product_name' => 'Arlo Pro 5S 2K Security Camera',
                'product_description' => 'Wire-free 2K HDR security camera with color night vision, 2-way audio, advanced motion detection, and cloud storage.',
                'subcategory_id' => $homeSecuritySubcategory->id,
                'sub_subcategory_id' => $securityCameras->id,
                'normal_price' => 29999.99,
                'quantity' => 15,
                'tags' => 'Arlo, Security Camera, 2K HDR, Night Vision, Wire-free',
                'is_affiliate' => false,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/500x400/0E6BA8/FFFFFF?text=Arlo+Pro+5S+1',
                    'https://via.placeholder.com/500x400/0E6BA8/FFFFFF?text=Arlo+Pro+5S+2'
                ]
            ],

            // Portable Electronics
            [
                'product_name' => 'Anker PowerCore 26800 Power Bank',
                'product_description' => 'Ultra-high capacity portable charger with PowerIQ and VoltageBoost technology for universal charging compatibility.',
                'subcategory_id' => $portableElectronicsSubcategory->id,
                'sub_subcategory_id' => $powerBanks->id,
                'normal_price' => 5999.99,
                'quantity' => 50,
                'tags' => 'Anker, Power Bank, 26800mAh, Fast Charging, Portable',
                'is_affiliate' => true,
                'affiliate_price' => 5499.99,
                'commission_percentage' => 8.00,
                'bv' => 45,
                'images' => [
                    'https://via.placeholder.com/500x400/1F2937/FFFFFF?text=Anker+PowerCore+1',
                    'https://via.placeholder.com/500x400/1F2937/FFFFFF?text=Anker+PowerCore+2'
                ]
            ],
            [
                'product_name' => 'Bose SoundLink Flex Bluetooth Speaker',
                'product_description' => 'Waterproof portable Bluetooth speaker with crisp, clear sound and deep bass. IP67 rating for outdoor adventures.',
                'subcategory_id' => $portableElectronicsSubcategory->id,
                'sub_subcategory_id' => $bluetoothDevices->id,
                'normal_price' => 14999.99,
                'quantity' => 35,
                'tags' => 'Bose, Bluetooth Speaker, Waterproof, Portable, Deep Bass',
                'is_affiliate' => true,
                'affiliate_price' => 13999.99,
                'commission_percentage' => 6.50,
                'bv' => 110,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Bose+SoundLink+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Bose+SoundLink+2'
                ]
            ]
        ];

        foreach ($electronicsProducts as $productData) {
            // Generate unique product ID
            $productId = 'EL-' . strtoupper(Str::random(8));

            // Calculate commission price for affiliate products
            $commissionPrice = null;
            if ($productData['is_affiliate'] && isset($productData['commission_percentage'])) {
                $basePrice = $productData['affiliate_price'] ?? $productData['normal_price'];
                $commissionPrice = $basePrice * ($productData['commission_percentage'] / 100);
            }

            $product = Product::create([
                'product_id' => $productId,
                'shop_id' => $shop->id,
                'product_name' => $productData['product_name'],
                'product_description' => $productData['product_description'],
                'category_id' => $electronicsCategory->id,
                'subcategory_id' => $productData['subcategory_id'],
                'sub_subcategory_id' => $productData['sub_subcategory_id'],
                'quantity' => $productData['quantity'],
                'tags' => $productData['tags'],
                'normal_price' => $productData['normal_price'],
                'is_affiliate' => $productData['is_affiliate'],
                'affiliate_price' => $productData['affiliate_price'] ?? null,
                'commission_percentage' => $productData['commission_percentage'] ?? null,
                'commission_price' => $commissionPrice,
                'bv' => $productData['bv'] ?? 0,
            ]);

            // Add product images
            $productImages = $productData['images'] ?? [];

            foreach ($productImages as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_path' => $imageUrl
                ]);
            }

            $this->command->info("Created Electronics product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('Electronics products seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- Electronics category');
        $this->command->info('- 6 subcategories (Audio & Video, Cameras & Photography, Gaming Consoles, Wearable Technology, Home Security, Portable Electronics)');
        $this->command->info('- 18 sub-subcategories');
        $this->command->info('- ' . count($electronicsProducts) . ' electronics products with images');
    }
}
