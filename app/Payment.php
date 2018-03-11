<?php

namespace EEvent;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Payment extends Eloquent
{
    protected $fillable = [
        'event_id', 'user_id', 'status', 'payment_time'
    ];

    public function attendee()
    {
        return $this->belongsTo('EEvent\Attendee');
    }
}
