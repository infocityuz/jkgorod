<?php

namespace Database\Seeders;

use App\Models\ThereIsNearby;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DistrictSeeder::class);
        $this->call(StreetSeeder::class);
        $this->call(ObjectRegionSeeder::class);
        $this->call(BuildTypeSeeder::class);
        $this->call(ApartmentHasSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ThereIsNerabySeeder::class);
    }
}
