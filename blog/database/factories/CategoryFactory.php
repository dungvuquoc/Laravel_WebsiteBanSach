<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => $faker->numberBetween(6,10),
        'slug' => Str::slug($faker->name),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});
