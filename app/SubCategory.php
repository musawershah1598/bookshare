<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function books(){
        return $this->hasMany("App\Book");
    }
    public function genre(){
        return $this->belongsTo('App\Genre');
    }
}
