<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
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
            ['status' => 'Placed'],
            ['status' => 'Ship'],
            ['status' => 'On Delivery'],
            ['status' => 'Delivered'],
            ['status' => 'Completed'],
        ];
        \Illuminate\Support\Facades\DB::table('statuses')->insert(
            $data
        );
    }
}
