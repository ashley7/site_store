<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public function store(){

        return $this->belongsTo(Store::class);
        
    }

    public function item(){

        return $this->belongsTo(Item::class,'item_id');
        
    }
}
