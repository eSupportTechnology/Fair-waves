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

class AppleProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Apple category
        $appleCategory = Category::firstOrCreate(['name' => 'Apple']);

        // Create subcategories
        $iphoneSubcategory = Subcategory::firstOrCreate([
            'name' => 'iPhone',
            'category_id' => $appleCategory->id
        ]);

        $ipadSubcategory = Subcategory::firstOrCreate([
            'name' => 'iPad',
            'category_id' => $appleCategory->id
        ]);

        $macSubcategory = Subcategory::firstOrCreate([
            'name' => 'Mac',
            'category_id' => $appleCategory->id
        ]);

        $appleWatchSubcategory = Subcategory::firstOrCreate([
            'name' => 'Apple Watch',
            'category_id' => $appleCategory->id
        ]);

        $airPodsSubcategory = Subcategory::firstOrCreate([
            'name' => 'AirPods',
            'category_id' => $appleCategory->id
        ]);

        $appleAccessoriesSubcategory = Subcategory::firstOrCreate([
            'name' => 'Apple Accessories',
            'category_id' => $appleCategory->id
        ]);

        // Create sub-subcategories for each subcategory
        // iPhone sub-subcategories
        $iphone15Series = SubSubcategory::firstOrCreate([
            'name' => 'iPhone 15 Series',
            'subcategory_id' => $iphoneSubcategory->id
        ]);

        $iphone14Series = SubSubcategory::firstOrCreate([
            'name' => 'iPhone 14 Series',
            'subcategory_id' => $iphoneSubcategory->id
        ]);

        $iphoneSE = SubSubcategory::firstOrCreate([
            'name' => 'iPhone SE',
            'subcategory_id' => $iphoneSubcategory->id
        ]);

        // iPad sub-subcategories
        $ipadPro = SubSubcategory::firstOrCreate([
            'name' => 'iPad Pro',
            'subcategory_id' => $ipadSubcategory->id
        ]);

        $ipadAir = SubSubcategory::firstOrCreate([
            'name' => 'iPad Air',
            'subcategory_id' => $ipadSubcategory->id
        ]);

        $ipadRegular = SubSubcategory::firstOrCreate([
            'name' => 'iPad',
            'subcategory_id' => $ipadSubcategory->id
        ]);

        // Mac sub-subcategories
        $macbook = SubSubcategory::firstOrCreate([
            'name' => 'MacBook',
            'subcategory_id' => $macSubcategory->id
        ]);

        $imac = SubSubcategory::firstOrCreate([
            'name' => 'iMac',
            'subcategory_id' => $macSubcategory->id
        ]);

        $macMini = SubSubcategory::firstOrCreate([
            'name' => 'Mac Mini',
            'subcategory_id' => $macSubcategory->id
        ]);

        // Apple Watch sub-subcategories
        $appleWatchSeries = SubSubcategory::firstOrCreate([
            'name' => 'Apple Watch Series',
            'subcategory_id' => $appleWatchSubcategory->id
        ]);

        $appleWatchSE = SubSubcategory::firstOrCreate([
            'name' => 'Apple Watch SE',
            'subcategory_id' => $appleWatchSubcategory->id
        ]);

        $appleWatchUltra = SubSubcategory::firstOrCreate([
            'name' => 'Apple Watch Ultra',
            'subcategory_id' => $appleWatchSubcategory->id
        ]);

        // AirPods sub-subcategories
        $airPodsPro = SubSubcategory::firstOrCreate([
            'name' => 'AirPods Pro',
            'subcategory_id' => $airPodsSubcategory->id
        ]);

        $airPodsRegular = SubSubcategory::firstOrCreate([
            'name' => 'AirPods',
            'subcategory_id' => $airPodsSubcategory->id
        ]);

        $airPodsMax = SubSubcategory::firstOrCreate([
            'name' => 'AirPods Max',
            'subcategory_id' => $airPodsSubcategory->id
        ]);

        // Apple Accessories sub-subcategories
        $chargingAccessories = SubSubcategory::firstOrCreate([
            'name' => 'Charging Accessories',
            'subcategory_id' => $appleAccessoriesSubcategory->id
        ]);

        $appleCases = SubSubcategory::firstOrCreate([
            'name' => 'Cases & Protection',
            'subcategory_id' => $appleAccessoriesSubcategory->id
        ]);

        // Get existing vendor and shop
        $vendor = Vendor::first();
        if (!$vendor) {
            $vendor = Vendor::create([
                'name' => 'Apple Authorized Store',
                'email' => 'vendor@applestore.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Apple Street',
                'status' => 'approved',
            ]);
        }

        $shop = Shop::first();
        if (!$shop) {
            $shop = Shop::create([
                'vendor_id' => $vendor->id,
                'shop_name' => 'Apple Store',
                'shop_description' => 'Official Apple products and accessories',
                'shop_logo' => 'default-shop-logo.png'
            ]);
        }

        // Apple Products data
        $appleProducts = [
            // iPhone Products
            [
                'product_name' => 'iPhone 15 Pro Max 256GB',
                'product_description' => 'The ultimate iPhone with titanium design, A17 Pro chip, and advanced camera system. Features include 6.7" Super Retina XDR display, Action Button, and USB-C.',
                'subcategory_id' => $iphoneSubcategory->id,
                'sub_subcategory_id' => $iphone15Series->id,
                'normal_price' => 159900.99,
                'quantity' => 15,
                'tags' => 'iPhone, 15 Pro Max, Titanium, A17 Pro, Camera, USB-C',
                'is_affiliate' => true,
                'affiliate_price' => 154900.99,
                'commission_percentage' => 2.50,
                'bv' => 1000,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=iPhone+15+Pro+Max+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=iPhone+15+Pro+Max+2',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=iPhone+15+Pro+Max+3'
                ]
            ],
            [
                'product_name' => 'iPhone 15 128GB',
                'product_description' => 'The new iPhone 15 with Dynamic Island, A16 Bionic chip, and advanced dual-camera system. Features include 6.1" Super Retina XDR display and USB-C.',
                'subcategory_id' => $iphoneSubcategory->id,
                'sub_subcategory_id' => $iphone15Series->id,
                'normal_price' => 79900.99,
                'quantity' => 25,
                'tags' => 'iPhone, 15, Dynamic Island, A16 Bionic, Dual Camera, USB-C',
                'is_affiliate' => true,
                'affiliate_price' => 77900.99,
                'commission_percentage' => 3.00,
                'bv' => 500,
                'images' => [
                    'https://via.placeholder.com/500x400/FF69B4/FFFFFF?text=iPhone+15+1',
                    'https://via.placeholder.com/500x400/FF69B4/FFFFFF?text=iPhone+15+2',
                    'https://via.placeholder.com/500x400/FF69B4/FFFFFF?text=iPhone+15+3'
                ]
            ],
            [
                'product_name' => 'iPhone SE 3rd Generation 128GB',
                'product_description' => 'The most affordable iPhone with A15 Bionic chip and classic design. Features include 4.7" Retina HD display, Touch ID, and wireless charging.',
                'subcategory_id' => $iphoneSubcategory->id,
                'sub_subcategory_id' => $iphoneSE->id,
                'normal_price' => 47900.99,
                'quantity' => 30,
                'tags' => 'iPhone, SE, A15 Bionic, Touch ID, Affordable, Compact',
                'is_affiliate' => false,
                'bv' => 300,
                'images' => [
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=iPhone+SE+1',
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=iPhone+SE+2'
                ]
            ],

            // iPad Products
            [
                'product_name' => 'iPad Pro 12.9" M2 256GB WiFi',
                'product_description' => 'The ultimate iPad experience with M2 chip, Liquid Retina XDR display, and Apple Pencil support. Perfect for professional workflows and creative tasks.',
                'subcategory_id' => $ipadSubcategory->id,
                'sub_subcategory_id' => $ipadPro->id,
                'normal_price' => 109900.99,
                'quantity' => 10,
                'tags' => 'iPad Pro, M2 Chip, Liquid Retina XDR, Apple Pencil, Professional',
                'is_affiliate' => true,
                'affiliate_price' => 106900.99,
                'commission_percentage' => 2.75,
                'bv' => 700,
                'images' => [
                    'https://via.placeholder.com/500x400/708090/FFFFFF?text=iPad+Pro+12.9+1',
                    'https://via.placeholder.com/500x400/708090/FFFFFF?text=iPad+Pro+12.9+2',
                    'https://via.placeholder.com/500x400/708090/FFFFFF?text=iPad+Pro+12.9+3'
                ]
            ],
            [
                'product_name' => 'iPad Air 5th Generation 256GB WiFi',
                'product_description' => 'Powerful and versatile iPad with M1 chip, 10.9" Liquid Retina display, and advanced cameras. Compatible with Apple Pencil and Magic Keyboard.',
                'subcategory_id' => $ipadSubcategory->id,
                'sub_subcategory_id' => $ipadAir->id,
                'normal_price' => 74900.99,
                'quantity' => 18,
                'tags' => 'iPad Air, M1 Chip, Liquid Retina, Apple Pencil, Magic Keyboard',
                'is_affiliate' => true,
                'affiliate_price' => 72900.99,
                'commission_percentage' => 3.50,
                'bv' => 450,
                'images' => [
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=iPad+Air+1',
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=iPad+Air+2'
                ]
            ],
            [
                'product_name' => 'iPad 10th Generation 256GB WiFi',
                'product_description' => 'Colorfully reimagined iPad with A14 Bionic chip, 10.9" Liquid Retina display, and USB-C. Perfect for everyday tasks and creativity.',
                'subcategory_id' => $ipadSubcategory->id,
                'sub_subcategory_id' => $ipadRegular->id,
                'normal_price' => 54900.99,
                'quantity' => 22,
                'tags' => 'iPad, A14 Bionic, Liquid Retina, USB-C, Colorful, Everyday',
                'is_affiliate' => false,
                'bv' => 350,
                'images' => [
                    'https://via.placeholder.com/500x400/FFD700/000000?text=iPad+10th+Gen+1',
                    'https://via.placeholder.com/500x400/FFD700/000000?text=iPad+10th+Gen+2'
                ]
            ],

            // Mac Products
            [
                'product_name' => 'MacBook Pro 16" M3 Pro 512GB',
                'product_description' => 'The most powerful MacBook Pro with M3 Pro chip, 16" Liquid Retina XDR display, and up to 22 hours of battery life. Perfect for professionals.',
                'subcategory_id' => $macSubcategory->id,
                'sub_subcategory_id' => $macbook->id,
                'normal_price' => 249900.99,
                'quantity' => 8,
                'tags' => 'MacBook Pro, M3 Pro, Liquid Retina XDR, Professional, Performance',
                'is_affiliate' => true,
                'affiliate_price' => 244900.99,
                'commission_percentage' => 2.00,
                'bv' => 1500,
                'images' => [
                    'https://via.placeholder.com/500x400/2F4F4F/FFFFFF?text=MacBook+Pro+16+1',
                    'https://via.placeholder.com/500x400/2F4F4F/FFFFFF?text=MacBook+Pro+16+2'
                ]
            ],
            [
                'product_name' => 'iMac 24" M3 256GB',
                'product_description' => 'Stunningly thin all-in-one desktop with M3 chip, 24" 4.5K Retina display, and vibrant colors. Perfect for home and office use.',
                'subcategory_id' => $macSubcategory->id,
                'sub_subcategory_id' => $imac->id,
                'normal_price' => 134900.99,
                'quantity' => 12,
                'tags' => 'iMac, M3 Chip, 4.5K Retina, All-in-One, Colorful, Desktop',
                'is_affiliate' => true,
                'affiliate_price' => 131900.99,
                'commission_percentage' => 2.25,
                'bv' => 850,
                'images' => [
                    'https://via.placeholder.com/500x400/00CED1/FFFFFF?text=iMac+24+M3+1',
                    'https://via.placeholder.com/500x400/00CED1/FFFFFF?text=iMac+24+M3+2'
                ]
            ],
            [
                'product_name' => 'Mac Mini M2 256GB',
                'product_description' => 'Compact and powerful desktop with M2 chip. Perfect for professional workflows, creative projects, and everyday computing in a small form factor.',
                'subcategory_id' => $macSubcategory->id,
                'sub_subcategory_id' => $macMini->id,
                'normal_price' => 59900.99,
                'quantity' => 15,
                'tags' => 'Mac Mini, M2 Chip, Compact, Desktop, Professional, Small Form',
                'is_affiliate' => false,
                'bv' => 380,
                'images' => [
                    'https://via.placeholder.com/500x400/696969/FFFFFF?text=Mac+Mini+M2+1',
                    'https://via.placeholder.com/500x400/696969/FFFFFF?text=Mac+Mini+M2+2'
                ]
            ],

            // Apple Watch Products
            [
                'product_name' => 'Apple Watch Series 9 GPS 45mm',
                'product_description' => 'The most advanced Apple Watch with S9 chip, Double Tap gesture, and brightest always-on Retina display. Advanced health and fitness tracking.',
                'subcategory_id' => $appleWatchSubcategory->id,
                'sub_subcategory_id' => $appleWatchSeries->id,
                'normal_price' => 42900.99,
                'quantity' => 20,
                'tags' => 'Apple Watch, Series 9, S9 Chip, Double Tap, Health Tracking',
                'is_affiliate' => true,
                'affiliate_price' => 41900.99,
                'commission_percentage' => 4.00,
                'bv' => 250,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Apple+Watch+S9+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Apple+Watch+S9+2'
                ]
            ],
            [
                'product_name' => 'Apple Watch Ultra 2 49mm',
                'product_description' => 'The most rugged Apple Watch with titanium case, brightest display, and precision dual-frequency GPS. Built for extreme adventures.',
                'subcategory_id' => $appleWatchSubcategory->id,
                'sub_subcategory_id' => $appleWatchUltra->id,
                'normal_price' => 89900.99,
                'quantity' => 12,
                'tags' => 'Apple Watch Ultra, Titanium, Rugged, GPS, Adventure, Extreme',
                'is_affiliate' => true,
                'affiliate_price' => 87900.99,
                'commission_percentage' => 3.00,
                'bv' => 550,
                'images' => [
                    'https://via.placeholder.com/500x400/FF4500/FFFFFF?text=Apple+Watch+Ultra+2+1',
                    'https://via.placeholder.com/500x400/FF4500/FFFFFF?text=Apple+Watch+Ultra+2+2'
                ]
            ],

            // AirPods Products
            [
                'product_name' => 'AirPods Pro 2nd Generation',
                'product_description' => 'Premium wireless earphones with active noise cancellation, spatial audio, and adaptive transparency. Up to 2x more noise cancellation.',
                'subcategory_id' => $airPodsSubcategory->id,
                'sub_subcategory_id' => $airPodsPro->id,
                'normal_price' => 24900.99,
                'quantity' => 35,
                'tags' => 'AirPods Pro, Noise Cancellation, Spatial Audio, Adaptive Transparency',
                'is_affiliate' => true,
                'affiliate_price' => 23900.99,
                'commission_percentage' => 4.50,
                'bv' => 150,
                'images' => [
                    'https://via.placeholder.com/500x400/FFFFFF/000000?text=AirPods+Pro+2+1',
                    'https://via.placeholder.com/500x400/FFFFFF/000000?text=AirPods+Pro+2+2'
                ]
            ],
            [
                'product_name' => 'AirPods 3rd Generation',
                'product_description' => 'Wireless earphones with spatial audio and dynamic head tracking. Features include sweat and water resistance and up to 30 hours of battery life.',
                'subcategory_id' => $airPodsSubcategory->id,
                'sub_subcategory_id' => $airPodsRegular->id,
                'normal_price' => 18900.99,
                'quantity' => 40,
                'tags' => 'AirPods, Spatial Audio, Water Resistant, Long Battery, Wireless',
                'is_affiliate' => false,
                'bv' => 120,
                'images' => [
                    'https://via.placeholder.com/500x400/F0F8FF/000000?text=AirPods+3rd+Gen+1',
                    'https://via.placeholder.com/500x400/F0F8FF/000000?text=AirPods+3rd+Gen+2'
                ]
            ],
            [
                'product_name' => 'AirPods Max',
                'product_description' => 'Over-ear headphones with high-fidelity audio, active noise cancellation, and spatial audio. Features include premium materials and 20-hour battery life.',
                'subcategory_id' => $airPodsSubcategory->id,
                'sub_subcategory_id' => $airPodsMax->id,
                'normal_price' => 59900.99,
                'quantity' => 15,
                'tags' => 'AirPods Max, Over-ear, High Fidelity, Noise Cancellation, Premium',
                'is_affiliate' => true,
                'affiliate_price' => 57900.99,
                'commission_percentage' => 3.50,
                'bv' => 380,
                'images' => [
                    'https://via.placeholder.com/500x400/C0C0C0/000000?text=AirPods+Max+1',
                    'https://via.placeholder.com/500x400/C0C0C0/000000?text=AirPods+Max+2'
                ]
            ],

            // Apple Accessories
            [
                'product_name' => 'MagSafe Charger',
                'product_description' => 'Wireless charger with perfectly aligned magnets for faster wireless charging up to 15W. Compatible with iPhone 12 and later models.',
                'subcategory_id' => $appleAccessoriesSubcategory->id,
                'sub_subcategory_id' => $chargingAccessories->id,
                'normal_price' => 4500.99,
                'quantity' => 60,
                'tags' => 'MagSafe, Wireless Charging, Magnets, iPhone, Fast Charging',
                'is_affiliate' => true,
                'affiliate_price' => 4200.99,
                'commission_percentage' => 6.50,
                'bv' => 30,
                'images' => [
                    'https://via.placeholder.com/500x400/DCDCDC/000000?text=MagSafe+Charger+1',
                    'https://via.placeholder.com/500x400/DCDCDC/000000?text=MagSafe+Charger+2'
                ]
            ],
            [
                'product_name' => 'iPhone 15 Pro Silicone Case',
                'product_description' => 'Official Apple silicone case with MagSafe compatibility. Soft-touch finish with microfiber lining for protection and style.',
                'subcategory_id' => $appleAccessoriesSubcategory->id,
                'sub_subcategory_id' => $appleCases->id,
                'normal_price' => 4900.99,
                'quantity' => 80,
                'tags' => 'iPhone Case, Silicone, MagSafe, Apple Official, Protection',
                'is_affiliate' => false,
                'bv' => 35,
                'images' => [
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=iPhone+15+Case+1',
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=iPhone+15+Case+2'
                ]
            ]
        ];

        foreach ($appleProducts as $productData) {
            // Generate unique product ID
            $productId = 'AP-' . strtoupper(Str::random(8));

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
                'category_id' => $appleCategory->id,
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

            $this->command->info("Created Apple product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('Apple products seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- Apple category');
        $this->command->info('- 6 subcategories (iPhone, iPad, Mac, Apple Watch, AirPods, Apple Accessories)');
        $this->command->info('- 15 sub-subcategories');
        $this->command->info('- ' . count($appleProducts) . ' Apple products with images');
    }
}
