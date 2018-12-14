<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {

	$title = $faker->sentence;
    return [

        'title' => $title,
        'content' =>$faker->paragraph,
        'slug' => str_slug($title),
    ];
});
