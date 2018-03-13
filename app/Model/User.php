<?php

namespace EEvent;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('EEvent\Profile');
    }

    public function attendEvent()
    {
        return $this->belongsToMany('EEvent\Event', 'attendees');

    }

    public function organizedEvent()
    {
        return $this->hasMany('EEvent\Event', 'organizer_id');
    }

}