<?php

namespace App\Http\Traits;

trait GeneralTrait
{

    public function apiResponse($data=null, bool $status = true, $error=null, $statusCode = 200)
    {
        $array=[
            'data' =>$data,
            'status' => $status ,
            'error' => $error,
            'statusCode' => $statusCode
        ];
        return response($array);

    }

    public function unAuthorizeResponse()
    {
        return $this->apiResponse(null,0,'Unauthorize', 401);
    }

    public function notFoundResponse($more)
    {
        return $this->apiResponse(null, 1, $more, 404);
    }

    public function requiredField($message)
    {
        // return $this->apiResponse(null, false, $message, 200);
        return $this->apiResponse(null, false, $message, 400);
    }

    public function apiValidation($request, $array)
    {

        foreach($array as $field) {
            if(!$request->has($field)) {
                return [false ,'field' , $field, 'is required'];
            }

            if($request[$field]==null) {
                return [false ,'field' , $field, 'can not to empty'];
            }
        }
        return [true , 'No error'];
    }



}
