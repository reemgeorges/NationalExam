<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable=[
        'uuid',
        'user_id',
        'content'];

        protected $casts = [
            // 'uuid' => 'uuid',
            'content' => 'string',
            'user_id' => 'integer',
        ];

        public function user(){
            return $this->belongsTo(User::class);
        }
}
