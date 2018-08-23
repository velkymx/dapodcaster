<?php

use Faker\Generator as Faker;

$factory->define(App\Show::class, function (Faker $faker) {
    return [
      'name' => $faker->sentence,
      'description' => $faker->paragraph,
      'status' => array_random(['active','inactive']),
      'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
