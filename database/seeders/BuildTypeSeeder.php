<?php

namespace Database\Seeders;

use App\Models\BuildingType;
use App\Models\Street;
use Illuminate\Database\Seeder;

class BuildTypeSeeder extends Seeder
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
                'name' => 'Квартиры',
            ],
            [
                'name' => 'Комнаты',
            ],
            [
                'name' => 'Коммерческая',
            ],
            [
                'name' => 'Здание',
            ],
        ];

        BuildingType::insert($data);
    }
}
