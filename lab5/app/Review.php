<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public function cars(){
        return $this->belongsTo(Car::class);
    }
}
