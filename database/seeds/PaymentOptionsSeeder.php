<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentOptionsSeeder extends Seeder
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
            ['payment_option' => 'PayPal'],
            ['payment_option' => 'COD'],
        ];
        DB::table('payment_options')->insert(
            $data
        );
    }
}
