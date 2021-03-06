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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Pmptadl\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'organization' => rand(1,6),
        'title' => $faker->jobTitle,
        'officeAddress'=>$faker->address,
        'userType' => 'architect'
        ];
});


