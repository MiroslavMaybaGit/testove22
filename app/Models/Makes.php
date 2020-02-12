<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makes extends Model
{
    protected $fillable = [
        'name'
    ];

    public function model(){
        return $this->hasMany('App\CarModel');
    }
    public function cases(){
        return $this->hasMany('App\Cases','makes_id','id');
    }
}
