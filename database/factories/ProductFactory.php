<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->name(),
        'supplier' => $faker->streetName(),
        'category_id' => 2,
        'quantity' => $faker->ean8(),
        'unit_price' => $faker->ean8(),
        'discount' => 12,
        'status' => 1,
        'description' => $faker->text(),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'size_s' => 1,
        'size_m' => 1,
        'size_l' => 0,
        'size_xl' => 1,
        'size_xxl' => 0,
    ];
});
