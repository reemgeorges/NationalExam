<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'answer_text', 'is_correct'];
    protected $casts = [
        // 'uuid' => 'string',
        'text_answer' => 'string'
    ];


    public function Questionbooks()
    {
        return $this->belongsToMany(Questionbook::class, 'answer_questionbook');
    }


    public function QuestionexamSpecializations()
    {
        return $this->belongsToMany(QuestionexamSpecialization::class, 'a_q_specialization');
    }
}
