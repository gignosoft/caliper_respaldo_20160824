<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //

    protected $table = 'cities';



    public function countries()
    {
        // |countries| -< |cities|
        return $this->belongsTo(Country::class);
    }    
    
    public function users()
    {
        // |users| >- |cities|
        return $this->$this->hasMany(User::class, 'city_id');
    }

}
