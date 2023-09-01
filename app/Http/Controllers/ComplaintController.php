<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComplaintResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ComplaintController extends Controller
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
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try {
            $user_id = Auth::id();
            // $request['user_id'] = $user_id;
            $request['uuid'] = Str::uuid();
            $complaint = complaint::create([
                'uuid' => $request->uuid,
                'content' => $request->content,
                'user_id'=>$user_id
            ]);
            $data['complaint'] = new ComplaintResource($complaint);

            return $this->apiResponse($data, true, 'Complaint submitted successfully', 201);


        } catch (\Exception $ex) {
            return $this->apiResponse([], false, $ex->getMessage(), 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}