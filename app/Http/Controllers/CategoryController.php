<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function findItems($id) {
    	$category = Category::find($id);
    	$items = $category->items; //this enables us to select all items for that category

    	// dd($category);

    	return view('items.catalog', compact('items'));
  		
    }
}