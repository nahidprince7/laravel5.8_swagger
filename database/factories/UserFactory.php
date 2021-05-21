<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Example',
        'email' => 'example@example.com',
        'pin'=>11139,
        'gender' => 1,
        'religion' => 1,
        //'email_verified_at' => now(),
        'department_id'=>1,
        'password' => '$2y$10$wDZYKA3dcZm5bW1P6GJwxedPlXMnaJW4/cOrDnrvG/XzS9vU36dsK', // password = 11111,
        'created_by' => 0,
        'updated_by' => 0
    ];
});
