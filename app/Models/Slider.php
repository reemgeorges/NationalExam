<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'link'
    ];

    protected $casts=[
        'uuid' => 'uuid',
        'link' => 'string',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
