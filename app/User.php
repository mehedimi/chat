<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'password', 'remember_token',
    ];

    protected $appends = ['avater_url'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getAvaterUrlAttribute()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . '/?s=70&d=mm';
    }
}
