<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Questionexam;

class ExamSeeder extends Seeder
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
                'text_questions' => '1ماهي البرمجة',
                'item_id' => '5',
                'mark' => '2',
            ],
            [
                'uuid' => '124',
                'text_questions' => '1ماهي الاوتومات',
                'item_id' => '1',
                'mark' => '2',
            ],
            [
                'uuid' => '125',
                'text_questions' => '1هل قواعد البيانات مهمة ',
                'item_id' => '2',
                'mark' => '2',
            ],
            [
                'uuid' => '126',
                'text_questions' => "1ماهو التشريح",
                'item_id' => '5',
                'mark' => '2',
            ],
        ];
        foreach ($questions as $question) {
            Questionexam::create($question);
        }
    }
}