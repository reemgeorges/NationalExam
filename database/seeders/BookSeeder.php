<?php

namespace Database\Seeders;

use App\Models\Questionbook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'uuid' => '123',
                'text_questions' => 'ماهي البرمجة',
                'item_id' => '5',
                'mark' => '2',
            ],
            [
                'uuid' => '124',
                'text_questions' => 'ماهي الاوتومات',
                'item_id' => '1',
                'mark' => '2',
            ],
            [
                'uuid' => '125',
                'text_questions' => 'هل قواعد البيانات مهمة ',
                'item_id' => '2',
                'mark' => '2',
            ],
            [
                'uuid' => '126',
                'text_questions' => "ماهو التشرح",
                'item_id' => '5',
                'mark' => '2',
            ],
        ];
        foreach ($questions as $question) {
            Questionbook::create($question);
        }
    }
}