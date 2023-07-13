<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Street;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Алмазарский район',
                'user_id' => '1'
            ],
            [
                'name' => 'Бектемирский район',
                'user_id' => '1'
            ],
        ];

        Street::insert($data);
    }
}
