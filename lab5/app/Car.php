<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    public $table = "cars";
    protected $fillable = array('make','model','produced_on');

    public function review(){
        return $this->hasMany(Review::class);
    }
}
