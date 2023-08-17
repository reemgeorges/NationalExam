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

    protected $casts = [
        // 'uuid' => 'uuid',
        'name' => 'string', // Cast 'name' column to a string
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

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Item::class);
    }
}
