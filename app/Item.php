<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function stocks(){

        return $this->hasMany(Stock::class);

    }

    public function issues(){

        return $this->hasMany(Issue::class);

    }

    

    public function controls($item_id,$transaction_type){

        return Issue::where('item_id',$item_id)->where('transaction_type',$transaction_type)->sum('quantity');

    }
}
