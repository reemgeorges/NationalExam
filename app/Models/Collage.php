<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Collage extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name'
    ];
    public function users(){
        return $this->hasMany(User::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function image():MorphOne
    {
        return $this->morphOne(Image::class,'imageable');
    }
}