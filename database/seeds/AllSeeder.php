<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bus;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Route;
use App\Models\Station;
use App\Models\Ticket;
use App\Models\TypeBus;

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

        Bus::truncate();
        Image::truncate();
        Rating::truncate();
        Route::truncate();
        Ticket::truncate();

        // user seeder
        factory(User::class)->create([
            'email' => 'admin@gmail.com',
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'role' => config('setting.user.role.super_admin'),
        ]);

        factory(User::class, 2)->create([
            'role' => config('setting.user.role.admin'),
        ]);

        $users = factory(User::class, 10)->create();
        $stations = Station::all();

        $prices = [
            100000,
            150000,
            200000,
            300000,
        ];

        foreach ($stations as $station) {
            factory(Image::class, 1)->create([
                'imageable_id' => $station->id,
                'imageable_type' => 'App\Models\Station',
                'url' => '/images/station/station' . rand(1, 11) . '.jpg',
            ]);
            foreach($station->companies as $company) {
                $busTypeIds = TypeBus::pluck('id')->all();
                array_push($busTypeIds, 0);

                for ($index = 0; $index <= 2; $index++) {
                    $busTypeId = $busTypeIds[array_rand($busTypeIds)];

                    $buses = factory(Bus::class, 1)->create([
                        'company_id' => $company->id,
                        'number_of_seats' => $busTypeId == 0 ? 29 : null,
                        'type_bus_id' => $busTypeId,
                    ]);
                }

                factory(Rating::class, 1)->create([
                    'ratingable_id' => $company->id,
                    'user_id' => $users->random()->id,
                    'ratingable_type' => 'App\Models\Company',
                ]);

                for ($imageIndex = 0; $imageIndex <= 2; $imageIndex ++) {
                    factory(Image::class, 1)->create([
                        'imageable_id' => $company->id,
                        'imageable_type' => 'App\Models\Company',
                        'url' => '/images/bus_company/' . rand(1, 12) . '.jpg',
                    ]);
                }

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
                    'start_station_id' => $startStation,
                    'destination_station_id' => $destinationStation,
                ])->each(function($route) use ($faker, $buses, $prices, $users) {
                    $busRoutes = $route->busRoutes()->createMany([
                        [
                            'bus_id' => $buses->random()->id,
                            'price' => $prices[array_rand($prices)],
                            'phone' => '0344764057',
                        ],
                        [
                            'bus_id' => $buses->random()->id,
                            'price' => $prices[array_rand($prices)],
                            'phone' => '0344764057',
                        ]
                    ]);

                    foreach ($busRoutes as $busRoute) {
                        factory(Rating::class, 1)->create([
                            'ratingable_id' => $busRoute->id,
                            'user_id' => $users->random()->id,
                            'ratingable_type' => 'App\Models\BusRoute',
                        ]);
                        //    factory(Ticket::class, rand(5, 10))->create([
                        //        'user_id' => User::inRandomOrder()->first()->id,
                        //        'bus_route_id' => $busStation->id,
                        //    ]);
                    }
                });

                factory(Route::class, 2)->create([
                    'company_id' => $company->id,
                    'start_station_id' => $destinationStation,
                    'destination_station_id' => $startStation,
                ])->each(function($route) use ($faker, $buses, $prices, $users) {
                    $busRoutes = $route->busRoutes()->createMany([
                        [
                            'bus_id' => $buses->random()->id,
                            'price' => $prices[array_rand($prices)],
                            'phone' => '0344764057',
                        ],
                        [
                            'bus_id' => $buses->random()->id,
                            'price' => $prices[array_rand($prices)],
                            'phone' => '0344764057',
                        ]
                    ]);

                    foreach ($busRoutes as $busRoute) {
                        factory(Rating::class, 1)->create([
                            'ratingable_id' => $busRoute->id,
                            'user_id' => $users->random()->id,
                            'ratingable_type' => 'App\Models\BusRoute',
                        ]);
//                        factory(Ticket::class, rand(5, 10))->create([
//                            'user_id' => User::inRandomOrder()->first()->id,
//                            'bus_route_id' => $busRoute->id,
//                        ]);
                    }
                });
            };
        }
    }
}
