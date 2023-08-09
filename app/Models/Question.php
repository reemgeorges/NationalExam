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
    public function item(){
        return $this->belongsTo(Question::class);
    }
    public function answersQuestions(){
        return $this->hasMany(answer_question::class);
    }
}