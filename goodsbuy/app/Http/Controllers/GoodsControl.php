<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Comments;

class GoodsControl extends Controller
{
    public function submit(Request $good) { 
		$newgood = new Goods();
		$newgood->name = $good->name;
		$newgood->type = (int)$good->type;
		$newgood->vendor = $good->vendor;
		$newgood->cost = $good->cost;
		$newgood->short = $good->short;
		$newgood->description = $good->description;
		
		$path = $good->file('img')->store('images/goods', 'public');
		$newgood->img = 'storage/app/public/'.$path;
		
		$newgood->save();
		return redirect()->route('user.adminpanel');
	}
	public function deleteGoods(Request $good) { 
		$deleted = Goods::where('id', $good->id)->delete();
		$deleted = Comments::where('good_id', $good->id)->delete();
		return redirect()->route('user.adminpanel');
	}
	
	
	public function lastProducts() {
		return view('home',['goods' => Goods::join('categories', 'type', '=', 'cat_id')->orderBy('updated_at', 'desc')->paginate(12)]);
	}
	
	/*public function allProducts() {
		return view('catalog',['goods' => Goods::all()]);
	}*/
	
	public function showCategory(Request $req, $alias, $orderby = null, $min = null, $max = null, $vendor = null) { 
		$goods = Goods::join('categories', 'type', '=', 'cat_id')->where('alias','=',"$alias");
		$vendors = Goods::select('vendor')->join('categories', 'type', '=', 'cat_id')->where('alias','=',"$alias")->groupBy('vendor')->get();
		
		if($req->vendor !== null) {
			$goods->where('vendor', $req->vendor);
		}
		
		if($req->min !== null && $req->max !== null) {
			$goods->whereBetween('cost', [$req->min,$req->max]);
		}
		
		if($req->orderby == 'price-lh') {
			$goods->orderBy('cost', 'asc');
		} else 
		if($req->orderby == 'price-hl') {
			$goods->orderBy('cost', 'desc');
		} else 
		if($req->orderby == 'alphabet') {
			$goods->orderBy('name', 'asc');
		}
		
		if($req->ajax()) {
			return view('ajax.orderby', ['goods' => $goods->paginate(10)])->render();
		}
		return view('category', ['goods' => $goods->paginate(10),'alias' => $alias, 'vendors' => $vendors]);
	}
	
	public function oneProduct($id) {
		return view('product',[
			'good' => Goods::join('categories', 'type', '=', 'cat_id')->find($id),
			'comments' => Comments::join('users', 'user_id', '=', 'id')->where('good_id',$id)->get()
		]);
	}
	
	public function searchProducts(Request $q) {
		if($q['query']=='') {
			return back();
		}
		return view('search',['goods' => Goods::join('categories', 'type', '=', 'cat_id')->where('name','like','%'.$q['query'].'%')->get()]);
	}
}
