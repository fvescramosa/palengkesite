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
            ['category' => 'Vegetables and Fruits', 'slug' => \Illuminate\Support\Str::slug('Vegetables and Fruits')],
            ['category' => 'Meat', 'slug' => \Illuminate\Support\Str::slug('Meat')],
            ['category' => 'Fish', 'slug' => \Illuminate\Support\Str::slug('Fish')],
            ['category' => 'Textile and Footwear', 'slug' => \Illuminate\Support\Str::slug('Textile and Footwear')],
            ['category' => 'Poultry/Dried Fish', 'slug' => \Illuminate\Support\Str::slug('Poultry/Dried Fish')],
            ['category' => 'Groceries/Sari-Sari', 'slug' => \Illuminate\Support\Str::slug('Groceries/Sari-Sari')],
            ['category' => 'Eatery/Refreshment Parlors', 'slug' => \Illuminate\Support\Str::slug('Eatery/Refreshment Parlors')],
            ['category' => 'Commercial and Special Services', 'slug' => \Illuminate\Support\Str::slug('Commercial and Special Services')],
            ['category' => 'Cakes and Pastries', 'slug' => \Illuminate\Support\Str::slug('Cakes and Pastries')],
            ['category' => 'General Merchandise', 'slug' => \Illuminate\Support\Str::slug('General Merchandise')],
        ];
        DB::table('categories')->insert(
            $data
        );
    }
}
