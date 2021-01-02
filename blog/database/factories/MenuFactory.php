<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Menu::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => $faker->numberBetween(40, 59),
        'slug' => Str::slug($faker->name),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});
