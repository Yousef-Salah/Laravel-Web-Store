<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user Has only one profile.
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')
                    ->withDefault();
    }

    // hasOne(string $related, string|null $foreignKey = null, string|null $localKey = null)
    
    public function cartProducts()
    {
        return $this->belongsToMany(
            Product::class,
            'carts',
            'user_id',
            'product_id',
            'id',
            'id'
        );
    }
}
