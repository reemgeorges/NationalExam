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

    protected $casts = [
        'uuid' => 'uuid',
        'answer_id' => 'integer',
        'question_id' => 'integer',
        'date' => 'date',
        'is_test' => 'boolean',
        'is_book' => 'boolean',
        'is_correct' => 'boolean',
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
