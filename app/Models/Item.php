<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'collage_id'
    ];

    protected $casts = [
        'id' => 'integer',
        // Assuming 'id' is an integer
        // 'uuid' => 'uuid', // Assuming 'uuid' is a UUID
        'name' => 'string',
        // Assuming 'name' is a string
        'collage_id' => 'integer', // Assuming 'collage_id' is an integer
    ];

    public function Collage()
    {
        return $this->belongsTo(Collage::class);
    }
    public function questionsbook()
    {
        return $this->hasMany(Questionbook::class);
    }
    public function questionsexam()
    {
        return $this->hasMany(Questionexam::class);
    }
}