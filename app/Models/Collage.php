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
        'name',
        'type'
    ];

    protected $casts = [
        // 'uuid' => 'uuid',
        'name' => 'string',
        'type'=>'string'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
    // public function books()
    // {
    //     return $this->hasManyThrough(Item::class, Questionbook::class);
    // }
    public function books()
    {
        return $this->hasManyThrough(Questionbook::class,Item::class);
    }
    public function exams(){
        return $this->hasManyThrough(Questionexam::class,Item::class);
    }
}
