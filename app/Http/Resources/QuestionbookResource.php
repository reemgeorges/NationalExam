<?php

namespace App\Http\Resources;

use App\Models\Answer;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionbookResource extends JsonResource
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
            'text_questions' => $this->text_questions,
            'mark' => $this->mark,
            'link' => $this->link,
            'answers'=>AnswerBookResource::collection($this->answers),


        ];
    }
}
