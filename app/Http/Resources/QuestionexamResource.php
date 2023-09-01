<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionexamResource extends JsonResource
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
            'uuid' => $this->questionexam->uuid,
            'text_questions' => $this->questionexam->text_questions,
            'item_id' => $this->questionexam->item_id,
            'mark' => $this->questionexam->mark,
            'link' => $this->questionexam->link,
            'answers'=>AnswerexamResource::collection($this->answers),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
