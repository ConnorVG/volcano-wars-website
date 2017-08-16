<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * Set the user's name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $name = preg_replace('/[^\w\d\-\_\.\s]/', '', $name);
        $name = str_replace('  ', ' ', $name);

        $this->attributes['name'] = $name;
    }
}
