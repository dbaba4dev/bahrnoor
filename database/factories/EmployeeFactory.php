<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\Model;
use Faker\Generator as Faker;


$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'category_id' => $faker->numberBetween(1,4),
        'joined' => $faker->date()

    ];
});
