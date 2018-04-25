<?php

use Faker\Generator as Faker;

$factory->define(App\Trip::class, function (Faker $faker) {
  return [
    'slug' => $faker->word,
    'name' => $faker->word,
    'description' => $faker->paragraph(3),
    'start_date' => $faker->date,
    'end_date' => $faker->date,
    'color' => $faker->rgb,
  ];
});
