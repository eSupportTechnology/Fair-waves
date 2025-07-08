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

class MobilePhoneSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Mobile Phones & Devices category
        $mobileCategory = Category::firstOrCreate(['name' => 'Mobile Phones & Devices']);

        // Create subcategories
        $smartphoneSubcategory = Subcategory::firstOrCreate([
            'name' => 'Smartphones',
            'category_id' => $mobileCategory->id
        ]);

        $tabletSubcategory = Subcategory::firstOrCreate([
            'name' => 'Tablets',
            'category_id' => $mobileCategory->id
        ]);

        $accessoriesSubcategory = Subcategory::firstOrCreate([
            'name' => 'Mobile Accessories',
            'category_id' => $mobileCategory->id
        ]);

        $smartwatchSubcategory = Subcategory::firstOrCreate([
            'name' => 'Smartwatches',
            'category_id' => $mobileCategory->id
        ]);

        $powerBankSubcategory = Subcategory::firstOrCreate([
            'name' => 'Power Banks',
            'category_id' => $mobileCategory->id
        ]);

        $headphonesSubcategory = Subcategory::firstOrCreate([
            'name' => 'Headphones & Earphones',
            'category_id' => $mobileCategory->id
        ]);

        // Create sub-subcategories for each subcategory
        // Smartphone sub-subcategories
        $androidPhone = SubSubcategory::firstOrCreate([
            'name' => 'Android Phones',
            'subcategory_id' => $smartphoneSubcategory->id
        ]);

        $iphone = SubSubcategory::firstOrCreate([
            'name' => 'iPhones',
            'subcategory_id' => $smartphoneSubcategory->id
        ]);

        // Tablet sub-subcategories
        $androidTablet = SubSubcategory::firstOrCreate([
            'name' => 'Android Tablets',
            'subcategory_id' => $tabletSubcategory->id
        ]);

        $ipad = SubSubcategory::firstOrCreate([
            'name' => 'iPads',
            'subcategory_id' => $tabletSubcategory->id
        ]);

        // Mobile Accessories sub-subcategories
        $mobileCase = SubSubcategory::firstOrCreate([
            'name' => 'Mobile Cases',
            'subcategory_id' => $accessoriesSubcategory->id
        ]);

        $screenProtector = SubSubcategory::firstOrCreate([
            'name' => 'Screen Protectors',
            'subcategory_id' => $accessoriesSubcategory->id
        ]);

        // Smartwatch sub-subcategories
        $appleWatch = SubSubcategory::firstOrCreate([
            'name' => 'Apple Watch',
            'subcategory_id' => $smartwatchSubcategory->id
        ]);

        $androidWatch = SubSubcategory::firstOrCreate([
            'name' => 'Android Watches',
            'subcategory_id' => $smartwatchSubcategory->id
        ]);

        // Power Bank sub-subcategories
        $fastChargingPowerBank = SubSubcategory::firstOrCreate([
            'name' => 'Fast Charging',
            'subcategory_id' => $powerBankSubcategory->id
        ]);

        $wirelessPowerBank = SubSubcategory::firstOrCreate([
            'name' => 'Wireless Power Banks',
            'subcategory_id' => $powerBankSubcategory->id
        ]);

        // Headphones sub-subcategories
        $wirelessEarphones = SubSubcategory::firstOrCreate([
            'name' => 'Wireless Earphones',
            'subcategory_id' => $headphonesSubcategory->id
        ]);

        $wiredHeadphones = SubSubcategory::firstOrCreate([
            'name' => 'Wired Headphones',
            'subcategory_id' => $headphonesSubcategory->id
        ]);

        // Get existing vendor and shop
        $vendor = Vendor::first();
        if (!$vendor) {
            $vendor = Vendor::create([
                'name' => 'Mobile Store',
                'email' => 'vendor@mobilestore.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Mobile Street',
                'status' => 'approved',
            ]);
        }

        $shop = Shop::first();
        if (!$shop) {
            $shop = Shop::create([
                'vendor_id' => $vendor->id,
                'shop_name' => 'MobileMart',
                'shop_description' => 'Your one-stop shop for mobile devices',
                'shop_logo' => 'default-shop-logo.png'
            ]);
        }

        // Mobile Phone Products data
        $mobileProducts = [
            // Smartphones
            [
                'product_name' => 'Samsung Galaxy S24 Ultra 256GB',
                'product_description' => 'Premium flagship smartphone with S Pen, 200MP camera, and AI features. Features include 6.8" Dynamic AMOLED display, Snapdragon 8 Gen 3 processor.',
                'subcategory_id' => $smartphoneSubcategory->id,
                'sub_subcategory_id' => $androidPhone->id,
                'normal_price' => 124999.99,
                'quantity' => 20,
                'tags' => 'Samsung, Galaxy, S24 Ultra, Android, Flagship, Camera',
                'is_affiliate' => true,
                'affiliate_price' => 119999.99,
                'commission_percentage' => 3.00,
                'bv' => 800,
                'images' => [
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+S24+Ultra+1',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+S24+Ultra+2',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+S24+Ultra+3'
                ]
            ],
            [
                'product_name' => 'iPhone 15 Pro Max 256GB',
                'product_description' => 'Latest iPhone with titanium design, A17 Pro chip, and advanced camera system. Features include 6.7" Super Retina XDR display and Action Button.',
                'subcategory_id' => $smartphoneSubcategory->id,
                'sub_subcategory_id' => $iphone->id,
                'normal_price' => 159900.99,
                'quantity' => 15,
                'tags' => 'Apple, iPhone, 15 Pro Max, iOS, Premium, Camera',
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
                'product_name' => 'OnePlus 12 128GB',
                'product_description' => 'Flagship killer with Snapdragon 8 Gen 3, 50MP Hasselblad camera, and 100W fast charging. Features include 6.82" LTPO AMOLED display.',
                'subcategory_id' => $smartphoneSubcategory->id,
                'sub_subcategory_id' => $androidPhone->id,
                'normal_price' => 64999.99,
                'quantity' => 25,
                'tags' => 'OnePlus, Android, Flagship, Fast Charging, Hasselblad',
                'is_affiliate' => false,
                'bv' => 400,
                'images' => [
                    'https://via.placeholder.com/500x400/FF0000/FFFFFF?text=OnePlus+12+1',
                    'https://via.placeholder.com/500x400/FF0000/FFFFFF?text=OnePlus+12+2',
                    'https://via.placeholder.com/500x400/FF0000/FFFFFF?text=OnePlus+12+3'
                ]
            ],

            // Tablets
            [
                'product_name' => 'iPad Pro 12.9" 256GB WiFi',
                'product_description' => 'Professional tablet with M2 chip, Liquid Retina XDR display, and Apple Pencil support. Perfect for creative professionals and productivity.',
                'subcategory_id' => $tabletSubcategory->id,
                'sub_subcategory_id' => $ipad->id,
                'normal_price' => 109900.99,
                'quantity' => 10,
                'tags' => 'Apple, iPad Pro, M2 Chip, Professional, Creative, Productivity',
                'is_affiliate' => true,
                'affiliate_price' => 106900.99,
                'commission_percentage' => 2.75,
                'bv' => 700,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=iPad+Pro+12.9+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=iPad+Pro+12.9+2',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=iPad+Pro+12.9+3'
                ]
            ],
            [
                'product_name' => 'Samsung Galaxy Tab S9 256GB',
                'product_description' => 'Premium Android tablet with S Pen included, 11" Dynamic AMOLED 2X display, and Snapdragon 8 Gen 2 processor for gaming and productivity.',
                'subcategory_id' => $tabletSubcategory->id,
                'sub_subcategory_id' => $androidTablet->id,
                'normal_price' => 72999.99,
                'quantity' => 12,
                'tags' => 'Samsung, Galaxy Tab, S Pen, Android, Gaming, Productivity',
                'is_affiliate' => false,
                'bv' => 450,
                'images' => [
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Galaxy+Tab+S9+1',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Galaxy+Tab+S9+2',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Galaxy+Tab+S9+3'
                ]
            ],

            // Mobile Accessories
            [
                'product_name' => 'Spigen Tough Armor iPhone 15 Pro Case',
                'product_description' => 'Military-grade protection with dual-layer design. Features include air cushion technology and precise cutouts for all ports.',
                'subcategory_id' => $accessoriesSubcategory->id,
                'sub_subcategory_id' => $mobileCase->id,
                'normal_price' => 2499.99,
                'quantity' => 100,
                'tags' => 'Spigen, iPhone Case, Protection, Military Grade, Tough Armor',
                'is_affiliate' => true,
                'affiliate_price' => 2299.99,
                'commission_percentage' => 8.00,
                'bv' => 15,
                'images' => [
                    'https://via.placeholder.com/500x400/8B4513/FFFFFF?text=Spigen+Case+1',
                    'https://via.placeholder.com/500x400/8B4513/FFFFFF?text=Spigen+Case+2'
                ]
            ],
            [
                'product_name' => 'Tempered Glass Screen Protector',
                'product_description' => '9H hardness tempered glass with oleophobic coating. Bubble-free installation and case-friendly design for maximum protection.',
                'subcategory_id' => $accessoriesSubcategory->id,
                'sub_subcategory_id' => $screenProtector->id,
                'normal_price' => 599.99,
                'quantity' => 200,
                'tags' => 'Screen Protector, Tempered Glass, 9H Hardness, Protection',
                'is_affiliate' => false,
                'bv' => 5,
                'images' => [
                    'https://via.placeholder.com/500x400/87CEEB/000000?text=Screen+Protector+1',
                    'https://via.placeholder.com/500x400/87CEEB/000000?text=Screen+Protector+2'
                ]
            ],

            // Smartwatches
            [
                'product_name' => 'Apple Watch Series 9 GPS 45mm',
                'product_description' => 'Advanced health and fitness tracking with S9 SiP chip. Features include blood oxygen monitoring, ECG, and always-on Retina display.',
                'subcategory_id' => $smartwatchSubcategory->id,
                'sub_subcategory_id' => $appleWatch->id,
                'normal_price' => 42900.99,
                'quantity' => 18,
                'tags' => 'Apple Watch, Series 9, Health Tracking, GPS, Fitness',
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
                'product_name' => 'Samsung Galaxy Watch 6 44mm',
                'product_description' => 'Comprehensive health monitoring with advanced sleep tracking. Features include body composition analysis and personalized workout routines.',
                'subcategory_id' => $smartwatchSubcategory->id,
                'sub_subcategory_id' => $androidWatch->id,
                'normal_price' => 32999.99,
                'quantity' => 22,
                'tags' => 'Samsung, Galaxy Watch, Health Monitoring, Sleep Tracking, Workout',
                'is_affiliate' => false,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Galaxy+Watch+6+1',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Galaxy+Watch+6+2'
                ]
            ],

            // Power Banks
            [
                'product_name' => 'Anker PowerCore 26800mAh Fast Charging',
                'product_description' => 'Ultra-high capacity power bank with PowerIQ technology. Can charge iPhone 15 over 5 times and includes 3 USB ports for multiple devices.',
                'subcategory_id' => $powerBankSubcategory->id,
                'sub_subcategory_id' => $fastChargingPowerBank->id,
                'normal_price' => 4999.99,
                'quantity' => 50,
                'tags' => 'Anker, Power Bank, Fast Charging, High Capacity, PowerIQ',
                'is_affiliate' => true,
                'affiliate_price' => 4699.99,
                'commission_percentage' => 6.00,
                'bv' => 30,
                'images' => [
                    'https://via.placeholder.com/500x400/0066CC/FFFFFF?text=Anker+PowerCore+1',
                    'https://via.placeholder.com/500x400/0066CC/FFFFFF?text=Anker+PowerCore+2'
                ]
            ],
            [
                'product_name' => 'Belkin 10000mAh Wireless Power Bank',
                'product_description' => 'Wireless charging power bank with Qi technology. Features include wired and wireless charging options with LED battery indicator.',
                'subcategory_id' => $powerBankSubcategory->id,
                'sub_subcategory_id' => $wirelessPowerBank->id,
                'normal_price' => 6999.99,
                'quantity' => 30,
                'tags' => 'Belkin, Wireless Charging, Qi Technology, Power Bank, LED Indicator',
                'is_affiliate' => false,
                'bv' => 40,
                'images' => [
                    'https://via.placeholder.com/500x400/800080/FFFFFF?text=Belkin+Wireless+1',
                    'https://via.placeholder.com/500x400/800080/FFFFFF?text=Belkin+Wireless+2'
                ]
            ],

            // Headphones & Earphones
            [
                'product_name' => 'Apple AirPods Pro 2nd Generation',
                'product_description' => 'Premium wireless earphones with active noise cancellation and spatial audio. Features include adaptive transparency and personalized volume.',
                'subcategory_id' => $headphonesSubcategory->id,
                'sub_subcategory_id' => $wirelessEarphones->id,
                'normal_price' => 24900.99,
                'quantity' => 35,
                'tags' => 'Apple, AirPods Pro, Noise Cancellation, Spatial Audio, Wireless',
                'is_affiliate' => true,
                'affiliate_price' => 23900.99,
                'commission_percentage' => 4.50,
                'bv' => 150,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=AirPods+Pro+2+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=AirPods+Pro+2+2'
                ]
            ],
            [
                'product_name' => 'Sony WH-1000XM5 Wireless Headphones',
                'product_description' => 'Industry-leading noise canceling with exceptional sound quality. Features include 30-hour battery life and multipoint connection.',
                'subcategory_id' => $headphonesSubcategory->id,
                'sub_subcategory_id' => $wirelessEarphones->id,
                'normal_price' => 29990.99,
                'quantity' => 25,
                'tags' => 'Sony, WH-1000XM5, Noise Canceling, Wireless, Premium Audio',
                'is_affiliate' => false,
                'bv' => 180,
                'images' => [
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+WH1000XM5+1',
                    'https://via.placeholder.com/500x400/000000/FFFFFF?text=Sony+WH1000XM5+2'
                ]
            ]
        ];

        foreach ($mobileProducts as $productData) {
            // Generate unique product ID
            $productId = 'MP-' . strtoupper(Str::random(8));

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
                'category_id' => $mobileCategory->id,
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

            $this->command->info("Created Mobile product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('Mobile Phone products seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- Mobile Phones & Devices category');
        $this->command->info('- 6 subcategories (Smartphones, Tablets, Mobile Accessories, Smartwatches, Power Banks, Headphones & Earphones)');
        $this->command->info('- 12 sub-subcategories');
        $this->command->info('- ' . count($mobileProducts) . ' mobile products with images');
    }
}
