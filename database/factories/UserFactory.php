<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Carbon\Carbon;

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
        'last_name' => $faker->name,
        'first_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'password', // password
        'role' => config('setting.user.role.user'),
    ];
});

$factory->define(App\Models\Bus::class, function (Faker $faker) {
    return [
        'lisense_plate' => $faker->swiftBicNumber(),
        'driver_name' => $faker->name,
        'number_of_seats' => 42,
        'number_row' => 7,
        'number_column' => 3,
        'number_level' => 2,
    ];
});

$factory->define(App\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(400),
        'address' => $faker->text(400),
        'description' => $faker->text(400),
        'phone' => $faker->tollFreePhoneNumber(),
        'address' => $faker->name,
        'latitude' => $faker->latitude(9, 22),
        'longitude' => $faker->longitude(103, 109),
    ];
});

$factory->define(App\Models\Image::class, function (Faker $faker) {
    return [
        'url' =>  $faker->imageUrl(640, 480),
    ];
});

$factory->define(App\Models\Rating::class, function (Faker $faker) {
    return [
        'rating' => $faker->numberBetween(0, 5),
        'comment' => $faker->text(200),
    ];
});

$factory->define(App\Models\Route::class, function (Faker $faker) {
    return [
        'start_time' => Carbon::now()->addDays(rand(-10, 10))->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60))->format('H:i'),
        'destination_time' => Carbon::now()->addDays(rand(-10, 10))->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60))->format('H:i'),
    ];
});

$factory->define(App\Models\Station::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->name,
        'latitude' => $faker->latitude(9, 22),
        'longitude' => $faker->longitude(103, 109),
    ];
});

$factory->define(App\Models\Provincial::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Models\Ticket::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->tollFreePhoneNumber(),
        'seat_number' => '[' . $faker->numberBetween(1, 42) . ']',
        'quantity' => 1,
        'date_away' => Carbon::now()->addDays(rand(0, 10))->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60)),
    ];
});
