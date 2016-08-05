<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class StateAsset extends Model
{
    //
    protected $table = 'state_assets';



    public function assets()
    {
        // | state_assets | >-< | assets |
// pendiente        return $this->belongsToMany(Asse,'state_id','asset_id');
    }
}
