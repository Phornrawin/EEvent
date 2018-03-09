<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $fillable = [
        'event_id', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('EEvent\User');
    }
}
