<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Temperature;
use Faker\Generator as Faker;

$factory->define(Temperature::class, function (Faker $faker) {
    $random = rand(15,45); 
    return [
        'temperature' => $random,
    ];
});
