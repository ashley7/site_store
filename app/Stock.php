<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    public function item() {

        return $this->belongsTo(Item::class);
        
    }

    public function store() {

        return $this->belongsTo(Store::class);
        
    }

    public function user() {

        return $this->belongsTo(User::class);
        
    }

    public static function price($stock){

        return ($stock->quantity * $stock->unit_price);

    }
    
}
