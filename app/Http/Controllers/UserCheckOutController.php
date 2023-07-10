<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class UserCheckOutController extends Controller
{
    public function show(Request $request){
        if($request->item){
            $rowidOrder = $request->item;
            //dd($rowidOrder);
            $cartTotal = 0;
            foreach($rowidOrder as $item){
                $itemOrder = Cart::get($item);
                Session::push('item_order',$itemOrder);
                $listItem[] = Cart::get($item);
                $price = $itemOrder->price;
                $qty = $itemOrder->qty;
                $cartTotal += $price*$qty;
            }
            //dd($cartTotal);
            //$itemOrder = collect($listItem);
            //session
            //$test = Session::push("cart.products", ['id' => 2, 'item' => 1]);
            //Session::push('item_order',$listItem);
            Session::push('cartTotal',$cartTotal);
            
            //$request->session->put('item_order',$itemOrder);
            //return Session::all();
            //$request->session()->flush('item_order');
            //$list_item_order = Session::get('item_order');
            //$value = $request->session()->get('item_order');
            //dd(Session::get('item_order'));
            //dd(Session::all());
            //dd(Session::get('item_order'));
            // foreach(Session::get('item_order') as $item){
            //     print_r($item->name);
            // }

        }
        
        //dd($itemOrder);
        return view('user.checkout.checkout',compact('itemOrder','cartTotal'));
    }
    public function delete(Request $request){
        return $request->session()->flush('item_order');
        //dd(Session::all());
        return $request->session()->flush();
    }
    public function index(){
        dd(Session::all());
    }
}
