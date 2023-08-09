<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'text_answer',
    ];
    public function answersQuestions()
    {
        return $this->hasMany(answer_question::class);
    }
}