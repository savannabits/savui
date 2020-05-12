<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Savannabits\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->sentence,
        'user_number' => $faker->sentence,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
    ];
});