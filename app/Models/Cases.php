<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'makes_id',
        'model_id',
        'mileage',
        'buying_date',
        'color_id',
        'picture',
        'drive_options',
        'full_fill'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'buying_date' => 'datetime',
    ];
    public function setBuyingDateAttribute( $value ) {
        $this->attributes['buying_date'] = Carbon::parse($value);
    }
    public function getPictureAttribute() {
      return 'storage/user_image/'.$this->attributes['picture'] ;
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function maker(){
        return $this->belongsTo('App\Makes','makes_id','id');
    }
    public function model(){
        return $this->belongsTo('App\CarModel');
    }
    public function color(){
        return $this->belongsTo('App\Color');
    }
}
