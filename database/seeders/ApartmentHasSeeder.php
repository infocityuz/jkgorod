<?php

namespace Database\Seeders;

use App\Models\ApartmentHas;
use Illuminate\Database\Seeder;

class ApartmentHasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Интернет'],
            ['name' => 'Телефон'],
            ['name' => 'Холодильник'],
            ['name' => 'Телевизор'],
            ['name' => 'Кондиционер'],
            ['name' => 'Кабельное ТВ'],
            ['name' => 'Стиральная Машина'],
            ['name' => 'Кухня'],
            ['name' => 'Балкон'],
        ];

        ApartmentHas::insert($data);
    }
}
