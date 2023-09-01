<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerBook extends Model
{
    use HasFactory;
    protected $fillable=['is_correct','answer_id','questionbook_id'];
    protected $table='answer_questionbook';
}
