<?php

namespace EEvent;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Profile extends Eloquent
{
    public $incrementing = false;
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    protected $fillable = [
        'user_id', 'age', 'tel-phone'
    ];

    public function user()
    {
        return $this->belongsTo('EEvent\User');
    }
}
