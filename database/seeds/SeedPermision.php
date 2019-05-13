<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Action;
use App\Models\Permision;

class SeedPermision extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

//        Action::truncate();
//        Permision::truncate();
//
//        Permision::create(['name' => 'SuperAdmin']);
//        Permision::create(['name' => 'Admin']);
//        Permision::create(['name' => 'Read only']);
//        Permision::create(['name' => 'Edit']);
//        Permision::create(['name' => 'Create']);
//
//        Action::create(['name' => 'Create', 'CREATE']);
//        Action::create(['name' => 'Edit', 'EDIT']);
//        Action::create(['name' => 'View', 'VIEW']);
//        Action::create(['name' => 'Delete', 'DELETE']);
    }
}
