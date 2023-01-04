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
            ['category' => 'fruits'],
            ['category' => 'meat'],
            ['category' => 'vegetables'],
            ['category' => 'fish'],
            ['category' => 'grocery'],
        ];
        DB::table('categories')->insert(
            $data
        );
    }
}
