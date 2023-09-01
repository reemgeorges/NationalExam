<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouritResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'uuid' => $this->uuid,
            'user_name' => $this->user->name,
            'questions' => json_decode($this->questions, true), // تحويل المصفوفة
        ];
    }
}
