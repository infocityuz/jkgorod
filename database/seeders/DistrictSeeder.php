<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
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
              'name' => 'Ташкент',
              'user_id' => '1'
          ],
          [
              'name' => 'Termiz',
              'user_id' => '1'
          ],
        ];

        District::insert($data);
    }
}
