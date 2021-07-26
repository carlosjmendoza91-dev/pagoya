<?php

namespace App\Models;

use App\Events\UserCreatingEvent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'full_name', 'document', 'email', 'password', 'phone', 'balance', 'type'
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'phone' => '',
        'balance' => 0.00
    ];

    protected $dispatchesEvents = [
        'creating' => UserCreatingEvent::class
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
