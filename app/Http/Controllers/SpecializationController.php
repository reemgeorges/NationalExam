<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionexamResource;
use App\Http\Resources\SpecializationResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Collage;
use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;

class SpecializationController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function showSpecialization($collegeUuid)
    // {
    //     try {
    //         $collage = Collage::where('uuid', $collegeUuid)->first();
    //         if (!$collage) {
    //             return $this->notFoundResponse('not found collage');
    //         }

    //         $specialization = $collage->specializations()
    //             ->where('graduation', '!=', 'تخرج')
    //             ->get();
    //         if (!$specialization) {
    //             return $this->notFoundResponse('not found Specialization');
    //         }
    //         $data['specialization'] = SpecializationResource::collection($specialization);
    //         $data['message'] = 'all Specialization';
    //         return $this->apiResponse($data, true, null, 200);

    //     } catch (\Exception $ex) {
    //         return $this->apiResponse(null, false, $ex->getMessage(), 500);
    //     }

    // }


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
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function show(Specialization $specialization)
    {
        //



    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialization $specialization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialization $specialization)
    {
        //
    }
    public function last5ExamDates($uuid)
    {
        try {
            $specialization = Specialization::where('uuid', $uuid)->first();

            if (!$specialization) {
                return $this->notFoundResponse("Specialization not found");
            }

            $examDates = $specialization->QuestionexamSpecializations()
                ->orderBy('date', 'desc')
                ->take(5) // Get the last 5 exam dates
                ->pluck('date')->toArray();
            $data['examDates'] = $examDates;
            $data['specialization'] = $uuid;
            $data['message'] = 'Last 5 exam dates retrieved successfully';
            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    // public function questionsExam($uuid_specialization, $date)
    // {
    //     try {
    //         $specialization = Specialization::where('uuid', $uuid_specialization)->first();
    //         if (!$specialization) {
    //             return $this->notFoundResponse('Specialization not found');
    //         }
    //         $questions = $specialization->questionExams()->where('date', $date);
    //         $data['questions'] = QuestionexamResource::collection($questions);
    //         //   $data['questions']=$questions;
    //         $date['message'] = 'Questions retrieved successfully';
    //         return $this->apiResponse($data, true, null, 200);
    //     } catch (\Exception $ex) {
    //         return $this->apiResponse(null, false, $ex->getMessage(), 500);
    //     }
    // }

    public function questionsExam($uuid_specialization, $date)
    {
        try {
            $specialization = Specialization::where('uuid', $uuid_specialization)->first();

            if (!$specialization) {
                return $this->notFoundResponse('Specialization not found');
            }

            $questions = $specialization->QuestionexamSpecializations()
                ->where('date', $date)
                ->with('questionexam') // Eager load the associated Questionexam
                ->get();

            $data['questions'] = QuestionexamResource::collection($questions);
            $data['message'] = 'Questions retrieved successfully';

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function showSpecialization($collegeUuid)
    {
        try {
            $collage = Collage::where('uuid', $collegeUuid)->first();
            if (!$collage) {
                return $this->notFoundResponse('not found collage');
            }

            $specializations = $collage->specializations()
                ->whereNotIn('name', ['تخرج', 'ماستر'])
                ->get();
            if (!$specializations) {
                return $this->notFoundResponse('not found Specialization');
            }
            $data['specialization'] = SpecializationResource::collection($specializations);
            $data['message'] = 'all Specialization';
            return $this->apiResponse($data, true, null, 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }

    }


    public function showMasterAndGraduationSpecializations($collegeUuid)
    {
        try {
            $college = Collage::where('uuid', $collegeUuid)->first();
            if (!$college) {
                return $this->notFoundResponse('not found college');
            }

            $specializations = $college->specializations()
                ->whereIn('name', ['تخرج', 'ماستر'])
                ->get();

            if ($specializations->isEmpty()) {
                return $this->notFoundResponse('not found Specializations');
            }

            $data['specializations'] = SpecializationResource::collection($specializations);
            $data['message'] = 'Master and Graduation Specializations';

            return $this->apiResponse($data, true, null, 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function showGraduationItem($SpecializationUuid)
    {
        try {
            $Specialization = Collage::where('uuid', $SpecializationUuid)->first();

            if (!$Specialization) {
                return $this->notFoundResponse('Specialization not found.');
            }

            $items = $Specialization->items()->get();

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
}