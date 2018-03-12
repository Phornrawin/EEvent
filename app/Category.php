<?php

namespace EEvent;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Category extends Eloquent
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function event()
    {
        return $this->hasMany('EEvent\Event');
    }


}
