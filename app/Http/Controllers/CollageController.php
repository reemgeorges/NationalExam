<?php

namespace App\Http\Controllers;

use App\Http\Resources\Answer_QuestionResource;
use App\Http\Resources\CollageCollection;
use App\Http\Resources\CollageResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\QuestionResource;
use App\Http\traits\GeneralTrait;
use App\Models\Collage;
use Illuminate\Http\Request;

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
            return $this->apiResponse($data, true, 'all collage', 200);

        } catch(\Exception $ex) {
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

            $data = ItemResource::collection($items);

            return $this->apiResponse($data, true, 'Items retrieved successfully', 200);

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




    public function showQuestionByCollage($collageUuid)
    {
        try {
            // Find the collage based on the UUID
            $collage = Collage::where('uuid', $collageUuid)->first();

            if (!$collage) {
                return $this->notFoundResponse('Collage not found.');
            }

            $questions = $collage->questions;

            if ($questions->isEmpty()) {
                return $this->notFoundResponse('Questions not found.');
            }

            $data['collage'] = $collage->name;
            $data['questions'] = Answer_QuestionResource::collection($questions);

            return $this->apiResponse($data, true, 'Questions retrieved successfully', 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }



}
