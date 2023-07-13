<?php

namespace Database\Seeders;

use App\Models\Repair;
use App\Models\Street;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
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
                'name' => 'Евро',
            ],
            [
                'name' => 'Дизайнерский',
            ],
            [
                'name' => 'Частичный ремонт',
            ],
            [
                'name' => 'Хороший',
            ],
            [
                'name' => 'С отделкой',
            ],
            [
                'name' => 'Черновая отделка'
            ],
            [
                'name' => 'Требуется ремонт'
            ],
            [
                'name' => 'Косметический'
            ],
            [
                'name' => 'Eвроремонт'
            ],
            [
                'name' => 'Требует ремонта'
            ],
            [
                'name' => 'Без отделки'
            ],
            [
                'name' => 'Офисная'
            ],
            [
                'name' => 'Чистовая'
            ],
            [
                'name' => 'Предчистовая'
            ],
            [
                'name' => 'Отличное'
            ],
            [
                'name' => 'Хорошее'
            ],
            [
                'name' => 'Авторский Проект'
            ],
            [
                'name' => 'Средний Ремонт'
            ],
        ];

        Repair::insert($data);
    }
}
