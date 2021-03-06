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
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'password' => 'password', // password
        'role' => config('setting.user.role.user'),
    ];
});

$factory->define(App\Models\Bus::class, function (Faker $faker) {
    return [
        'lisense_plate' => '30F - ' . rand(10000, 99999),//$faker->swiftBicNumber(),
        'driver_name' => $faker->name,
        'number_of_seats' => 29,
    ];
});

$factory->define(App\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->text(200),
        'description' => $faker->text(400),
        'phone' => '0344764057',
    ];
});

$factory->define(App\Models\Image::class, function (Faker $faker) {
    return [
        'url' =>  $faker->imageUrl(640, 480),
    ];
});

$factory->define(App\Models\Rating::class, function (Faker $faker) {
    return [
        'rating' => $faker->numberBetween(1, 5),
        'comment' => $faker->text(200),
    ];
});

$factory->define(App\Models\Route::class, function (Faker $faker) {
    $startTime = Carbon::now()->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60))->format('H:i');
    $destinationTime = Carbon::parse($startTime)->addHours(4)->format('H:i');

    return [
        'start_time' => $startTime,
        'destination_time' => $destinationTime,
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
        'phone' => '0344764057',
        'seat_number' => '[' . $faker->numberBetween(1, 42) . ']',
        'quantity' => 1,
        'total_price' => 100000,
        'email' => $faker->unique()->safeEmail,
        'date_away' => Carbon::now()->addDays(rand(0, 10))->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60)),
    ];
});
