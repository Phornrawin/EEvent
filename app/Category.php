<?php

namespace EEvent;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function event()
    {
        return $this->hasMany('EEvent\Event');
    }
}
