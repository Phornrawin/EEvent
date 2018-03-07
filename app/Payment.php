<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function attendee()
    {
        return $this->belongsTo('EEvent\Attendee');
    }
}
