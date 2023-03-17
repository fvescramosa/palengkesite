<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'product_name' => 'Rebisco Chocolate',
                'max_price' => 12,
                'min_price' => 10,
                'srp' => 12,
                'category_id' => 6,
                'type' => 0
            ],

            [
                'product_name' => 'Nescafe 3 & 1 Original',
                'max_price' => 12,
                'min_price' => 10,
                'srp' => 12,
                'category_id' => 6,
                'type' => 0
            ],

            [
                'product_name' => 'Nestle Coffeemate',
                'max_price' => 12,
                'min_price' => 10,
                'srp' => 12,
                'category_id' => 6,
                'type' => 0
            ],

            [
                'product_name' => 'Nescafe Coffee',
                'max_price' => 12,
                'min_price' => 10,
                'srp' => 12,
                'category_id' => 6,
                'type' => 0
            ],

            [
                'product_name' => 'Live Tilapia',
                'max_price' => 12,
                'min_price' => 10,
                'srp' => 12,
                'category_id' => 3,
                'type' => 0
            ],

            [
                'product_name' => 'Bangus',
                'max_price' => 12,
                'min_price' => 10,
                'srp' => 12,
                'category_id' => 3,
                'type' => 0
            ],

            [
                'product_name' => 'Hipon',
                'max_price' => 12,
                'min_price' => 10,
                'srp' => 12,
                'category_id' => 3,
                'type' => 0
            ],
            [
                'product_name' => 'Sapatos by Batangas Shoe Exchange',
                'max_price' => 980,
                'min_price' => 950,
                'srp' => 950,
                'category_id' => 4,
                'type' => 0
            ],

            [
                'product_name' => 'Takong',
                'max_price' => 750,
                'min_price' => 700,
                'srp' => 700,
                'category_id' => 4,
                'type' => 0
            ],

            [
                'product_name' => 'Karneng Baboy',
                'max_price' => 270,
                'min_price' => 270,
                'srp' => 270,
                'category_id' => 2,
                'type' => 0
            ],

            [
                'product_name' => 'Karneng Baka',
                'max_price' => 270,
                'min_price' => 270,
                'srp' => 270,
                'category_id' => 2,
                'type' => 0
            ],

            [
                'product_name' => 'Manok',
                'max_price' => 270,
                'min_price' => 270,
                'srp' => 270,
                'category_id' => 2,
                'type' => 0
            ],

            [
                'product_name' => 'Sibuyas',
                'max_price' => 270,
                'min_price' => 270,
                'srp' => 270,
                'category_id' => 1,
                'type' => 0
            ],

            [
                'product_name' => 'Saging',
                'max_price' => 100,
                'min_price' => 100,
                'srp' => 100,
                'category_id' => 1,
                'type' => 0
            ],

            [
                'product_name' => 'Apple',
                'max_price' => 100,
                'min_price' => 100,
                'srp' => 100,
                'category_id' => 1,
                'type' => 0
            ],

            [
                'product_name' => 'Mango',
                'max_price' => 100,
                'min_price' => 100,
                'srp' => 100,
                'category_id' => 1,
                'type' => 0
            ],

            [
                'product_name' => 'Pandesal',
                'max_price' => 3,
                'min_price' => 2,
                'srp' => 2,
                'category_id' => 9,
                'type' => 0
            ],

            [
                'product_name' => 'Monay',
                'max_price' => 2,
                'min_price' => 2,
                'srp' => 2,
                'category_id' => 9,
                'type' => 0
            ],

            [
                'product_name' => 'Tasty',
                'max_price' => 65,
                'min_price' => 60,
                'srp' => 60,
                'category_id' => 6,
                'type' => 0
            ],
        ];
        DB::table('products')->insert(
            $data
        );
    }
}
