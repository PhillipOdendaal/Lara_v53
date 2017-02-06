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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    $int = mt_rand(1262055681,1262055681);
    
    return [
        'pk_id' => rand (0,10),
        'description' => $faker->text,
        'start_date' => date("Y-m-d",$int),
        'end_date' => null,
        'is_billable' => (bool)rand(0,1),
        'is_active' => (bool)rand(0,1),
    ];
});
 
$factory->define(App\Task::class, function (Faker\Generator $faker) {
    $int = mt_rand(1262055681,1262055681);
    $tasks = App\Task::pluck('id')->toArray();
    
    return [
        'pk_id' => rand (0,10),
        'title' => $faker->unique()->name,
        'due_date' => date("Y-m-d",$int),
        'estimated_hours' => date("HH:MM:SS",$int),
        'project' => $tasks,
    ];
});