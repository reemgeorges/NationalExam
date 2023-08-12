<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Token extends Model
{
    use HasFactory;

    protected $fillable =['uuid','token_name'];

    protected $casts = [
        'uuid' => 'uuid',
        'token_name' => 'string',
    ];

    public function tokenable():MorphTo
    {
        return $this->morphTo();
    }
}
