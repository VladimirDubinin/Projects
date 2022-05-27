@extends('layout.app')

@section('body')
<h1 class="header mt-5">Регистрация</h1>
<div class="form-reg text-center">
	<form class="form-signin mb-5" method="POST" action="{{ route('user.regist') }}">
	@csrf
		<input type="text" id="name" name="name" class="form-control mb-4" placeholder="Введите логин" required autofocus>
		<input type="text" id="email" name="email" class="form-control mb-4" placeholder="Введите email" required>
		<input type="password" id="password" name="password" class="form-control mb-5" placeholder="Введите пароль" required>
		
		<button class="btn btn-lg btn-primary btn-block mb-5" type="submit">Зарегистрироваться</button>
		@error('formError')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</form>
</div>	
@endsection