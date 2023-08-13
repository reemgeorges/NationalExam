<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Models\Collage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthControllerUser
{
    use GeneralTrait;



    /**
 * Register a new user.
 *
 * @param Request $request
 * @return \Illuminate\Http\Response
 */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'phone' => 'required|min:10',
            'collage_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {
            $collageUuid = $request->input('collage_id');
            $collage = Collage::where('uuid', $collageUuid)->first();

            if (!$collage) {
                return $this->notFoundResponse('Collage not found');
            }

            $uuid = Str::uuid();

            $user = User::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'collage_id' => $collage->id,
                'uuid' => $uuid,
            ]);

            $data['user'] = new UserResource($user);

            return $this->apiResponse($data, true, 'User is registered successfully', 201);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    /**
     * Login api
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    /**
 * Login user.
 *
 * @param Request $request
 * @return \Illuminate\Http\Response
 */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {
            $user = User::where('name', $request->input('name'))
            ->where('code', $request->input('code'))
            ->first();
            if(!$user) {
                return $this->apiResponse(null, false, 'name or code not corrected', 400);
            }

            $token = $user->createToken('apiToken')->plainTextToken;

            $data['user'] = new UserResource($user);
            $data['token'] = $token;

            return $this->apiResponse($data, true, 'User logged in successfully', 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }

    /**
 * Logout user.
 *
 * @param Request $request
 * @return \Illuminate\Http\Response
 */
    public function logout(Request $request)
    {
        try {
            $user = auth()->user();

            if ($user) {
                $user->tokens()->delete();
            }

            return $this->apiResponse([], true, 'User has logged out successfully', 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
}
