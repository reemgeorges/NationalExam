<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            [
                'uuid' => '123',
                'name' => 'تخرج معلوماتية',
                'collage_id' => '1'
            ],
            [
                'uuid' => '124',
                'name' => 'تخرج عمارة',
                'collage_id' => '2'
            ],
            [
                'uuid' => '124',
                'name' => 'تخرج اسنان',
                'collage_id' => '3'
            ],
            [
                'uuid' => '125',
                'name' => 'تخرج صيدلة',
                'collage_id' => '4'
            ],
            [
                'uuid' => '126',
                'name' => 'ماستر شبكات',
                'collage_id' => '1'
            ],
            [
                'uuid' => '127',
                'name' => 'ماستر ذكاء',
                'collage_id' => '1'
            ],
            [
                'uuid' => '128',
                'name' => 'ماستر هندسة برمجيات',
                'collage_id' => '1'
            ],
        ];
        foreach ($specializations as $specialization) {
            Specialization::create($specialization);
        }
    }
}