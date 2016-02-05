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

$factory->define(AllAccessRMS\Accounts\Users\User::class, function ($faker) {
    return [
        'firstname' => $faker->firstname,
        'lastname'  => $faker->lastname,
        'email' => $faker->email,
        'active' => 1,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(AllAccessRMS\Accounts\Users\Role::class, function ($faker) {
    return [
        'id' => 2,
        'name'=> 'admin',
        'display_name'  => 'Administrator',
        'description' => 'Administrators have administrative access to the system.',
    ];
});

$factory->define(AllAccessRMS\Accounts\Organizations\Organization::class, function ($faker) {
    return [
        'name' => $faker->name,
        'parent_id' => 1,
    ];
});

$factory->define(AllAccessRMS\EventRegistrations\Event::class, function ($faker) {
    return [
        'title' => 'Super Extravaganza',
        'description' => 'This the description for Super Extravaganza',
        'start_date' => '01/01/2015',
        'end_date' => '02/01/2015',
        'start_time' => '08:00:00',
        'end_time' => '14:00:00',
        'contact_phone' => '714-767-0354',
        'price' => 12000,
        'capacity' => 400
    ];
});