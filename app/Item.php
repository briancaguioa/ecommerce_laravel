<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function category() {
    	return $this->belongsTo("App\Category"); //belongsTo is single
    }

    public function orders() {
    	return $this->belongsToMany("\App\Order");
    }
}
