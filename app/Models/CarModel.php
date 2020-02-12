<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table='models';
    protected $fillable=[
      'makes_id',
      'name',
      'drive_options'
    ];

    protected $casts = [
        'drive_options' => 'array',
    ];
    public function maker(){
        return $this->belongsTo('App\Makes');
    }
    public function cases(){
        return $this->hasMany('App\Cases');
    }

}
