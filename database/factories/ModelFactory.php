<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(4)
    ];
});

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    return [
        'subject' => $faker->sentence(4),
        'content' => $faker->paragraph(4),
        'startDate' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'endDate' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'idUser' => mt_rand(1, 10),
        'idCategory' => mt_rand(1, 5)
    ];
});

$factory->define(App\Problematic::class, function (Faker\Generator $faker) {
    return [
        'entitled' => $faker->sentence(4),
        'movieUrl' => $faker->paragraph(4),
        'caption' => $faker->paragraph(4),
        'idUser' => mt_rand(1, 10),
        'idLesson' => mt_rand(1, 20)
    ];
});

$factory->define(App\Commentary::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->paragraph(4),
        'idUser' => mt_rand(1, 10),
        'idProblematic' => mt_rand(1, 50)
    ];
});

$factory->define(App\Mark::class, function (Faker\Generator $faker) {
    return [
        'value' => mt_rand(1, 5),
        'idUser' => mt_rand(1, 10),
        'idProblematic' => mt_rand(1, 50)
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $hasher = app()->make('hash');

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'isTeacher' => true,
        'isActive' => true,
        'password' => $hasher->make("secret")
    ];
});
