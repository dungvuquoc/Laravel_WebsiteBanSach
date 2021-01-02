<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Slider::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 30),
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
        'image_name' => $faker->imageUrl($width = 640, $height = 480),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});
