<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
            ['category' => 'Vegetables and Fruits'],
            ['category' => 'Meat'],
            ['category' => 'Fish'],
            ['category' => 'Textile and Footwear'],
            ['category' => 'Poultry/Dried Fish'],
            ['category' => 'Groceries/Sari-Sari'],
            ['category' => 'Eatery/Refreshment Parlors'],
            ['category' => 'Commercial and Special Services'],
            ['category' => 'Cakes and Pastries'],
            ['category' => 'General Merchandise'],
        ];
        DB::table('categories')->insert(
            $data
        );
    }
}
