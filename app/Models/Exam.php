<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid' , 'collage_id' , 'question_id' , 'date'
    ];

    public function questions(){
        return $this->belongsToMany(Question::class);

    }

    public function collage(){
        return $this->belongsTo(Collage::class);
    }
}
