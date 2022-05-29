@extends('layout.app')

@section('body')
<h1 class="header">Личный кабинет</h1>
<div class="user-img"><img width="125" alt="Avatar" height="125" src="{{ Auth::user()->avatar }}"></div>
<div class="user-text">
	<p class="i-b">Добро пожаловать, {{Auth::user()->name}}!</p><br>
	<p class="i-b">Почта: {{Auth::user()->email}}</p>
</div>	

@if(Auth::user()->name == 'admin')
<a href="{{ route('user.adminpanel') }}" class="btn btn-lg btn-primary btn-end"><h4 class="fw-normal head mb-1">Панель администратора</h4></a>
@endif

@endsection