<?php

namespace Database\Seeders;

use App\Models\ThereIsNearby;
use Illuminate\Database\Seeder;

class ThereIsNerabySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Больница/Поликлиника'],
            ['name' => 'Детская Площадка'],
            ['name' => 'Детский Сад'],
            ['name' => 'Школы'],
            ['name' => 'Развитая Инфраструктура'],
            ['name' => 'Парк/Зеленая зона'],
            ['name' => 'ТЦ(Развлекательные Центр)'],
            ['name' => 'Рестораны/Кафе'],
            ['name' => 'Стоянка'],
            ['name' => 'Супермаркет/Магазины'],
        ];

        ThereIsNearby::insert($data);
    }
}
