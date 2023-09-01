<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class examResource extends JsonResource
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
        'item_id' => $this->item_id,
        'mark' => $this->mark,
        'link' => $this->link,
        'answers' => AnswerexamResource::collection($this->gatherAnswers()),
    ];
}

protected function gatherAnswers()
{
    $answers = collect();

    foreach ($this->QuestionexamSpecializations as $specialization) {
        $answers = $answers->merge($specialization->answers);
    }

    return $answers;
}
    }

