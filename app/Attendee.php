<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    public function user()
    {
        return $this->belongsTo('EEvent\User');
    }

    public function payment()
    {
        return $this->hasOne('EEvent\Payment');
    }
}
