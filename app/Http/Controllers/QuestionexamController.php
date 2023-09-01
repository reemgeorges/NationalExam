<?php

namespace App\Http\Controllers;

use App\Http\Resources\examResource;
use App\Http\Resources\QuestionexamResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Answer;
use App\Models\Questionexam;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionexamController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questionexam  $questionexam
     * @return \Illuminate\Http\Response
     */
    public function show(Questionexam $questionexam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionexam  $questionexam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionexam $questionexam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questionexam  $questionexam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionexam $questionexam)
    {
        //
    }




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
            $uncorrect = [];

            // استعراض الأسئلة والإجابات المرسلة
            foreach ($request->input('questions') as $questionData) {
                $questionUuid = $questionData['question_uuid'];
                $answerUuid = $questionData['answer_uuid'];

                // استعراض السؤال المرسل
                $questionExam = Questionexam::where('uuid', $questionUuid)->firstOrFail();

                // استعراض الإجابة المرسلة
                $answer = Answer::where('uuid', $answerUuid)->firstOrFail();

                // التحقق من صحة الإجابة باستخدام العلاقات
                $isCorrect = $answer->QuestionexamSpecializations()
                    ->where('questionexam_id', $questionExam->id)
                    ->wherePivot('is_correct', 1)
                    ->exists();
                    // dd($isCorrect);


                if ($isCorrect) {
                    $mark += $questionExam->mark;
                } else {
                    // الجواب خاطئ، إضافة السؤال والجواب الخاطئ إلى المصفوفة
                    $uncorrect[] = [
                        'question' => new ExamResource($questionExam),
                        'incorrect_answer_uuid' => $answerUuid,
                    ];
                }
            }

            $data['unCorrect'] = $uncorrect;
            $data['mark'] = $mark;

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }



}
