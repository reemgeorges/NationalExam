<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionexam extends Model
{
    use HasFactory;
    protected $table='questionexams';

    protected $fillable = [
        'uuid',
        'text_questions',
        'item_id',
        'mark',
        'link',

    ];

    protected $casts = [
        'id' => 'integer', // Assuming 'id' is an integer
        // 'uuid' => 'string', // Assuming 'uuid' is a UUID
        'text_questions' => 'string', // Assuming 'text_questions' is a string
        'item_id' => 'integer', // Assuming 'item_id' is an integer
        'mark' => 'double', // Assuming 'mark' is a double
        'link' => 'string', // Assuming 'link' is a string

    ];

    protected $fillablePivot = [
        'date', // Specify fillable for the pivot table field 'date'
    ];

    public function item(){
        return $this->belongsTo(Question::class);
    }

    public function QuestionexamSpecializations()
    {
        return $this->hasMany(QuestionexamSpecialization::class);
    }

}

