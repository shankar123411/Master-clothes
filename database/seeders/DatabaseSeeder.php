<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo Admin Account (Configurable via ADMIN_ID / ADMIN_EMAIL & ADMIN_PASSWORD env vars)
        $adminEmail = env('ADMIN_ID') ?: env('ADMIN_EMAIL', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Master Clothes Admin',
                'password' => Hash::make($adminPassword),
            ]
        );

        // Products (21 catalog items)
        $products = [
            ['name' => 'Ankle Fit Leggings', 'category' => 'Classic', 'price' => 249, 'stock' => 500, 'description' => '100% Super Stretch 4-Way Premium Cotton Fabric'],
            ['name' => 'Chudidhar Fit Leggings', 'category' => 'Classic', 'price' => 269, 'stock' => 450, 'description' => 'Full Length Traditional Chudidhar Fit Leggings'],
            ['name' => 'Capri 3/4th Leggings', 'category' => 'Capri', 'price' => 229, 'stock' => 300, 'description' => '3/4th Length Casual Comfort Leggings'],
            ['name' => 'Shimmering Partywear Leggings', 'category' => 'Partywear', 'price' => 349, 'stock' => 200, 'description' => 'Glitter Finish Stretchable Metallic Leggings'],
            ['name' => 'High-Waist Tummy Control Leggings', 'category' => 'Activewear', 'price' => 399, 'stock' => 250, 'description' => 'Wide Elastic Band Tummy Control Shaping Leggings'],
            ['name' => 'Printed Floral Stretch Leggings', 'category' => 'Printed', 'price' => 299, 'stock' => 180, 'description' => 'Vibrant Floral Print Soft Cotton Leggings'],
            ['name' => 'Winter Thermal Lined Leggings', 'category' => 'Winterwear', 'price' => 449, 'stock' => 150, 'description' => 'Fleece Lined Warm Comfort Winter Leggings'],
            ['name' => 'Cotton Lycra Churidar Leggings', 'category' => 'Classic', 'price' => 279, 'stock' => 400, 'description' => 'Heavy GSM Premium Lycra Churidar Leggings'],
            ['name' => 'Denim Look Elasticated Jeggings', 'category' => 'Jeggings', 'price' => 389, 'stock' => 320, 'description' => 'Denim Pattern Stretchable Pocket Jeggings'],
            ['name' => 'Pocket Mobile Fitted Leggings', 'category' => 'Activewear', 'price' => 329, 'stock' => 280, 'description' => 'Side Mobile Pocket Utility Leggings'],
            ['name' => 'Modal Soft Viscose Leggings', 'category' => 'Premium', 'price' => 319, 'stock' => 220, 'description' => 'Ultra Soft Breathable Modal Viscose Leggings'],
            ['name' => 'Seamless Sports Workout Leggings', 'category' => 'Activewear', 'price' => 429, 'stock' => 190, 'description' => 'Gym & Yoga Stretch Seamless Activewear Leggings'],
            ['name' => 'Silk Shine Festive Leggings', 'category' => 'Festive', 'price' => 359, 'stock' => 160, 'description' => 'Lustrous Silk Touch Ethnic Festive Wear Leggings'],
            ['name' => 'Maternity Comfort Stretch Leggings', 'category' => 'Maternity', 'price' => 379, 'stock' => 140, 'description' => 'Over-the-Belly Ultra Soft Elastic Maternity Leggings'],
            ['name' => 'Lace Bordered Stylish Leggings', 'category' => 'Fashion', 'price' => 339, 'stock' => 210, 'description' => 'Designer Ankle Lace Trimming Party Leggings'],
            ['name' => 'Ribbed Knit Casual Leggings', 'category' => 'Casual', 'price' => 289, 'stock' => 260, 'description' => 'Vertical Ribbed Pattern Stretch Knit Leggings'],
            ['name' => 'Velvet Touch Plush Leggings', 'category' => 'Winterwear', 'price' => 469, 'stock' => 110, 'description' => 'Rich Micro Velvet Luxury Comfort Leggings'],
            ['name' => 'Polka Dot Patterned Jeggings', 'category' => 'Printed', 'price' => 309, 'stock' => 175, 'description' => 'Cute Polka Dot Printed Stretch Jeggings'],
            ['name' => 'Metallic Gloss Disco Leggings', 'category' => 'Partywear', 'price' => 369, 'stock' => 130, 'description' => 'Shiny Wet Look Metallic Disco Leggings'],
            ['name' => 'Organic Bamboo Cotton Leggings', 'category' => 'Eco-Friendly', 'price' => 399, 'stock' => 200, 'description' => 'Anti-Bacterial Natural Organic Bamboo Fabric'],
            ['name' => 'Daily Basics Pack Leggings', 'category' => 'Combos', 'price' => 219, 'stock' => 600, 'description' => 'Everyday Essentials Budget Cotton Stretch Leggings'],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['name' => $p['name']], $p);
        }

        // Colors (24 swatches)
        $colors = [
            ['name' => 'Black', 'hex' => '#000000'],
            ['name' => 'White', 'hex' => '#FFFFFF'],
            ['name' => 'Off White / Cream', 'hex' => '#FFFDD0'],
            ['name' => 'Navy Blue', 'hex' => '#000080'],
            ['name' => 'Royal Blue', 'hex' => '#4169E1'],
            ['name' => 'Maroon', 'hex' => '#800000'],
            ['name' => 'Crimson Red', 'hex' => '#DC143C'],
            ['name' => 'Rani Pink / Fuchsia', 'hex' => '#FF007F'],
            ['name' => 'Baby Pink', 'hex' => '#F4C2C2'],
            ['name' => 'Bottle Green', 'hex' => '#006A4E'],
            ['name' => 'Olive Green', 'hex' => '#808000'],
            ['name' => 'Mustard Yellow', 'hex' => '#FFDB58'],
            ['name' => 'Golden Yellow', 'hex' => '#FFD700'],
            ['name' => 'Bright Orange', 'hex' => '#FFA500'],
            ['name' => 'Dark Chocolate Brown', 'hex' => '#3D2314'],
            ['name' => 'Skin / Nude / Beige', 'hex' => '#E3C299'],
            ['name' => 'Charcoal Grey', 'hex' => '#36454F'],
            ['name' => 'Light Melange Grey', 'hex' => '#D3D3D3'],
            ['name' => 'Deep Violet / Purple', 'hex' => '#800080'],
            ['name' => 'Lavender', 'hex' => '#E6E6FA'],
            ['name' => 'Teal Blue', 'hex' => '#008080'],
            ['name' => 'Sky Blue', 'hex' => '#87CEEB'],
            ['name' => 'Coral Peach', 'hex' => '#FF7F50'],
            ['name' => 'Wine / Plum', 'hex' => '#722F37'],
        ];

        foreach ($colors as $c) {
            Color::updateOrCreate(['name' => $c['name']], $c);
        }

        // Sizes (11 standard garment size options)
        $sizes = [
            ['name' => 'Free Size (Regular)', 'code' => 'FS'],
            ['name' => 'Small (S)', 'code' => 'S'],
            ['name' => 'Medium (M)', 'code' => 'M'],
            ['name' => 'Large (L)', 'code' => 'L'],
            ['name' => 'XL (Extra Large)', 'code' => 'XL'],
            ['name' => '2XL (Double XL)', 'code' => '2XL'],
            ['name' => '3XL (Triple XL)', 'code' => '3XL'],
            ['name' => '4XL (Jumbo Size)', 'code' => '4XL'],
            ['name' => '5XL (Super Jumbo)', 'code' => '5XL'],
            ['name' => 'Kids 24-30', 'code' => 'KID-1'],
            ['name' => 'Kids 32-36', 'code' => 'KID-2'],
        ];

        Size::whereNotIn('name', array_column($sizes, 'name'))->delete();

        foreach ($sizes as $s) {
            Size::updateOrCreate(['name' => $s['name']], $s);
        }

        // Demo Wholesale Customers (Synthetic demo data)
        $customers = [
            ['name' => 'Arun Kumar', 'business_name' => 'Apex Textiles Hub', 'phone' => '9000000001', 'location' => 'Madurai'],
            ['name' => 'Karthik N', 'business_name' => 'Metro Apparel Mart', 'phone' => '9000000002', 'location' => 'Coimbatore'],
            ['name' => 'Vikram R', 'business_name' => 'Southern Garments', 'phone' => '9000000003', 'location' => 'Salem'],
            ['name' => 'Divya S', 'business_name' => 'Aura Fashion Store', 'phone' => '9000000004', 'location' => 'Chennai'],
            ['name' => 'Praveen P', 'business_name' => 'Crest Readymades', 'phone' => '9000000005', 'location' => 'Bengaluru'],
        ];

        foreach ($customers as $cust) {
            Customer::updateOrCreate(['name' => $cust['name']], $cust);
        }

        // Sample Inquiries
        $inquiries = [
            ['product' => 'Ankle Fit Leggings', 'color' => 'Rani Pink / Fuchsia', 'size' => 'Free Size (Regular)', 'quantity' => 50, 'phone' => '9000000001', 'status' => 'New Inquiry'],
            ['product' => 'Chudidhar Fit Leggings', 'color' => 'Black', 'size' => 'XL (Extra Large)', 'quantity' => 100, 'phone' => '9000000002', 'status' => 'Contacted'],
            ['product' => 'Shimmering Partywear Leggings', 'color' => 'Golden Yellow', 'size' => '2XL (Double XL)', 'quantity' => 30, 'phone' => '9000000003', 'status' => 'Converted'],
        ];

        foreach ($inquiries as $inq) {
            Inquiry::updateOrCreate(['phone' => $inq['phone'], 'product' => $inq['product']], $inq);
        }

        // Sample Wholesale Orders (Ready for Order Slip, Print & PDF Demo)
        $orders = [
            [
                'order_id' => 'MC-1001',
                'customer_name' => 'Arun Kumar',
                'business_name' => 'Apex Textiles Hub',
                'phone' => '9000000001',
                'location' => 'Madurai',
                'grand_total' => 19150,
                'items_json' => [
                    ['product' => 'Ankle Fit Leggings', 'color' => 'Black', 'color_hex' => '#000000', 'size' => 'Free Size (Regular)', 'quantity' => 50, 'unit_price' => 249, 'total' => 12450],
                    ['product' => 'Chudidhar Fit Leggings', 'color' => 'Maroon', 'color_hex' => '#800000', 'size' => 'XL (Extra Large)', 'quantity' => 25, 'unit_price' => 268, 'total' => 6700],
                ],
            ],
            [
                'order_id' => 'MC-1002',
                'customer_name' => 'Divya S',
                'business_name' => 'Aura Fashion Store',
                'phone' => '9000000004',
                'location' => 'Chennai',
                'grand_total' => 14950,
                'items_json' => [
                    ['product' => 'High-Waist Tummy Control Leggings', 'color' => 'Navy Blue', 'color_hex' => '#000080', 'size' => 'Large (L)', 'quantity' => 25, 'unit_price' => 399, 'total' => 9975],
                    ['product' => 'Capri 3/4th Leggings', 'color' => 'Rani Pink / Fuchsia', 'color_hex' => '#FF007F', 'size' => 'Medium (M)', 'quantity' => 25, 'unit_price' => 199, 'total' => 4975],
                ],
            ],
            [
                'order_id' => 'MC-1003',
                'customer_name' => 'Karthik N',
                'business_name' => 'Metro Apparel Mart',
                'phone' => '9000000002',
                'location' => 'Coimbatore',
                'grand_total' => 12870,
                'items_json' => [
                    ['product' => 'Seamless Sports Workout Leggings', 'color' => 'Charcoal Grey', 'color_hex' => '#36454F', 'size' => 'XL (Extra Large)', 'quantity' => 30, 'unit_price' => 429, 'total' => 12870],
                ],
            ],
        ];

        foreach ($orders as $ord) {
            Order::updateOrCreate(['order_id' => $ord['order_id']], $ord);
        }
    }
}
