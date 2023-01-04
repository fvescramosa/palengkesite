<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stall;
use Faker\Generator as Faker;

$factory->define(Stall::class, function (Faker $faker) {

    static $stall_number;

    $stall_number = 0;
    return [
        //s
        'number' => $faker->unique()->numberBetween(1,15),
        'sqm' => '100',
        'amount_sqm' => '25',
        'rental_fee' => '1000',
        'section' => $faker->randomElement(['meat', 'vegetable', 'groceries', 'fish']),
        'market' => 'poblacion',
        'image' => $faker->imageUrl(640,480, null, false),
        'image_1' => $faker->imageUrl(640,480, null, false),
        'image_2' => $faker->imageUrl(640,480, null, false),
        'image_3' => $faker->imageUrl(640,480, null, false),
        'image_4' => $faker->imageUrl(640,480, null, false),
        'image_5' => $faker->imageUrl(640,480, null, false),
        'status' => 'vacant',

    ];
});
