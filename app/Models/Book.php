<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;
    protected $fillable =['uuid', 'collage_id'];

    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
