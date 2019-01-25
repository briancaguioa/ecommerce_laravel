<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function status() {
    	return $this->belongsTo("App\Status");
    }

    function items() {
    	return $this->belongsToMany("\App\Item")->withPivot("quantity")->withTimeStamps();
    	//return $this->belongsToMnay("items", tablename_of_where they meet)
    }

    //belongsToMany links it(the order) to the nitems table via then item_order table (alphabetical order naming)
    //this is the reason why naming convension is important specially in frameworks
    //if you did't follow the naming convention, we need to state the tablename later
    //withPivot contains All columns that are not foreign keys and are not ids and timestamps in the pivot table
    //if you have more that one column for pivot, comma separate them.->("column1","column2")
    //withTimestamps_.automatically populate the timestamps as soon as an entry for the item_order table is created
}
