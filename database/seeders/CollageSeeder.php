<?php

namespace Database\Seeders;

use App\Models\Collage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collages = [
            [
                'uuid' => '123',
                'name' => 'معلوماتية',
                'type' => 'هندسة'
            ],
            [
                'uuid' => '124',
                'name' => 'عمارة',
                'type' => 'هندسة'
            ],
            [
                'uuid' => '125',
                'name' => 'اسنان',
                'type' => 'طبية'
            ],
            [
                'uuid' => '126',
                'name' => 'صيدلة',
                'type' => 'طبية'
            ]
        ];
        foreach ($collages as $collage) {
            Collage::create($collage);
        }
    }
}