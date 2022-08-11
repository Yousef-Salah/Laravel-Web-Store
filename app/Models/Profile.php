<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * Set table primary key name
     * @var string
     */
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'gender', 'birthday',
        'address', 'city', 'country_code', 'locale', 'timezone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
                    ->withDefault(); // if there is no relation that returns empty model
    }

    // belongsTo(string $related, string|null $foreignKey = null, string|null $ownerKey = null, string|null $relation = null)

}
