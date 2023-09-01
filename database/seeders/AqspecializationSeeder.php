<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnswerQuestionSpecialization;
class AqspecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers=[
            [
                'is_correct'=>'1',
                'answer_id'=>'1',
                'questionexam_specialization_id'=>'1',
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'2',
                'questionexam_specialization_id'=>'1',
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'3',
                'questionexam_specialization_id'=>'1',
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'4',
                'questionexam_specialization_id'=>'1',
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'5',
                'questionexam_specialization_id'=>'2',
            ],
            [
                'is_correct'=>'1',
                'answer_id'=>'8',
                'questionexam_specialization_id'=>'2',
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'7',
                'questionexam_specialization_id'=>'2',
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'9',
                'questionexam_specialization_id'=>'2',
            ],
        ];
        foreach($answers as $answer){
            AnswerQuestionSpecialization::create($answer);
        }
    }
}
