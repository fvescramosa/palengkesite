<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
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
            ['user_type' => 'buyer'],
            ['user_type' => 'seller'],
            ['user_type' => 'admin'],
        ];
        DB::table('user_types')->insert(
            $data
        );
    }
}
