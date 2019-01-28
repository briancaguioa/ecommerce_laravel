<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Order;
use App\Category;
use Auth;
use Session;


class ItemController extends Controller
{
    public function showItems() {
    	$categories = Category::all();
    	$items = Item::all();
    	return view("items.catalog", compact(['categories', 'items'])); 
    }

     public function itemDetails($id) {
    	// $items = Item::where('id',$item_id)->first();
    	$item = Item::find($id);

    	return view("items.item_details", compact("item")); 
    }

     public function showAddItemForm(){
     	$categories = Category::all();
    	return view("items.add_items", compact("categories"));
    }

     public function saveItems(Request $request){
     	// dd($request);
		$rules = array(
		"name"=> "required",
		"description"=> "required",
		"price"=> "required|numeric",
		"image"=> "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
	    );

		$this->validate($request, $rules);

		$item = new Item;
     	$item->name = $request->name;
     	$item->description = $request->description;
     	$item->price = $request->price;
     	$item->category_id = $request->category;

     	$image = $request->file('image');
     	$image_name = time().".". $image->getClientOriginalExtension();
     	$destination = "images/";
     	$image->move($destination, $image_name);

     	$item->image_path = $destination.$image_name;
     	$item->save();
     	Session::flash("success_message", "Item added successfully");
     	return redirect('/catalog');
    }

     public function deleteItem($id, Request $request) {
        $item = Item::find($id);
        $item->delete();

        Session::flash("success_message", "Task Successfuly deleted");

        return redirect('/catalog'); 
    }

     public function showEditForm($id) {
        $item = Item::find($id); 
        $categories = Category::all();
        return view('/items.edit_form', compact('item', 'categories')); 
    }

    public function editItem($id, Request $request) {
        $item = Item::find($id);
        $rules = array(
        "name"=> "required",
        "description"=> "required",
        "price"=> "required|numeric",
        "image"=> "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        );

        $this->validate($request, $rules);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->category_id = $request->category;

        if($request->file('image')!=null) { //if i uploaded an image
            $image=$request->file('image');
            $image_name=time().".".$image->getClientOriginalExtension();
            $destination="images/";
            $image->move($destination, $image_name);
            $item->image_path=$destination.$image_name;
        }

        $item->save();
        Session::flash("success_message","Item Edited successfully");
        return redirect('/catalog');

    }

    public function addToCart($id, Request $request) {
        //if there is an existing cart, get it. if none, initialize it
        if(Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = [];
        }

        //if item in cart already has quantity, add to it. if none, assign to quantity
        if(isset($cart[$id])) {
            $cart[$id] += $request->quantity;
        } else {
            $cart[$id] = $request->quantity;
        }

        //put the cart in a session
        Session::put('cart', $cart); //this is the traditional session

        // dd(Session::get('cart'));
        $item = Item::find($id);
        Session::flash("success_cart", "$request->quantity of $item->name has been successfully added to your cart");
        
        // return redirect("/catalog");
        // return array_sum(Session::get('menu'));
         return redirect('/catalog');

    }


    public function showCart() {
        $item_cart = [];
        if(Session::has('cart')) {
            $cart = Session::get('cart');
            $total = 0;
            foreach($cart as $id=>$quantity) {
                $item = Item::find($id);

                $item->quantity=$quantity;
                $item->subtotal = $item->price * $quantity;

                $total += $item->subtotal;
                $item_cart[] = $item;
                // we push $item array (array pushing)
            }
            // dd($item);
        }
        return view('items.cart_content', compact('item_cart', 'total'));
    }

    public function deleteCart($id) {
        // var_dump($id);+
        // we want to remove the specific id in the session 'cart'
        Session::forget("cart.$id"); //this is the same as cart('$id')
        return redirect('/menu/mycart');
    }

    public function clearCart() {
        Session::forget("cart");
        return redirect("/menu/mycart");
    }

    public function updateCart($id, Request $request) {
        $cart = Session::get('cart');
        $cart[$id] = $request->new_qty;
        Session::put('cart', $cart);
        return redirect("/menu/mycart");
    }

    public function checkout() {
        $order = new Order;
        //we need to make sure that the user thats trying to check out is logged in. else we would encounter an error with Auth::user
        $order->user_id = Auth::user()->id;
        $order->total=0;
        $order->status_id=1; //all orders should have a default status pending
        //creat a new order
        $order->save();



        //link items to the order 
        $total=0;
        foreach(Session::get('cart') as $item_id => $quantity) {
            // dd(Session::get('cart'));


            //items()->attach() is a function that allows us to insert the irem to the item_order table for that specific order_id along with any other columns that we want to include, in this case the quantity

            $order->items()->attach($item_id, ['quantity'=>$quantity]);
            //syntax attach(yung other fk,[other columns we want to includ in the associative array])

            //update order total
            $item = Item::find($item_id);
            $total += $item->price * $quantity;
        }

        //save the total to the current order
        $order->total = $total;
        $order->save();

        //remove the surrent session cart and return to catalog
        Session::forget('cart');
        //return redirect("/catalog");
    }

    public function showOrders() {
        //SELLECT * FROM orders WHERE user_id = the of the surrent user
        //->get(), runs the get query


        $orders=Order::where("orders.user_id", Auth::user()->id)->get();
        // $item_order = Item_Order::all();
        return view("items.order_details", compact("orders")); 
    }

    public function restoreItem($id) {
        $item = Item::withTrashed()->find($id);
        //we need to use withTreashed to include "soft-deleted" item in the query
        $item->restore();
        return redirect("/catalog");
    }
}