<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['market' => 'Poblacion'],
            ['market' => 'Anilao'],
            ['market' => 'Talaga'],
        ];
        DB::table('markets')->insert(
            $data
        );
    }
}
