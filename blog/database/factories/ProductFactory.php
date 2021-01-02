<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(30000,50000),
        'feature_image_path' => $faker->imageUrl($width = 640, $height = 480),
        'feature_image_name' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => 3,
        'content' => $faker->text($maxNbChars = 30),
        'category_id' => $faker->numberBetween(1,10),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});
