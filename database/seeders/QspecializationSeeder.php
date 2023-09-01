<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuestionexamSpecialization;

class QspecializationSeeder extends Seeder
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
                'specialization_id' => '1',
                'questionexam_id' => '1',
                'date' => '2/12/2000',
            ],
            [
                'specialization_id' => '3',
                'questionexam_id' => '4',
                'date' => '2/12/2000',
            ]
        ];
        foreach ($questions as $question) {
            QuestionexamSpecialization::create($question);
        }
    }
}