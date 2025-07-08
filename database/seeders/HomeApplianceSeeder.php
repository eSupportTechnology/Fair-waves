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

class HomeApplianceSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Home Appliances category
        $homeApplianceCategory = Category::firstOrCreate(['name' => 'Home Appliances']);

        // Create subcategories
        $refrigeratorSubcategory = Subcategory::firstOrCreate([
            'name' => 'Refrigerator',
            'category_id' => $homeApplianceCategory->id
        ]);

        $washingMachineSubcategory = Subcategory::firstOrCreate([
            'name' => 'Washing Machines',
            'category_id' => $homeApplianceCategory->id
        ]);

        $heatersGeyserSubcategory = Subcategory::firstOrCreate([
            'name' => 'Heaters & Geyser',
            'category_id' => $homeApplianceCategory->id
        ]);

        $fansSubcategory = Subcategory::firstOrCreate([
            'name' => 'Fans',
            'category_id' => $homeApplianceCategory->id
        ]);

        $ironsSubcategory = Subcategory::firstOrCreate([
            'name' => 'Irons',
            'category_id' => $homeApplianceCategory->id
        ]);

        $airConditionerSubcategory = Subcategory::firstOrCreate([
            'name' => 'Air Conditioners',
            'category_id' => $homeApplianceCategory->id
        ]);

        // Create sub-subcategories for each subcategory
        // Refrigerator sub-subcategories
        $doubleDoorRefrigerator = SubSubcategory::firstOrCreate([
            'name' => 'Double Door',
            'subcategory_id' => $refrigeratorSubcategory->id
        ]);

        $singleDoorRefrigerator = SubSubcategory::firstOrCreate([
            'name' => 'Single Door',
            'subcategory_id' => $refrigeratorSubcategory->id
        ]);

        // Washing Machine sub-subcategories
        $frontLoadWashing = SubSubcategory::firstOrCreate([
            'name' => 'Front Load',
            'subcategory_id' => $washingMachineSubcategory->id
        ]);

        $topLoadWashing = SubSubcategory::firstOrCreate([
            'name' => 'Top Load',
            'subcategory_id' => $washingMachineSubcategory->id
        ]);

        // Heaters & Geyser sub-subcategories
        $instantGeyser = SubSubcategory::firstOrCreate([
            'name' => 'Instant Geyser',
            'subcategory_id' => $heatersGeyserSubcategory->id
        ]);

        $storageGeyser = SubSubcategory::firstOrCreate([
            'name' => 'Storage Geyser',
            'subcategory_id' => $heatersGeyserSubcategory->id
        ]);

        // Fans sub-subcategories
        $ceilingFan = SubSubcategory::firstOrCreate([
            'name' => 'Ceiling Fan',
            'subcategory_id' => $fansSubcategory->id
        ]);

        $tableFan = SubSubcategory::firstOrCreate([
            'name' => 'Table Fan',
            'subcategory_id' => $fansSubcategory->id
        ]);

        // Irons sub-subcategories
        $steamIron = SubSubcategory::firstOrCreate([
            'name' => 'Steam Iron',
            'subcategory_id' => $ironsSubcategory->id
        ]);

        $dryIron = SubSubcategory::firstOrCreate([
            'name' => 'Dry Iron',
            'subcategory_id' => $ironsSubcategory->id
        ]);

        // Air Conditioner sub-subcategories
        $splitAC = SubSubcategory::firstOrCreate([
            'name' => 'Split AC',
            'subcategory_id' => $airConditionerSubcategory->id
        ]);

        $windowAC = SubSubcategory::firstOrCreate([
            'name' => 'Window AC',
            'subcategory_id' => $airConditionerSubcategory->id
        ]);

        // Get existing vendor and shop
        $vendor = Vendor::first();
        if (!$vendor) {
            $vendor = Vendor::create([
                'name' => 'Home Appliance Store',
                'email' => 'vendor@homeappliances.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'address' => '123 Appliance Street',
                'status' => 'approved',
            ]);
        }

        $shop = Shop::first();
        if (!$shop) {
            $shop = Shop::create([
                'vendor_id' => $vendor->id,
                'shop_name' => 'HomeMart',
                'shop_description' => 'Your one-stop shop for home appliances',
                'shop_logo' => 'default-shop-logo.png'
            ]);
        }

        // Home Appliance Products data with real images
        $homeApplianceProducts = [
            // Refrigerators
            [
                'product_name' => 'LG 260L Double Door Refrigerator',
                'product_description' => 'Smart Inverter Compressor with 10 year warranty. Multi Air Flow technology ensures even cooling throughout the refrigerator.',
                'subcategory_id' => $refrigeratorSubcategory->id,
                'sub_subcategory_id' => $doubleDoorRefrigerator->id,
                'normal_price' => 25999.99,
                'quantity' => 15,
                'tags' => 'LG, Refrigerator, Double Door, Smart Inverter, Energy Efficient',
                'is_affiliate' => true,
                'affiliate_price' => 24999.99,
                'commission_percentage' => 4.00,
                'bv' => 150,
                'images' => [
                    'https://via.placeholder.com/500x400/0066CC/FFFFFF?text=LG+Refrigerator+1',
                    'https://via.placeholder.com/500x400/0066CC/FFFFFF?text=LG+Refrigerator+2',
                    'https://via.placeholder.com/500x400/0066CC/FFFFFF?text=LG+Refrigerator+3'
                ]
            ],
            [
                'product_name' => 'Samsung 192L Single Door Refrigerator',
                'product_description' => 'Digital Inverter Technology for energy efficiency. Base Stand Drawer for extra storage space.',
                'subcategory_id' => $refrigeratorSubcategory->id,
                'sub_subcategory_id' => $singleDoorRefrigerator->id,
                'normal_price' => 16999.99,
                'quantity' => 20,
                'tags' => 'Samsung, Refrigerator, Single Door, Digital Inverter, Compact',
                'is_affiliate' => false,
                'bv' => 100,
                'images' => [
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+Refrigerator+1',
                    'https://via.placeholder.com/500x400/1428A0/FFFFFF?text=Samsung+Refrigerator+2'
                ]
            ],

            // Washing Machines
            [
                'product_name' => 'Whirlpool 7.5kg Front Load Washing Machine',
                'product_description' => '6th Sense SoftMove Technology with multiple wash programs. Fresh Care+ keeps clothes fresh for up to 6 hours.',
                'subcategory_id' => $washingMachineSubcategory->id,
                'sub_subcategory_id' => $frontLoadWashing->id,
                'normal_price' => 32999.99,
                'quantity' => 12,
                'tags' => 'Whirlpool, Washing Machine, Front Load, 6th Sense, Fresh Care',
                'is_affiliate' => true,
                'affiliate_price' => 31999.99,
                'commission_percentage' => 5.00,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/500x400/CC0000/FFFFFF?text=Whirlpool+Washing+1',
                    'https://via.placeholder.com/500x400/CC0000/FFFFFF?text=Whirlpool+Washing+2'
                ]
            ],
            [
                'product_name' => 'IFB 6.5kg Top Load Washing Machine',
                'product_description' => 'Aqua Energie water softener built-in. Triadic Pulsator for better wash quality with gentle fabric care.',
                'subcategory_id' => $washingMachineSubcategory->id,
                'sub_subcategory_id' => $topLoadWashing->id,
                'normal_price' => 19999.99,
                'quantity' => 18,
                'tags' => 'IFB, Washing Machine, Top Load, Aqua Energie, Triadic Pulsator',
                'is_affiliate' => false,
                'bv' => 120,
                'images' => [
                    'https://via.placeholder.com/500x400/FF6600/FFFFFF?text=IFB+Washing+1',
                    'https://via.placeholder.com/500x400/FF6600/FFFFFF?text=IFB+Washing+2'
                ]
            ],

            // Heaters & Geysers
            [
                'product_name' => 'Bajaj 3L Instant Water Heater',
                'product_description' => 'Instant heating with ISI marked safety valve. Copper tank with glass wool insulation for better heat retention.',
                'subcategory_id' => $heatersGeyserSubcategory->id,
                'sub_subcategory_id' => $instantGeyser->id,
                'normal_price' => 4999.99,
                'quantity' => 35,
                'tags' => 'Bajaj, Water Heater, Instant, Copper Tank, ISI Marked',
                'is_affiliate' => false,
                'bv' => 30,
                'images' => [
                    'https://via.placeholder.com/500x400/8B4513/FFFFFF?text=Bajaj+Heater+1',
                    'https://via.placeholder.com/500x400/8B4513/FFFFFF?text=Bajaj+Heater+2'
                ]
            ],
            [
                'product_name' => 'Racold 25L Storage Water Heater',
                'product_description' => 'Titanium Plus tank with 5-star energy rating. Advanced safety features with pressure release valve.',
                'subcategory_id' => $heatersGeyserSubcategory->id,
                'sub_subcategory_id' => $storageGeyser->id,
                'normal_price' => 12999.99,
                'quantity' => 20,
                'tags' => 'Racold, Water Heater, Storage, Titanium Plus, 5 Star',
                'is_affiliate' => true,
                'affiliate_price' => 11999.99,
                'commission_percentage' => 6.00,
                'bv' => 80,
                'images' => [
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=Racold+Geyser+1',
                    'https://via.placeholder.com/500x400/4169E1/FFFFFF?text=Racold+Geyser+2'
                ]
            ],

            // Fans
            [
                'product_name' => 'Havells 1200mm Ceiling Fan',
                'product_description' => 'High speed ceiling fan with aerodynamically designed blades. Double ball bearing for silent operation.',
                'subcategory_id' => $fansSubcategory->id,
                'sub_subcategory_id' => $ceilingFan->id,
                'normal_price' => 2499.99,
                'quantity' => 50,
                'tags' => 'Havells, Ceiling Fan, High Speed, Double Ball Bearing, Silent',
                'is_affiliate' => false,
                'bv' => 20,
                'images' => [
                    'https://via.placeholder.com/500x400/800080/FFFFFF?text=Havells+Fan+1',
                    'https://via.placeholder.com/500x400/800080/FFFFFF?text=Havells+Fan+2'
                ]
            ],
            [
                'product_name' => 'Crompton 400mm Table Fan',
                'product_description' => 'High air delivery table fan with sweep control. Rust resistant powder coated finish.',
                'subcategory_id' => $fansSubcategory->id,
                'sub_subcategory_id' => $tableFan->id,
                'normal_price' => 1899.99,
                'quantity' => 40,
                'tags' => 'Crompton, Table Fan, High Air Delivery, Sweep Control, Rust Resistant',
                'is_affiliate' => false,
                'bv' => 15,
                'images' => [
                    'https://via.placeholder.com/500x400/008080/FFFFFF?text=Crompton+Fan+1',
                    'https://via.placeholder.com/500x400/008080/FFFFFF?text=Crompton+Fan+2'
                ]
            ],

            // Irons
            [
                'product_name' => 'Philips 2000W Steam Iron',
                'product_description' => 'Steam iron with SteamGlide soleplate. Continuous steam output for efficient ironing.',
                'subcategory_id' => $ironsSubcategory->id,
                'sub_subcategory_id' => $steamIron->id,
                'normal_price' => 3499.99,
                'quantity' => 30,
                'tags' => 'Philips, Steam Iron, SteamGlide, Continuous Steam, 2000W',
                'is_affiliate' => true,
                'affiliate_price' => 3299.99,
                'commission_percentage' => 4.50,
                'bv' => 25,
                'images' => [
                    'https://via.placeholder.com/500x400/000080/FFFFFF?text=Philips+Iron+1',
                    'https://via.placeholder.com/500x400/000080/FFFFFF?text=Philips+Iron+2'
                ]
            ],
            [
                'product_name' => 'Bajaj 1000W Dry Iron',
                'product_description' => 'Lightweight dry iron with non-stick soleplate. Easy temperature control with indicator.',
                'subcategory_id' => $ironsSubcategory->id,
                'sub_subcategory_id' => $dryIron->id,
                'normal_price' => 899.99,
                'quantity' => 45,
                'tags' => 'Bajaj, Dry Iron, Non-stick Soleplate, Lightweight, Temperature Control',
                'is_affiliate' => false,
                'bv' => 10,
                'images' => [
                    'https://via.placeholder.com/500x400/8B4513/FFFFFF?text=Bajaj+Iron+1',
                    'https://via.placeholder.com/500x400/8B4513/FFFFFF?text=Bajaj+Iron+2'
                ]
            ],

            // Air Conditioners
            [
                'product_name' => 'Daikin 1.5 Ton Split AC',
                'product_description' => 'Inverter technology for energy efficiency. Copper condenser with stabilizer free operation.',
                'subcategory_id' => $airConditionerSubcategory->id,
                'sub_subcategory_id' => $splitAC->id,
                'normal_price' => 42999.99,
                'quantity' => 8,
                'tags' => 'Daikin, Split AC, Inverter, Copper Condenser, Energy Efficient',
                'is_affiliate' => true,
                'affiliate_price' => 41999.99,
                'commission_percentage' => 3.50,
                'bv' => 300,
                'images' => [
                    'https://via.placeholder.com/500x400/FF1493/FFFFFF?text=Daikin+AC+1',
                    'https://via.placeholder.com/500x400/FF1493/FFFFFF?text=Daikin+AC+2'
                ]
            ],
            [
                'product_name' => 'Voltas 1 Ton Window AC',
                'product_description' => 'Fixed speed window AC with rotary compressor. Anti-bacterial filter for clean air.',
                'subcategory_id' => $airConditionerSubcategory->id,
                'sub_subcategory_id' => $windowAC->id,
                'normal_price' => 28999.99,
                'quantity' => 10,
                'tags' => 'Voltas, Window AC, Rotary Compressor, Anti-bacterial Filter, Fixed Speed',
                'is_affiliate' => false,
                'bv' => 200,
                'images' => [
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=Voltas+AC+1',
                    'https://via.placeholder.com/500x400/DC143C/FFFFFF?text=Voltas+AC+2'
                ]
            ]
        ];

        foreach ($homeApplianceProducts as $productData) {
            // Generate unique product ID
            $productId = 'HA-' . strtoupper(Str::random(8));

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
                'category_id' => $homeApplianceCategory->id,
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

            // Add real product images
            $productImages = $productData['images'] ?? [];

            foreach ($productImages as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_path' => $imageUrl
                ]);
            }

            $this->command->info("Created Home Appliance product: {$product->product_name} (ID: {$product->product_id})");
        }

        $this->command->info('Home Appliance products seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- Home Appliances category');
        $this->command->info('- 6 subcategories (Refrigerator, Washing Machines, Heaters & Geyser, Fans, Irons, Air Conditioners)');
        $this->command->info('- 12 sub-subcategories');
        $this->command->info('- ' . count($homeApplianceProducts) . ' home appliance products with images');
    }
}
