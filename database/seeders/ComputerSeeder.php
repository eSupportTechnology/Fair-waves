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

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Computers category
        $computerCategory = Category::firstOrCreate(['name' => 'Computers']);

        // Create subcategories
        $laptopSubcategory = Subcategory::firstOrCreate([
            'name' => 'Laptops',
            'category_id' => $computerCategory->id
        ]);

        $desktopSubcategory = Subcategory::firstOrCreate([
            'name' => 'Desktop Computers',
            'category_id' => $computerCategory->id
        ]);

        $componentSubcategory = Subcategory::firstOrCreate([
            'name' => 'Computer Components',
            'category_id' => $computerCategory->id
        ]);

        $peripheralSubcategory = Subcategory::firstOrCreate([
            'name' => 'Peripherals',
            'category_id' => $computerCategory->id
        ]);

        $storageSubcategory = Subcategory::firstOrCreate([
            'name' => 'Storage Devices',
            'category_id' => $computerCategory->id
        ]);

        $gamingSubcategory = Subcategory::firstOrCreate([
            'name' => 'Gaming Accessories',
            'category_id' => $computerCategory->id
        ]);

        // Create sub-subcategories for each subcategory
        // Laptop sub-subcategories
        $gamingLaptop = SubSubcategory::firstOrCreate([
            'name' => 'Gaming Laptops',
            'subcategory_id' => $laptopSubcategory->id
        ]);

        $businessLaptop = SubSubcategory::firstOrCreate([
            'name' => 'Business Laptops',
            'subcategory_id' => $laptopSubcategory->id
        ]);

        $ultrabook = SubSubcategory::firstOrCreate([
            'name' => 'Ultrabooks',
            'subcategory_id' => $laptopSubcategory->id
        ]);

        // Desktop sub-subcategories
        $gamingDesktop = SubSubcategory::firstOrCreate([
            'name' => 'Gaming Desktops',
            'subcategory_id' => $desktopSubcategory->id
        ]);

        $officeDesktop = SubSubcategory::firstOrCreate([
            'name' => 'Office Desktops',
            'subcategory_id' => $desktopSubcategory->id
        ]);

        $workstation = SubSubcategory::firstOrCreate([
            'name' => 'Workstations',
            'subcategory_id' => $desktopSubcategory->id
        ]);

        // Component sub-subcategories
        $processor = SubSubcategory::firstOrCreate([
            'name' => 'Processors (CPU)',
            'subcategory_id' => $componentSubcategory->id
        ]);

        $graphicsCard = SubSubcategory::firstOrCreate([
            'name' => 'Graphics Cards (GPU)',
            'subcategory_id' => $componentSubcategory->id
        ]);

        $motherboard = SubSubcategory::firstOrCreate([
            'name' => 'Motherboards',
            'subcategory_id' => $componentSubcategory->id
        ]);

        $ram = SubSubcategory::firstOrCreate([
            'name' => 'RAM Memory',
            'subcategory_id' => $componentSubcategory->id
        ]);

        // Peripheral sub-subcategories
        $monitor = SubSubcategory::firstOrCreate([
            'name' => 'Monitors',
            'subcategory_id' => $peripheralSubcategory->id
        ]);

        $keyboardMouse = SubSubcategory::firstOrCreate([
            'name' => 'Keyboards & Mice',
            'subcategory_id' => $peripheralSubcategory->id
        ]);

        $printer = SubSubcategory::firstOrCreate([
            'name' => 'Printers',
            'subcategory_id' => $peripheralSubcategory->id
        ]);

        // Storage sub-subcategories
        $ssd = SubSubcategory::firstOrCreate([
            'name' => 'SSD Drives',
            'subcategory_id' => $storageSubcategory->id
        ]);

        $hdd = SubSubcategory::firstOrCreate([
            'name' => 'Hard Drives (HDD)',
            'subcategory_id' => $storageSubcategory->id
        ]);

        $externalStorage = SubSubcategory::firstOrCreate([
            'name' => 'External Storage',
            'subcategory_id' => $storageSubcategory->id
        ]);

        // Gaming sub-subcategories
        $gamingKeyboard = SubSubcategory::firstOrCreate([
            'name' => 'Gaming Keyboards',
            'subcategory_id' => $gamingSubcategory->id
        ]);

        $gamingMouse = SubSubcategory::firstOrCreate([
            'name' => 'Gaming Mice',
            'subcategory_id' => $gamingSubcategory->id
        ]);

        $gamingHeadset = SubSubcategory::firstOrCreate([
            'name' => 'Gaming Headsets',
            'subcategory_id' => $gamingSubcategory->id
        ]);

        // Get existing vendor and shop
        $vendor = Vendor::first();
        if (!$vendor) {
            $vendor = Vendor::create([
                'name' => 'Computer Store',
                'email' => 'vendor@computerstore.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Computer Street',
                'status' => 'approved',
            ]);
        }

        $shop = Shop::first();
        if (!$shop) {
            $shop = Shop::create([
                'vendor_id' => $vendor->id,
                'shop_name' => 'TechMart',
                'shop_description' => 'Your one-stop shop for computers and technology',
                'shop_logo' => 'default-shop-logo.png'
            ]);
        }

        // Computer Products data
        $computerProducts = [
            // Laptops
            [
                'product_name' => 'ASUS ROG Strix G15 Gaming Laptop',
                'product_description' => 'High-performance gaming laptop with AMD Ryzen 7 processor, NVIDIA RTX 4060 GPU, 16GB RAM, and 512GB SSD. Features 15.6" 144Hz display for smooth gaming.',
                'subcategory_id' => $laptopSubcategory->id,
                'sub_subcategory_id' => $gamingLaptop->id,
                'normal_price' => 89999.99,
                'quantity' => 15,
                'tags' => 'ASUS, ROG, Gaming Laptop, RTX 4060, AMD Ryzen, 144Hz',
                'is_affiliate' => true,
                'affiliate_price' => 87999.99,
                'commission_percentage' => 3.50,
                'bv' => 550,
                'images' => [
                    'https://via.placeholder.com/500x400/FF0000/FFFFFF?text=ASUS+ROG+Strix+1',
                    'https://via.placeholder.com/500x400/FF0000/FFFFFF?text=ASUS+ROG+Strix+2',
                    'https://via.placeholder.com/500x400/FF0000/FFFFFF?text=ASUS+ROG+Strix+3'
                ]
            ],
            [
                'product_name' => 'Dell Inspiron 15 3000 Business Laptop',
                'product_description' => 'Reliable business laptop with Intel Core i5 processor, 8GB RAM, and 256GB SSD. Perfect for office work and productivity tasks.',
                'subcategory_id' => $laptopSubcategory->id,
                'sub_subcategory_id' => $businessLaptop->id,
                'normal_price' => 45999.99,
                'quantity' => 25,
                'tags' => 'Dell, Inspiron, Business Laptop, Intel Core i5, Productivity',
                'is_affiliate' => false,
                'bv' => 280,
                'images' => [
                    'https://via.placeholder.com/500x400/0066CC/FFFFFF?text=Dell+Inspiron+1',
                    'https://via.placeholder.com/500x400/0066CC/FFFFFF?text=Dell+Inspiron+2'
                ]
            ],
            [
                'product_name' => 'HP Spectre x360 Ultrabook',
                'product_description' => 'Premium 2-in-1 convertible ultrabook with Intel Core i7, 16GB RAM, 512GB SSD, and 13.5" OLED touchscreen. Ultra-thin design with long battery life.',
                'subcategory_id' => $laptopSubcategory->id,
                'sub_subcategory_id' => $ultrabook->id,
                'normal_price' => 124999.99,
                'quantity' => 12,
                'tags' => 'HP, Spectre x360, Ultrabook, 2-in-1, OLED, Convertible',
                'is_affiliate' => true,
                'affiliate_price' => 119999.99,
                'commission_percentage' => 3.00,
                'bv' => 750,
                'images' => [
                    'https://via.placeholder.com/500x400/1E90FF/FFFFFF?text=HP+Spectre+x360+1',
                    'https://via.placeholder.com/500x400/1E90FF/FFFFFF?text=HP+Spectre+x360+2'
                ]
            ],

            // Desktop Computers
            [
                'product_name' => 'Alienware Aurora R15 Gaming Desktop',
                'product_description' => 'High-end gaming desktop with Intel Core i7-13700F, NVIDIA RTX 4070, 32GB RAM, and 1TB SSD. Liquid cooling system and RGB lighting.',
                'subcategory_id' => $desktopSubcategory->id,
                'sub_subcategory_id' => $gamingDesktop->id,
                'normal_price' => 179999.99,
                'quantity' => 8,
                'tags' => 'Alienware, Gaming Desktop, RTX 4070, Intel Core i7, Liquid Cooling',
                'is_affiliate' => true,
                'affiliate_price' => 174999.99,
                'commission_percentage' => 2.50,
                'bv' => 1100,
                'images' => [
                    'https://via.placeholder.com/500x400/000080/FFFFFF?text=Alienware+Aurora+1',
                    'https://via.placeholder.com/500x400/000080/FFFFFF?text=Alienware+Aurora+2'
                ]
            ],
            [
                'product_name' => 'HP Pavilion Desktop PC',
                'product_description' => 'Affordable office desktop with Intel Core i3 processor, 8GB RAM, 1TB HDD, and integrated graphics. Perfect for everyday computing tasks.',
                'subcategory_id' => $desktopSubcategory->id,
                'sub_subcategory_id' => $officeDesktop->id,
                'normal_price' => 32999.99,
                'quantity' => 20,
                'tags' => 'HP, Pavilion, Office Desktop, Intel Core i3, Affordable',
                'is_affiliate' => false,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/500x400/4B0082/FFFFFF?text=HP+Pavilion+Desktop+1',
                    'https://via.placeholder.com/500x400/4B0082/FFFFFF?text=HP+Pavilion+Desktop+2'
                ]
            ],

            // Computer Components
            [
                'product_name' => 'Intel Core i7-13700K Processor',
                'product_description' => '13th Generation Intel Core i7 processor with 16 cores, 24 threads, and up to 5.4 GHz boost clock. Perfect for gaming and content creation.',
                'subcategory_id' => $componentSubcategory->id,
                'sub_subcategory_id' => $processor->id,
                'normal_price' => 34999.99,
                'quantity' => 30,
                'tags' => 'Intel, Core i7, 13th Gen, Gaming, Content Creation, High Performance',
                'is_affiliate' => true,
                'affiliate_price' => 33999.99,
                'commission_percentage' => 4.00,
                'bv' => 210,
                'images' => [
                    'https://via.placeholder.com/500x400/0071C5/FFFFFF?text=Intel+i7+13700K+1',
                    'https://via.placeholder.com/500x400/0071C5/FFFFFF?text=Intel+i7+13700K+2'
                ]
            ],
            [
                'product_name' => 'NVIDIA GeForce RTX 4070 Graphics Card',
                'product_description' => 'High-performance graphics card with 12GB GDDR6X memory, ray tracing, and DLSS 3. Perfect for 1440p gaming and content creation.',
                'subcategory_id' => $componentSubcategory->id,
                'sub_subcategory_id' => $graphicsCard->id,
                'normal_price' => 54999.99,
                'quantity' => 18,
                'tags' => 'NVIDIA, RTX 4070, Graphics Card, Ray Tracing, DLSS 3, Gaming',
                'is_affiliate' => true,
                'affiliate_price' => 52999.99,
                'commission_percentage' => 3.50,
                'bv' => 350,
                'images' => [
                    'https://via.placeholder.com/500x400/76B900/FFFFFF?text=RTX+4070+1',
                    'https://via.placeholder.com/500x400/76B900/FFFFFF?text=RTX+4070+2'
                ]
            ],
            [
                'product_name' => 'Corsair Vengeance LPX 32GB DDR4 RAM',
                'product_description' => 'High-performance DDR4 memory kit with 32GB capacity (2x16GB), 3200MHz speed, and low-profile heat spreader design.',
                'subcategory_id' => $componentSubcategory->id,
                'sub_subcategory_id' => $ram->id,
                'normal_price' => 8999.99,
                'quantity' => 40,
                'tags' => 'Corsair, DDR4 RAM, 32GB, High Performance, Gaming, Low Profile',
                'is_affiliate' => false,
                'bv' => 55,
                'images' => [
                    'https://via.placeholder.com/500x400/FFD700/000000?text=Corsair+RAM+32GB+1',
                    'https://via.placeholder.com/500x400/FFD700/000000?text=Corsair+RAM+32GB+2'
                ]
            ],

            // Peripherals
            [
                'product_name' => 'LG 27" 4K UltraFine Monitor',
                'product_description' => '27-inch 4K UHD monitor with IPS panel, HDR10 support, and USB-C connectivity. Perfect for productivity and content creation.',
                'subcategory_id' => $peripheralSubcategory->id,
                'sub_subcategory_id' => $monitor->id,
                'normal_price' => 32999.99,
                'quantity' => 22,
                'tags' => 'LG, 4K Monitor, UltraFine, IPS, HDR10, USB-C',
                'is_affiliate' => true,
                'affiliate_price' => 31999.99,
                'commission_percentage' => 4.50,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/500x400/A50034/FFFFFF?text=LG+4K+Monitor+1',
                    'https://via.placeholder.com/500x400/A50034/FFFFFF?text=LG+4K+Monitor+2'
                ]
            ],
            [
                'product_name' => 'Logitech MX Master 3S Wireless Mouse',
                'product_description' => 'Premium wireless mouse with precision tracking, customizable buttons, and multi-device connectivity. Perfect for productivity and design work.',
                'subcategory_id' => $peripheralSubcategory->id,
                'sub_subcategory_id' => $keyboardMouse->id,
                'normal_price' => 7999.99,
                'quantity' => 50,
                'tags' => 'Logitech, MX Master, Wireless Mouse, Productivity, Multi-device',
                'is_affiliate' => false,
                'bv' => 50,
                'images' => [
                    'https://via.placeholder.com/500x400/005A9C/FFFFFF?text=Logitech+MX+Master+1',
                    'https://via.placeholder.com/500x400/005A9C/FFFFFF?text=Logitech+MX+Master+2'
                ]
            ],
            [
                'product_name' => 'Canon PIXMA G3020 All-in-One Printer',
                'product_description' => 'Wireless all-in-one inkjet printer with tank system, print, scan, and copy functions. High-yield ink tanks for cost-effective printing.',
                'subcategory_id' => $peripheralSubcategory->id,
                'sub_subcategory_id' => $printer->id,
                'normal_price' => 14999.99,
                'quantity' => 35,
                'tags' => 'Canon, PIXMA, All-in-One Printer, Wireless, Tank System, Cost Effective',
                'is_affiliate' => true,
                'affiliate_price' => 14499.99,
                'commission_percentage' => 5.00,
                'bv' => 90,
                'images' => [
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=Canon+PIXMA+G3020+1',
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=Canon+PIXMA+G3020+2'
                ]
            ],

            // Storage Devices
            [
                'product_name' => 'Samsung 980 PRO 1TB NVMe SSD',
                'product_description' => 'High-performance NVMe SSD with PCIe 4.0 interface, 7000MB/s read speed, and 5-year warranty. Perfect for gaming and professional work.',
                'subcategory_id' => $storageSubcategory->id,
                'sub_subcategory_id' => $ssd->id,
                'normal_price' => 8999.99,
                'quantity' => 45,
                'tags' => 'Samsung, NVMe SSD, 1TB, PCIe 4.0, High Speed, Gaming',
                'is_affiliate' => true,
                'affiliate_price' => 8699.99,
                'commission_percentage' => 6.00,
                'bv' => 55,
                'images' => [
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+980+PRO+1',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+980+PRO+2'
                ]
            ],
            [
                'product_name' => 'WD Blue 2TB External Hard Drive',
                'product_description' => 'Portable external hard drive with 2TB capacity, USB 3.0 connectivity, and automatic backup software. Perfect for data storage and backup.',
                'subcategory_id' => $storageSubcategory->id,
                'sub_subcategory_id' => $externalStorage->id,
                'normal_price' => 5999.99,
                'quantity' => 60,
                'tags' => 'WD, External HDD, 2TB, USB 3.0, Portable, Backup',
                'is_affiliate' => false,
                'bv' => 40,
                'images' => [
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=WD+Blue+2TB+1',
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=WD+Blue+2TB+2'
                ]
            ],

            // Gaming Accessories
            [
                'product_name' => 'Razer BlackWidow V4 Mechanical Gaming Keyboard',
                'product_description' => 'Premium mechanical gaming keyboard with Green switches, RGB lighting, and dedicated media controls. Features wrist rest and programmable keys.',
                'subcategory_id' => $gamingSubcategory->id,
                'sub_subcategory_id' => $gamingKeyboard->id,
                'normal_price' => 12999.99,
                'quantity' => 30,
                'tags' => 'Razer, BlackWidow, Mechanical Keyboard, Gaming, RGB, Green Switches',
                'is_affiliate' => true,
                'affiliate_price' => 12499.99,
                'commission_percentage' => 5.50,
                'bv' => 80,
                'images' => [
                    'https://via.placeholder.com/500x400/00FF00/000000?text=Razer+BlackWidow+1',
                    'https://via.placeholder.com/500x400/00FF00/000000?text=Razer+BlackWidow+2'
                ]
            ],
            [
                'product_name' => 'Logitech G Pro X Superlight Gaming Mouse',
                'product_description' => 'Ultra-lightweight wireless gaming mouse with HERO 25K sensor, 70-hour battery life, and professional-grade performance.',
                'subcategory_id' => $gamingSubcategory->id,
                'sub_subcategory_id' => $gamingMouse->id,
                'normal_price' => 13999.99,
                'quantity' => 40,
                'tags' => 'Logitech, G Pro X, Gaming Mouse, Wireless, Lightweight, HERO Sensor',
                'is_affiliate' => false,
                'bv' => 85,
                'images' => [
                    'https://via.placeholder.com/500x400/005A9C/FFFFFF?text=Logitech+G+Pro+X+1',
                    'https://via.placeholder.com/500x400/005A9C/FFFFFF?text=Logitech+G+Pro+X+2'
                ]
            ],
            [
                'product_name' => 'SteelSeries Arctis 7P Gaming Headset',
                'product_description' => 'Wireless gaming headset with lossless 2.4GHz connection, 24-hour battery life, and ClearCast microphone. Compatible with PC and PlayStation.',
                'subcategory_id' => $gamingSubcategory->id,
                'sub_subcategory_id' => $gamingHeadset->id,
                'normal_price' => 16999.99,
                'quantity' => 25,
                'tags' => 'SteelSeries, Arctis 7P, Gaming Headset, Wireless, ClearCast Mic',
                'is_affiliate' => true,
                'affiliate_price' => 16499.99,
                'commission_percentage' => 4.50,
                'bv' => 105,
                'images' => [
                    'https://via.placeholder.com/500x400/FF6600/FFFFFF?text=SteelSeries+Arctis+1',
                    'https://via.placeholder.com/500x400/FF6600/FFFFFF?text=SteelSeries+Arctis+2'
                ]
            ]
        ];

        foreach ($computerProducts as $productData) {
            // Generate unique product ID
            $productId = 'CP-' . strtoupper(Str::random(8));

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
                'category_id' => $computerCategory->id,
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

            $this->command->info("Created Computer product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('Computer products seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- Computers category');
        $this->command->info('- 6 subcategories (Laptops, Desktop Computers, Computer Components, Peripherals, Storage Devices, Gaming Accessories)');
        $this->command->info('- 18 sub-subcategories');
        $this->command->info('- ' . count($computerProducts) . ' computer products with images');
    }
}
