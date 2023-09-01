<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'uuid' => '123',
                'name' => 'مصطفى',
                'phone' => '0911111111',
                'collage_id' => '1',
                'code' => '1234',
            ],
            [
                'uuid' => '124',
                'name' => 'ربيع',
                'phone' => '0911111112',
                'collage_id' => '1',
                'code' => '1235',
            ],
            [
                'uuid' => '125',
                'name' => 'نور',
                'phone' => '0911111113',
                'collage_id' => '1',
                'code' => '1236',
            ],
            [
                'uuid' => '126',
                'name' => 'ماجد',
                'phone' => '0911111114',
                'collage_id' => '1',
                'code' => '1237',
            ],
            [
                'uuid' => '127',
                'name' => 'عبد الله',
                'phone' => '0911111115',
                'collage_id' => '1',
                'code' => '1238',
            ],
            [
                'uuid' => '128',
                'name' => 'فهد',
                'phone' => '0911111116',
                'collage_id' => '2',
                'code' => '1239',
            ],
            [
                'uuid' => '129',
                'name' => 'محمد',
                'phone' => '0911111117',
                'collage_id' => '4',
                'code' => '1241',
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}