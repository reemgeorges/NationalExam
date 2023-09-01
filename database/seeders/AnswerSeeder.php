<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
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
                'uuid'=>'123',
                'answer_text'=>'علم',
            ],
            [
                'uuid'=>'124',
                'answer_text'=>'قن',
            ],
            [
                'uuid'=>'125',
                'answer_text'=>'رياضة',
            ],
            [
                'uuid'=>'126',
                'answer_text'=>'سياحة',
            ],
            [
                'uuid'=>'127',
                'answer_text'=>'موز',
            ],
            [
                'uuid'=>'128',
                'answer_text'=>'صح',
            ],
            [
                'uuid'=>'129',
                'answer_text'=>'خطأ',
            ],
            [
                'uuid'=>'131',
                'answer_text'=>'كل ما سبق صحيح',
            ],
            [
                'uuid'=>'132',
                'answer_text'=>'كل ما سبق خطأ',
            ],
            [
                'uuid'=>'133',
                'answer_text'=>'مروحة',
            ],
            [
                'uuid'=>'134',
                'answer_text'=>'مكيف',
            ],
        ];
        foreach($answers as $answer){
            Answer::create($answer);
        }
    }
}
