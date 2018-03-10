<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'event_id', 'user_id', 'status', 'payment_time'
    ];

    public function attendee()
    {
        return $this->belongsTo('EEvent\Attendee');
    }
}
