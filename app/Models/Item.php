<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable=[
        'uuid',
        'name',
        'collage_id'
    ];
    public function Collage(){
        return $this->belongsTo(Collage::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
