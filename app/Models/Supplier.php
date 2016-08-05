<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'suppliers';



    // |suppliers| >-< |currencies|
    public function currencies()
    {
        return $this->belongsToMany('currencies', 'currency_suppliers', 'supplier_id', 'currency_id');
    }
}
