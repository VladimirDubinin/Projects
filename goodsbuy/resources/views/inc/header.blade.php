@section('header')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">GoodsBuy</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav me-auto mb-2 mb-md-0">
			<li class="nav-item">
			<a class="nav-link @yield('home')" aria-current="page" href="/">Главная</a>
			</li>
			<form>
			@csrf
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Каталог</a>
				<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'processor')}}">Процессоры</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'videocard')}}">Видеокарты</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'motherboard')}}">Материнские платы</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'ram')}}">Оперативная память</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'memory')}}">Постоянная память</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'monitor')}}">Мониторы</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'case')}}">Корпуса</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'periphery')}}">Периферия</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'power')}}">Блоки питания</a></li>
					<li><a class="dropdown-item" href="{{ route('category', $alias = 'laptop')}}">Ноутбуки</a></li>
				</ul>
			</li>
			</form>
			@if(!Request::is('login') && !Request::is('registration') && !Request::is('adminpanel'))
			<li class="nav-item">
				<a class="btn ms-4 btn-light" href="{{route('cart')}}">Корзина: <span class="cart-qty">{{isset($_COOKIE['cart_id']) ? \Cart::session($_COOKIE['cart_id'])->getTotalQuantity() : 0}}</span></a>
			</li>
			@endif
		</ul>		
		<form class="d-flex me-5" method="GET" action="{{route('search')}}">			
			<input class="form-control me-2" id="query" name="query" type="search" placeholder="Введите запрос..." aria-label="Search">
			<button class="btn btn-light" type="submit">Поиск</button>
		</form>
		@if(Auth::check())
			<div class="d-flex">
				<ul class="navbar-nav me-2 mb-md-0">
					<a href="{{ route('user.cabinet') }}" class="nav-link active">{{Auth::user()->name}}</a>
				</ul>	
				<a href="{{ route('user.logout') }}"><button class="btn btn-primary me-2" type="submit">Выйти</button></a>
			</div>
		@else
			<div class="d-flex">
				<a href="{{ route('user.log') }}"><button class="btn btn-primary me-2" type="submit">Войти</button></a>
				<a href="{{ route('user.reg') }}"><button class="btn btn-primary" type="submit">Регистрация</button></a>
			</div>
		@endif
    </div>
  </div>
</nav>