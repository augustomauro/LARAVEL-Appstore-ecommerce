<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Application;
use Faker\Generator as Faker;

// Recursive function to generate product codes in a random and non-repetitive way
function random_id(String $string) {
    $id = mt_rand(000,999);  // Between 000 and 999
    $applications = Application::all();
        foreach ($applications as $application) {
            if ($application->name == $string.$id) {
                random_id($string);
            }
        }
    return $string.$id;
}

$factory->define(Application::class, function (Faker $faker) {

    $name = random_id('App #');

    return [
        'user_id' => $faker->numberBetween(1,2),
        'category_id' => $faker->numberBetween(1,5),
        'name' => $name,
        'image' => $faker->imageUrl($width = 512, $height = 512),
        'price' => $faker->randomFloat(2,1,1000),
        'description' => 'Here comes the description of this Application'
        // 'description' => $faker->text(10)
    ];

});
