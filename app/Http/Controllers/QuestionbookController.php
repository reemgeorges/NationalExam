<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionbookResource;
use App\Models\Answer;
use App\Models\Questionbook;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;

class QuestionbookController extends Controller
{
    use GeneralTrait;
    public function revision(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'questions' => ['required', 'array'],
            'questions.*.question_uuid' => ['required', 'string'],
            'questions.*.answer_uuid' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try {
            $mark = 0;
         
            foreach ($request->input('questions') as $question) {
                $question_book = Questionbook::where('uuid', $question['question_uuid'])->firstOrFail();

                $isCorrect = $question_book->answers->where('uuid', $question['answer_uuid'])->first()->pivot->is_correct;

                if ($isCorrect) {
                    $mark += $question_book->mark;
                } else {
                    $incorrectQuestions[] = [
                        'question' => new QuestionbookResource($question_book),
                        'incorrect_answer' => $question['answer_uuid'],
                    ];
                }

            }
            $data = [
                'incorrect_questions' => $incorrectQuestions,
            ];
            $data['mark'] = $mark;
            return $this->apiResponse($data, true,null);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }

    }
}
