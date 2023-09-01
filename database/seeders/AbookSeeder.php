<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnswerBook;

class AbookSeeder extends Seeder
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
                'questionbook_id'=>'1'
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'2',
                'questionbook_id'=>'1'
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'3',
                'questionbook_id'=>'1'
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'4',
                'questionbook_id'=>'1'
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'2',
                'questionbook_id'=>'2'
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'5',
                'questionbook_id'=>'2'
            ],
            [
                'is_correct'=>'0',
                'answer_id'=>'6',
                'questionbook_id'=>'2'
            ],
            [
                'is_correct'=>'1',
                'answer_id'=>'7',
                'questionbook_id'=>'2'
            ],
        ];
        foreach($answers as $answer){
            AnswerBook::create($answer);
        }
    }
}
