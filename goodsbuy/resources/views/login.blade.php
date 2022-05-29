@extends('layout.app')

@section('body')
<h1 class="header mt-5">Авторизация</h1>
<div class="form-reg text-center">
	<form class="form-signin mb-5" method="POST" action="{{ route('user.login') }}">
	@csrf
		<input type="text" id="name" name="name" class="form-control mb-4" placeholder="Введите логин" required autofocus>
		<input type="password" id="password" name="password" class="form-control mb-4" placeholder="Введите пароль" required>
		<div class="checkbox mb-3">
			<label>
			<input type="checkbox" value="remember-me" class="mb-5"> Запомнить меня
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block mb-5" type="submit">Авторизоваться</button>
		@error('formError')
		<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</form>
</div>	
@endsection