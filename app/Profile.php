<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'age', 'tel-phone', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('EEvent\User');
    }
}
