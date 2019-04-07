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
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // 'role_id' => config('setting.user.role.user'),
    ];
});

$factory->define(App\Models\Bus::class, function (Faker $faker) {
    return [
        'lisense_plate' => $faker->swiftBicNumber(),
        'driver_name' => $faker->name,
        'number_of_seats' => $faker->numberBetween(16, 50),
        'type_bus' => 0,
    ];
});

$factory->define(App\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(400),
    ];
});

$factory->define(App\Models\Image::class, function (Faker $faker) {
    return [
        'url' =>  $faker->imageUrl(640, 480),
    ];
});

$factory->define(App\Models\Rating::class, function (Faker $faker) {
    return [
        'overview' => $faker->numberBetween(0, 5),
        'quality' => $faker->numberBetween(0, 5),
        'on_time' => $faker->numberBetween(0, 5),
        'comment' => $faker->text(200),
    ];
});

$factory->define(App\Models\Route::class, function (Faker $faker) {
    return [
        'start_time' => Carbon::now()->addDays(rand(-10, 10))->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60)),
        'destination_time' => Carbon::now()->addDays(rand(-10, 10))->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60)),
    ];
});

$factory->define(App\Models\Station::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'location_name' => $faker->name,
        'latitude' => $faker->latitude(9, 22),
        'longitude' => $faker->longitude(103, 109),
    ];
});

$factory->define(App\Models\Ticket::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->tollFreePhoneNumber(),
        'seat_number' => $faker->numberBetween(16, 50),
        'quantity' => $faker->numberBetween(1, 3),
        'day_away' => Carbon::now()->addDays(rand(-10, 10))->addMinutes(rand(0, 60 * 23))->addSeconds(rand(0, 60)),
    ];
});
