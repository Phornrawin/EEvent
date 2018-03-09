<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('EEvent\User');
    }

    public function payment()
    {
        return $this->hasOne('EEvent\Payment');
    }

    public function event()
    {
        return $this->belongsTo('event');
    }
}
