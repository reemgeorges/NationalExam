<?php

namespace App\Http\Controllers;

use App\Http\Resources\examResource;
use App\Http\Resources\QuestionbookCollection;
use App\Http\Traits\GeneralTrait;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionbookResource;

use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\QuestionexamResource;
class ItemController extends Controller
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
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
    public function questionsBookByItem($uuid)
    {
        try {
            $item = Item::where('uuid', $uuid)->first();
            if(!$item)
                return $this->notFoundResponse("Item not found");
            $books = $item->questionsbook()->get();
            if (!$books)
                return $this->notFoundResponse("There are no questions for this item");
            $data['Questions_book'] = QuestionbookResource::collection($books);
            $data['message'] = 'Book questions for this item';
            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }

    public function questionsExamByItem($uuid)
    {
        try {
            $item = Item::where('uuid', $uuid)->first();
            if (!$item) {
                return $this->notFoundResponse("Item not found");
            }

            $exams = $item->questionsexam()->get();

            if ($exams->isEmpty()) {
                return $this->notFoundResponse("Questions exam not found");
            }

            // Load QuestionexamSpecializations for each exam
            // $exams->load('QuestionexamSpecializations');

            $uniqueExams = $exams->unique('text_questions');

            // Include QuestionexamSpecialization data in the response
            $data['exams_item'] = examResource::collection($uniqueExams);
            $data['message'] = 'Question bank for this item';

            return $this->apiResponse($data, true, "Questions retrieved successfully");
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }



}
