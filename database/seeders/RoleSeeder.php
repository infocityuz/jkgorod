<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Администратор'],
            ['name' => 'Менеджер'],
            ['name' => 'Агент'],
            ['name' => 'Бухгалтер'],
            ['name' => 'Юрист'],
            ['name' => 'HR'],
            ['name' => 'Стажёр'],
        ];

        Role::insert($data);
    }
}
