<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $casts=[
        'name' => 'string'
    ];

    protected $fillablePivot = [
        'date', // Specify fillable for the pivot table field 'date'
    ];

 

    public function collage(){
        return $this->belongsTo(Collage::class);
    }

    public function items(){
        return $this->hasManyThrough(Item::class,Collage::class);
    }

    public function QuestionexamSpecializations()
    {
        return $this->hasMany(QuestionexamSpecialization::class);
    }

}
