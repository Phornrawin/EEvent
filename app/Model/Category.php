<?php

namespace EEvent;

use Eloquent;

class Category extends Eloquent
{
    public $timestamps = false;
    protected $fillable = ['name', 'color'];

    public function events()
    {
        return $this->hasMany('EEvent\Event');
    }


}
