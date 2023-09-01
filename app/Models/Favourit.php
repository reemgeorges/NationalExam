<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourit extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'collection_questions'
    ];

    protected $casts = [
        // 'uuid' => 'uuid',
        'user_id' => 'integer',
        'collection_questions' => 'json',
 ];


    public function User(){
        return $this->belongsTo(User::class);
    }
}
