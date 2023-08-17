<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'text_questions',
        'item_id',
        'mark',
        'link'
    ];

    protected $casts = [
        'id' => 'integer', // Assuming 'id' is an integer
        // 'uuid' => 'uuid', // Assuming 'uuid' is a UUID
        'text_questions' => 'string', // Assuming 'text_questions' is a string
        'item_id' => 'integer', // Assuming 'item_id' is an integer
        'mark' => 'double', // Assuming 'mark' is a double
        'link' => 'string', // Assuming 'link' is a string
    ];


    public function item(){
        return $this->belongsTo(Question::class);
    }





// public function answersQuestions()
// {
//     return $this->hasMany(answer_question::class); // Change to the correct pivot model name
// }

// public function answers()
// {
//     return $this->belongsToMany(Answer::class, 'answer_question')
//         ->using(AnswerQuestion::class) // Make sure the class name is in CamelCase
//         ->withPivot('is_correct', 'is_test', 'is_book'); // Add other pivot columns here
// }

public function answerQuestions()
{
    return $this->hasMany(answer_question::class);
}
}
