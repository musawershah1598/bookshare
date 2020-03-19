<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable =  ['name','description','no_of_books'];
    public function books(){
        return $this->hasMany("App\Book");
    }
}
