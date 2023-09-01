<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionexamSpecialization extends Model
{
    use HasFactory;
    protected $table='questionexam_specialization';

    protected $fillable=['questionexam_id','date','specialization_id'];

    protected $casts=[
        'questionexam_id' =>'integer',
        'date'=> 'date',
        'specialization_id'=>'integer'

    ];

    public function questionexam(){
  return $this->belongsTo(Questionexam::class);
    }

    public function specialization(){
        return $this->belongsTo(Specialization::class);
          }

          public function answers()
          {
              return $this->belongsToMany(Answer::class,'a_q_specialization')
                  ->withPivot('is_correct');

          }


}
