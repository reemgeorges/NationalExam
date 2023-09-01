<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\traits\FileUploader;
use App\Http\traits\GeneralTrait;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use GeneralTrait;
    use FileUploader;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,gif,bmp,tiff|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {
            $uuid = Str::uuid();
            $user = Auth::user();
            $url = $this->uploadImagePrivate($request, $user, 'profile');

           if(!$user->image){
            $user->image()->save(new Image(['uuid'=>$uuid,'url' =>  $url]));
           }

            $data = [
                'user' => new UserResource($user),
                'url' => env('APP_STORAGE_URL') . $url,
            ];

            return $this->apiResponse($data, true, 'Image saved successfully', 200);
        } catch (\Exception $ex) {
            return $this->apiResponse([], false, $ex->getMessage(), 500);
        }
    }



public function showprofile()
    {
        try{
            $user=Auth::user();
            if(!$user){
                return $this->unAuthorizeResponse();
            }
            $data['user']=new UserResource($user);
            $data['message']='show user is login';
            return $this->apiResponse($data,true,null,200);

        }catch(\Exception $ex){
            return $this->apiResponse(null,false,$ex->getMessage(),500);

        }
    }


public function updateuser(Request $request)
{
    try {
        $user = Auth::user();

        // تحقق من صحة البيانات باستخدام validate()
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|unique:users,phone,' . $user->id,
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, false, $validator->errors()->first(), 400);
        }

        // قم بتحديث المستخدم مباشرة
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $data['user'] = new UserResource($user);
        $data['message'] = 'Profile updated successfully';

        return $this->apiResponse($data, true, null, 200);

    } catch (\Exception $ex) {
        return $this->apiResponse(null, false, $ex->getMessage(), 500);
    }
}


}
