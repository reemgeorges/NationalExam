<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'uuid' => '123',
                'name' => 'اوتومات',
                'collage_id' => '1',
            ],
            [
                'uuid' => '124',
                'name' => 'قواعد بيانات',
                'collage_id' => '1',
            ],
            [
                'uuid' => '125',
                'name' => 'هندسة برمجيات',
                'collage_id' => '1',
            ],
            [
                'uuid' => '126',
                'name' => 'ذكاء صنعي',
                'collage_id' => '1',
            ],
            [
                'uuid' => '127',
                'name' => 'برمجة',
                'collage_id' => '1',
            ],
            [
                'uuid' => '128',
                'name' => 'شبكات',
                'collage_id' => '1',
            ],
            [
                'uuid' => '129',
                'name' => 'تشريح',
                'collage_id' => '4',
            ],
            [
                'uuid' => '131',
                'name' => 'لبية',
                'collage_id' => '3',
            ],
            [
                'uuid' => '132',
                'name' => 'انشاء',
                'collage_id' => '2',
            ],
        ];
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}