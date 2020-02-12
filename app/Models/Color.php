<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name'
    ];
    public function cases(){
        return $this->hasMany('App\Cases');
    }
}
