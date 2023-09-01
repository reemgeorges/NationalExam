<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionbook extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'text_questions',
        'item_id',
        'mark',
        'link',
        'is_correct',

    ];

    protected $casts = [
        'id' => 'integer', // Assuming 'id' is an integer
        // 'uuid' => 'string', // Assuming 'uuid' is a UUID
        'text_questions' => 'string', // Assuming 'text_questions' is a string
        'item_id' => 'integer', // Assuming 'item_id' is an integer
        'mark' => 'double', // Assuming 'mark' is a double
        'link' => 'string', // Assuming 'link' is a string

    ];

    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function collage(){
        return $this->belongsTo(Collage::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class)
        ->withPivot('is_correct'); // Retrieve 4 random answers

    }
}

