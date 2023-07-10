<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class UserCartController extends Controller
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function show(Request $request)
    {
        if ($request->session()->has('item_order')) {
            $request->session()->pull('item_order');
        }
        if ($request->session()->has('cartTotal')) {
            $request->session()->pull('cartTotal');
        }
        //dd(Cart::content());
        return view('user.cart.cart');
    }
    public function add($id)
    {
        $product = $this->product->find($id);
        //dd($product);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->sale_price,
            'options' => [
                'thumbnail' => $product->feature_image_path,
                'inventory_number' => $product->quantity,
            ]
        ]);
        //dd(Cart::content());
        return redirect()->route('cart.index');
    }
    public function update(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
        $productCart = Cart::get($request->rowId);
        $subTotal = $productCart->price * $productCart->qty;
        $subTotal = number_format($subTotal, 0, ',', '.');
        $cartTotal = number_format(Cart::subtotal(0, '', ''), 0, 0, '.');
        return json_encode([
            'code' => 200,
            'num' => Cart::count(),
            'subTotal' => $subTotal,
            'total' => $cartTotal,
            'message' => 'Success'
        ]);
        //dd($subTotal);
        // foreach($data as $key=>$value){
        //     Cart::update($key,$value);
        // }
        // if($request->id && $request->quantity){
        //     $cart = session()->get('cart');
        //     $cart[$request->id]["quantity"] = $request->quantity;
        //     session()->put('cart', $cart);
        //     session()->flash('success', 'Cart updated successfully');
        // }
        //return redirect()->route('cart.index');
    }
    public function ajax(Request $request)
    {
        // $data = $request->all();
        // dd($data);
    }
    public function delete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart.index');
    }
    public function destroy()
    {
        Cart::destroy();
        return redirect()->route('cart.index');
    }
}
