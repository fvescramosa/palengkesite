<?php

use App\Stall;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(Stall::class, 15)->create();
         $this->call(UserTypeSeeder::class);
         $this->call(AdminSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(MarketSeeder::class);
         $this->call(PaymentOptionsSeeder::class);
    }
}
