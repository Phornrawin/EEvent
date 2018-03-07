<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function attendees()
    {
        return $this->hasMany('EEvent\Attendee');
    }

    public function organizer()
    {
        return $this->hasOne('EEvent\Organizer');
    }
}
