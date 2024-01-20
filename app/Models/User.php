<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $name
 * @property string $email
 * @property bool $admin
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasPermissions;

    protected $attributes = [
        'active' => true,
        'admin' => false,
    ];

    protected $fillable = [
        'name', 'id','email', 'avatar',
        'active', 'admin',
        'password',
    ];
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'avatar' => 'string',
        'active' => 'boolean',
        'admin' => 'boolean',
        'password' => 'string',
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
