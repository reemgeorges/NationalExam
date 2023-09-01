<?php

namespace App\Http\Controllers;

use App\Http\Resources\Answer_QuestionResource;
use App\Http\Resources\CollageCollection;
use App\Http\Resources\CollageResource;
use App\Http\Resources\examResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\QuestionbookResource;
use App\Http\Resources\QuestionResource;
use App\Http\traits\GeneralTrait;
use App\Models\Answer;
use App\Models\Collage;
use App\Models\Questionbook;
use App\Models\Questionexam;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollageController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $collages = Collage::all();
            $data['collages'] = CollageResource::collection($collages);
            $data['message'] = 'all collage';
            return $this->apiResponse($data, true, null, 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
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
     * @param  \App\Models\Collage  $collage
     * @return \Illuminate\Http\Response
     */
    public function show($collageUuid)
    {
        try {
            // Find the collage based on the UUID
            $collage = Collage::where('uuid', $collageUuid)->first();

            if (!$collage) {
                return $this->notFoundResponse('Collage not found.');
            }

            $items = $collage->items()->get();

            if ($items->isEmpty()) {
                return $this->notFoundResponse('Items not found.');
            }

            $data['items'] = ItemResource::collection($items);
            $data['message'] = 'Items retrieved successfully';

            return $this->apiResponse($data, true, null, 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collage  $collage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collage $collage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collage  $collage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collage $collage)
    {
        //
    }
    // public function showQuestionByCollage($collageUuid)
    // {
    //     try {
    //         // Find the collage based on the UUID
    //         $collage = Collage::where('uuid', $collageUuid)->first();

    //         if (!$collage) {
    //             return $this->notFoundResponse('Collage not found.');
    //         }

    //         $questions = $collage->questions;

    //         if ($questions->isEmpty()) {
    //             return $this->notFoundResponse('Questions not found.');
    //         }

    //         $data['collage'] = $collage->name;
    //         $data['questions'] = Answer_QuestionResource::collection($questions);

    //         return $this->apiResponse($data, true, 'Questions retrieved successfully', 200);

    //     } catch (\Exception $ex) {
    //         return $this->apiResponse(null, false, $ex->getMessage(), 500);
    //     }
    // }
    public function showeng()
    {
        try {
            $eng = Collage::where('type', 'هندسة')->get();
            if (!$eng) {
                return $this->notFoundResponse('no found eng collage');
            }

            $data['eng-collage'] = CollageResource::collection($eng);
            $data['message'] = 'done show collage eng';
            return $this->apiResponse($data, true, null, 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);

        }
    }
    public function showmedical()
    {
        try {
            $medical = Collage::where('type', 'طبية')->get();
            if (!$medical) {
                return $this->notFoundResponse('no found medical collage');
            }

            $data['medical-collage'] = CollageResource::collection($medical);
            $data['message'] = 'done show collage medical';
            return $this->apiResponse($data, true, null, 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);

        }

    }
    public function questionsBookByCollage($uuid)
    {
        try {
            $collage = Collage::where('uuid', $uuid)->first();
            if (!$collage) {
                return $this->notFoundResponse("Collage not found");
            }
            $books = $collage->books()->get();
            if (!$books) {
                return $this->notFoundResponse("There are no questions for this college");
            }
            $data['Questions_book'] = QuestionbookResource::collection($books);
            $data['message'] = 'Book questions for this college';
            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }


    public function questionBank($uuid)
    {
        try {
            $collage = Collage::where('uuid', $uuid)->first();
            if (!$collage) {
                return $this->notFoundResponse("collage not found");
            }
            $all = new Collection();
            $books = $collage->books()->get();
            if (!$books) {
                return $this->notFoundResponse("questions book not found");
            } else {
                // $all = $all->concat($books);
                $books_collection = QuestionbookResource::collection($books);
            }
            $exams = $collage->exams()->get();
            if (!$exams) {
                return $this->notFoundResponse("questions exam not found");
            } else {
                // $all = $all->concat($exams);
                $exam_collection = examResource::collection($exams);
            }
            $all = $all->concat($books_collection);
            $all = $all->concat($exam_collection);

            if ($all->isEmpty()) {
                return $this->notFoundResponse("There are no questions for this college");
            }
            $all = collect($all)->unique('text_questions')->values();
            $all = $all->random(3);
            $data['all'] = $all;
            $data['message'] = 'question bank for this college';
            return $this->apiResponse($data, true, "Questions retrieved successfully");
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
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

            foreach ($request->input('questions') as $questionData) {
                $questionUuid = $questionData['question_uuid'];
                $answerUuid = $questionData['answer_uuid'];

                // البحث عن السؤال في موديل Questionbook
                $question = Questionbook::where('uuid', $questionUuid)->first();


                if ($question) {
                    $answer = Answer::where('uuid', $answerUuid)->firstOrFail();

                    // التحقق من صحة الإجابة باستخدام العمود is_correct في الجدول الرابط
                    $isCorrect = $question->answers()
                        ->where('uuid', $answerUuid)
                        ->wherePivot('is_correct', 1) // افحص عمود is_correct
                        ->exists();

                    if ($isCorrect) {
                        $mark += $question->mark;

                    } else {
                        // الجواب خاطئ، إضافة السؤال والجواب الخاطئ إلى المصفوفة
                        $uncorrect[] = [
                            'question' => new QuestionbookResource($question),
                            'incorrect_answer_uuid' => $answerUuid,
                        ];
                    }
                } else {
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
                            'question' => new examResource($questionExam),
                            'incorrect_answer_uuid' => $answerUuid,
                        ];
                    }
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
