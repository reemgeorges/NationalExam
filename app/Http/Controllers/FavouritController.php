<?php

namespace App\Http\Controllers;

use App\Http\Resources\examResource;
use App\Http\Resources\FavouritResource;
use App\Http\Resources\QuestionbookResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Favourit;
use App\Models\Questionbook;
use App\Models\Questionexam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FavouritController extends Controller
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
        // افحص الطلب وقم بالتحقق من البيانات المرسلة
        $validator = Validator::make($request->all(), [
            'questions' => ['required', 'array'],
            // 'questions.*.question_uuid' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        $user = auth()->user();

        try {
            $favourit = Favourit::where('user_id', $user->id)->first();
            $currentQuestions = [];

            if ($favourit) {
                $currentQuestions = json_decode($favourit->collection_questions, true) ?? []; // Initialize as an empty array if null
            }

            // Extract UUIDs from the existing questions
            $existingUUIDs = array_column($currentQuestions, 'question_uuid');

            // Loop through the new questions and add them to the collection if their UUIDs do not already exist
            $newQuestions = $request->input('questions');
            foreach ($newQuestions as $newQuestion) {
                $questionUuid = $newQuestion['question_uuid'];
                if (!in_array($questionUuid, $existingUUIDs)) {
                    $currentQuestions[] = $newQuestion;
                }
            }

            if (!$favourit) {
                $uuid = Str::uuid();

                $newFavourit = new Favourit();
                $newFavourit->uuid = $uuid;
                $newFavourit->user_id = $user->id;
                $favourit = $newFavourit;
            }

            $favourit->collection_questions = json_encode($currentQuestions);
            $favourit->save();
            $data['favourit'] = new FavouritResource($favourit);
            $data['message'] = 'Questions added to Favourit successfully';
            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favourit  $favourit
     * @return \Illuminate\Http\Response
     */
    public function showFavourit(Request $request)
    {
        try {
            $user = auth()->user();
            $favourit = Favourit::where('user_id', $user->id)->first();

            if (!$favourit) {
                return $this->requiredField('Favourit not found');
            }

            $questions = json_decode($favourit->collection_questions, true);

            if (is_null($questions)) {
                return $this->apiResponse([], true, 'Favourit is empty', 200);
            }

            $questionResources = [];

            foreach ($questions as $questionUuid) {
                // ابحث عن السؤال في موديل الكتاب
                $bookQuestion = Questionbook::where('uuid', $questionUuid)->first();

                if ($bookQuestion) {
                    $questionResources[] = new QuestionbookResource($bookQuestion);
                } else {
                    // إذا لم يكن موجودًا في الكتاب، ابحث في موديل الامتحان
                    $examQuestion = Questionexam::where('uuid', $questionUuid)->first();

                    if ($examQuestion) {
                        $questionResources[] = new examResource($examQuestion);
                    }
                }
            }

            $data['question'] = $questionResources;
            $data['message'] = 'Favourit retrieved successfully';

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favourit  $favourit
     * @return \Illuminate\Http\Response
     */
    public function removeUuidFromFavourit(Request $request)
    {
        try {
            $user = auth()->user();
            $favourit = Favourit::where('user_id', $user->id)->first();

            if (!$favourit) {
                return $this->requiredField('Favourit not found');
            }

            $questions = json_decode($favourit->collection_questions);

            if (empty($questions)) {
                return $this->apiResponse([], true, 'Favourit is empty', 200);
            }

            $uuidToRemove = $request->input('uuid_to_remove');

            // استخدم array_filter لإزالة ال UUID المطلوب من المصفوفة
            $filteredQuestions = array_filter($questions, function ($questionUuid) use ($uuidToRemove) {
                return $questionUuid !== $uuidToRemove;
            });

            // قم بتحديث مصفوفة الأسئلة في الفوفوريت
            $favourit->collection_questions = json_encode(array_values($filteredQuestions)); // قد تحتاج إلى استخدام `array_values` لإعادة ترتيب المفاتيح
            $favourit->save();

            return $this->apiResponse(null, true, 'UUID removed from Favourit successfully', 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favourit  $favourit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favourit $favourit)
    {
        //
    }
}