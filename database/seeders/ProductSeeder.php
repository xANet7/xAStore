<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Samsung Galaxy S23', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 14 Pro Max', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi Note 12', 'category' => 'Xiaomi'],
            ['name' => 'Oppo Find X5', 'category' => 'Oppo'],
            ['name' => 'Vivo X80 Pro', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy A54', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone SE 2023', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi 11 Lite', 'category' => 'Xiaomi'],
            ['name' => 'Oppo Reno 8', 'category' => 'Oppo'],
            ['name' => 'Vivo V23', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy Z Fold 4', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 13 Mini', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Poco X4 Pro', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A96', 'category' => 'Oppo'],
            ['name' => 'Vivo Y55', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy A13', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 12', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi 10', 'category' => 'Xiaomi'],
            ['name' => 'Oppo F19', 'category' => 'Oppo'],
            ['name' => 'Vivo Y21', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy S21 FE', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 11', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi Note 10', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A74', 'category' => 'Oppo'],
            ['name' => 'Vivo V21', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy M33', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone XR', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Poco M4 Pro', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A53', 'category' => 'Oppo'],
            ['name' => 'Vivo Y20s', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy Z Flip 3', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone XS Max', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi 10T', 'category' => 'Xiaomi'],
            ['name' => 'Oppo F17', 'category' => 'Oppo'],
            ['name' => 'Vivo V20', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy A72', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 8 Plus', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi 9T', 'category' => 'Xiaomi'],
            ['name' => 'Oppo Reno 5', 'category' => 'Oppo'],
            ['name' => 'Vivo Y50', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy M12', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 7', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi Note 10', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A52', 'category' => 'Oppo'],
            ['name' => 'Vivo Y30', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy S20 Ultra', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 6s', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi 9', 'category' => 'Xiaomi'],
            ['name' => 'Oppo F15', 'category' => 'Oppo'],
            ['name' => 'Vivo S1', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy Note 20', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 6 Plus', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi 8', 'category' => 'Xiaomi'],
            ['name' => 'Oppo Reno 4', 'category' => 'Oppo'],
            ['name' => 'Vivo Y91C', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy A51', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone SE (2020)', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi Note 9', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A92', 'category' => 'Oppo'],
            ['name' => 'Vivo Y15', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy S10', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone X', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi 8', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A31', 'category' => 'Oppo'],
            ['name' => 'Vivo Y12', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy Note 10 Lite', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 6', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi 7', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A9 2020', 'category' => 'Oppo'],
            ['name' => 'Vivo Y11', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy A31', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 5s', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi A3', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A5s', 'category' => 'Oppo'],
            ['name' => 'Vivo V15', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy M21', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 5', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi 6A', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A1k', 'category' => 'Oppo'],
            ['name' => 'Vivo Y90', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy J7 Prime', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 4s', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi Go', 'category' => 'Xiaomi'],
            ['name' => 'Oppo Neo 7', 'category' => 'Oppo'],
            ['name' => 'Vivo V9', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy A10', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 4', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Redmi 5A', 'category' => 'Xiaomi'],
            ['name' => 'Oppo A37', 'category' => 'Oppo'],
            ['name' => 'Vivo Y83', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy J5', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 3G', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi Mix', 'category' => 'Xiaomi'],
            ['name' => 'Oppo R15', 'category' => 'Oppo'],
            ['name' => 'Vivo X21', 'category' => 'Vivo'],
            ['name' => 'Samsung Galaxy J2 Core', 'category' => 'Samsung'],
            ['name' => 'Apple iPhone 3GS', 'category' => 'iPhone'],
            ['name' => 'Xiaomi Mi 6', 'category' => 'Xiaomi'],
            ['name' => 'Oppo R11', 'category' => 'Oppo'],
            ['name' => 'Vivo V7', 'category' => 'Vivo'],
        ];

        $randomIndices = array_rand($products, 13);
        foreach ($products as $index => $product) {
            Product::create([
                'name' => $product['name'],
                'price' => rand(3000000, 20000000),
                'category' => $product['category'],
                'status' => in_array($index, (array) $randomIndices) ? 0 : 1,
                'created_at' => Carbon::now()->subDays(rand(0, 7))->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
