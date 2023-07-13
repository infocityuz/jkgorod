<?php

namespace Database\Seeders;

use App\Models\ObjectCategory;
use App\Models\ObjectRegion;
use Illuminate\Database\Seeder;

class ObjectRegionSeeder extends Seeder
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
                'object_region' => 'Tashkent',
            ],
            [
                'object_region' => 'Termiz',
            ]
        ];

        ObjectRegion::insert($data);
    }
}
