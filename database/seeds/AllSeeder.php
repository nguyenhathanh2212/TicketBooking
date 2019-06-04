<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Action;
use App\Models\Permision;
use App\Models\Bus;
use App\Models\BusRoute;
use App\Models\Company;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Route;
use App\Models\Station;
use App\Models\Ticket;
use App\Models\UserCompany;
use App\Models\Provincial;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::truncate();
        Bus::truncate();
        Company::truncate();
        Image::truncate();
        Rating::truncate();
        Route::truncate();
        Ticket::truncate();
        UserCompany::truncate();

        // user seeder
        factory(User::class)->create([
            'email' => 'superadmin@gmail.com',
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'role' => config('setting.user.role.super_admin'),
        ]);

        factory(User::class, 2)->create([
            'role' => config('setting.user.role.admin'),
        ]);

        $users = factory(User::class, 25)->create();
        $stations = Station::all();
        // company

        foreach ($stations as $station) {
            $companies = factory(Company::class, 1)->create([
                'station_id' => $station->id
            ])->each(function($company) use ($faker, $stations, $station, $users) {
                $buses = factory(Bus::class, 2)->create([
                    'company_id' => $company->id,
                ]);

//                factory(Rating::class, 5)->create([
//                    'ratingable_id' => $company->id,
//                    'user_id' => $users->random()->id,
//                    'ratingable_type' => 'App\Models\Company',
//                ]);
//
//                factory(Image::class, 3)->create([
//                    'imageable_id' => $company->id,
//                    'imageable_type' => 'App\Models\Company',
//                ]);

                $startStation = $station->id;
                $stationsIdDn = Station::where('provincial_id', 1)->pluck('id')->all();

                if (in_array($startStation, $stationsIdDn)) {
                    $destinationStation = $stations->random()->id;

                    while(in_array($destinationStation, $stationsIdDn)) {
                        $destinationStation = $stations->random()->id;
                    }
                } else {
                    $destinationStation = Station::where('provincial_id', 1)->get()->random()->id;
                }

                factory(Route::class, 2)->create([
                    'company_id' => $company->id,
                    'start_station_id' => $destinationStation,
                    'destination_station_id' => $startStation,
                ])->each(function($route) use ($faker, $buses) {
                    $route->busRoutes()->create([
                        'bus_id' => $buses->random()->id,
                        'price' => rand(100000, 200000),
                        'phone' => $faker->tollFreePhoneNumber(),
                    ])->each(function($busStation) use ($faker) {
                    //    factory(Ticket::class, rand(5, 10))->create([
                    //        'user_id' => User::inRandomOrder()->first()->id,
                    //        'bus_route_id' => $busStation->id,
                    //    ]);
                    });
                });
            });
        }

//        foreach ($companies as $company) {
//            $company->userCompanies()->create([
//                'user_id' => $users->random()->id,
//                'role' => rand(0,1),
//            ]);
//        }
    }
}
