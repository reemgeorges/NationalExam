<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerQuestionSpecialization extends Model
{
    use HasFactory;
    protected $fillable=['is_correct','answer_id','questionexam_specialization_id'];
    protected $table='a_q_specialization';
}
