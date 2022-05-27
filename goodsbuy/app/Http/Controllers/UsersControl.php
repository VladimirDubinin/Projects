<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Goods;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersControl extends Controller
{
    public function regist(Request $req) {
		if(Auth::check()) {
			return redirect(route('user.cabinet'));
		}
		
		$validateF = $req->validate([
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required'
		]);
		$validateF['password'] = Hash::make($validateF['password']);
		
		if(User::where('name',$validateF['name'])->exists()) {
			return redirect(route('user.reg'))->withErrors([
				'formError' => 'Логин занят'
			]);
		}
		
		$user = User::create($validateF);
		if($user) {
			Auth::login($user);
			return redirect('/');
		}
		return redirect(route('user.reg'))->withErrors([
			'formError' => 'Произошла ошибка при регистрации пользователя'
		]);
	}
	
	public function auth(Request $req) {
		
		if(Auth::check()) {
			return redirect(route('user.cabinet'));
		}
		
		if(Auth::attempt($req->only(['name','password']))) {
			return redirect('/');
		}
		
		return redirect(route('user.log'))->withErrors([
			'formError' => 'Неверный логин или пароль'
		]);
	}
	
	public function adminPan() {
		if(Auth::user()->name == 'admin') {
			return view('adminpanel',['goods' => Goods::join('categories', 'type', '=', 'cat_id')->orderby('id','desc')->get()]);
		} 
		else return redirect('/');
	}
}
