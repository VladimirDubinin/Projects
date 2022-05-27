<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use Darryldecode\Cart\Cart;

class CartControl extends Controller
{
	public function cartClear() {
		if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());		
		$cart_id = $_COOKIE['cart_id'];
		\Cart::session($cart_id)->clear();
		//return redirect(route('/'));
		return view('cart',['items' => \Cart::getContent()]);
	}
	
    public function index() {
		if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());		
		$cart_id = $_COOKIE['cart_id'];
		\Cart::session($cart_id);
		return view('cart',['items' => \Cart::getContent()]);
	}
	public function addToCart(Request $req) {
		$product = Goods::where('id', $req->id)->first();
		//return response()->json(['id' => $req->id, 'name' => $req->login]);
		if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());		
		$cart_id = $_COOKIE['cart_id'];
		\Cart::session($cart_id);
		
		\Cart::add([
			'id' => $product->id,
			'name' => $product->name,
			'price' => $product->cost,
			'quantity' => (int)$req->qty,
			'attributes' => [
				'img' => $product->img
			]	
		]);
		//return \Cart::getContent();
	}
	public function delFromCart(Request $req) {
		$product = Goods::where('id', $req->id)->first();
		//return response()->json(['id' => $req->id, 'name' => $req->login]);
		if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());		
		$cart_id = $_COOKIE['cart_id'];
		\Cart::session($cart_id)->remove($product->id);
		return number_format(\Cart::getTotal(),2,',',' ');
	}
}
