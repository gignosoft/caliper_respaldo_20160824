<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $table = 'positions';

    public function levels()
    {
        return $this->hasMany(Level::class, 'level_id');
    }
}
