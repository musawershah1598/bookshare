<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function genre(){
        return $this->belongsTo("App\Genre");
    }

    public function subcategory(){
        return $this->belongsTo("App\SubCategory");
    }

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function reviews(){
        return $this->hasMany("App\Review");
    }

    public function bookmarks(){
        return $this->hasMany("App\Bookmarks");
    }
}
