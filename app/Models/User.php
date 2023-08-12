<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'phone',
        'collage_id',
        'code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'code',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
            'uuid' => 'uuid',
            'name' => 'string',
            'phone' => 'string',
            'code' => 'string',
            'collage_id' => 'integer',
    
    ];
    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }
    public function favourit()
    {
        return $this->hasOne(Favourit::class);
    }
    public function image():MorphOne
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function complaints(){
        return $this->hasMany(Complaint::class);
    }
    public function tokens():MorphMany
    {
        return $this->morphMany(Token::class,'tokenable');
    }

}
