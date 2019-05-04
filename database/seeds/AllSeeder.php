<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Action;
use App\Models\Bus;
use App\Models\BusRoute;
use App\Models\Company;
use App\Models\Image;
use App\Models\Rating;
use App\Models\Permision;
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
        Action::truncate();
        Bus::truncate();
        BusRoute::truncate();
        Company::truncate();
        Image::truncate();
        Rating::truncate();
        Permision::truncate();
        Route::truncate();
        Station::truncate();
        Ticket::truncate();
        UserCompany::truncate();

        // user seeder
        factory(User::class)->create([
            'email' => 'superadmin@gmail.com',
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'type' => config('setting.user.role.super_admin'),
        ]);

        factory(User::class, 2)->create([
            'type' => config('setting.user.role.admin'),
        ]);

        factory(User::class, 5)->create([
            'type' => config('setting.user.role.super_manager'),
        ]);

        factory(User::class, 10)->create([
            'type' => config('setting.user.role.manager'),
        ]);

        $users = factory(User::class, 15)->create();

        //station
        $stations = factory(Provincial::class, 10)->create()->each(function($provincial) use ($faker) {
            $stations = factory(Station::class, 3)->create([
                'provincial_id' => $provincial->id,
            ]);
        });

        //permision
//        $permisions = Permision::create([
//            'name' => 'Super admin',
//        ]);

        // company
        factory(Company::class, 10)->create()->each(function($company) use ($faker, $stations, $users) {
            $buses = factory(Bus::class, 5)->create([
                'company_id' => $company->id,
            ]);

            $startStation = $stations->random()->id;
            $destinationStation = $stations->random()->id;

            while($destinationStation == $startStation) {
                $destinationStation = $stations->random()->id;
            }

            factory(Route::class, 3)->create([
                'company_id' => $company->id,
                'start_station_id' => $startStation,
                'destination_station_id' => $destinationStation,
            ])->each(function($route) use ($faker, $buses) {
                $route->busRoutes()->create([
                    'bus_id' => $buses->random()->id,
                    'price' => rand(100000, 200000),
                    'phone' => $faker->tollFreePhoneNumber(),
                ])->each(function($busStation) use ($faker) {
                    factory(Ticket::class, rand(30, 50))->create([
                        'bus_route_id' => $busStation->id,
                    ]);
                });
            });

            factory(Rating::class, 10)->create([
                'ratingable_id' => $company->id,
                'user_id' => $users->random()->id,
                'ratingable_type' => 'App\Models\Company',
            ]);

            factory(Image::class, 3)->create([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\Models\Company',
            ]);
        });
    }
}
