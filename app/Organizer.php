<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    public function user()
    {
        return $this->belongsTo('EEvent\User');
    }
}
