<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';

    // | activities | -< | companies |
    public function activities()
    {
        return $this->belongsTo('activities', 'activity_id');
    }

}
