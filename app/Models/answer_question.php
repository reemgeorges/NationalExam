<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer_question extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'answer_id',
        'question_id',
        'is_test',
        'is_book',
        'is_currect',
    ];
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}