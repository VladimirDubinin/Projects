@extends('layout.app')

@section('custom_scripts')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		$(".btn-end").click(function(event){
			let itog = parseInt($(".itog").text());
			if (itog == 0) event.preventDefault();
		});
		
		$(".btn-delete").click(function(event){
			event.preventDefault();
			let id = $(this).data('id');
			let qty = $(this).data('qty');
			$(this).parents(".cart-form").remove();
			deleteFromCart(id,qty);
		});
	});
	
	function deleteFromCart(id,qty) {
		let total_qty = parseInt($('.cart-qty').text());
		$('.cart-qty').text(total_qty-qty);
		$.ajax({
			url: "{{route('delfromcart')}}",
			type: "POST",
			data: {
				id: id,
				_token: $("input[name='_token']").val()
			},
			success: function(data) {	
				if(data == '0,00') location.reload(); else $(".itog").text(data);	
			}
		});
	}
	</script>
@endsection

@section('body')
<h1 class="header">Корзина</h1>
<div class="goods">
@if(count($items) == 0)
	<a href="/" class="link-left mb-4" id="sel"><h4 class="fw-normal head link-h">Выбрать товары...</h4></a>
@else
	<a href="{{route('clearcart')}}" class="link-left mb-4" id="del"><h4 class="fw-normal head link-h">Очистить корзину</h4></a>
@endif
@foreach($items as $item)
	<form class="cart-form">
	@csrf
        <div class="card mb-4 rounded-3 shadow-sm">
			<div class="card-header py-3">
				<a href="{{route('product', $item->id)}}" class="link"><h4 class="my-0 fw-normal head">{{ $item->name }}</h4></a>
			</div>
			<div class="card-body">
				<div class="image">
					<img src="{{ $item->attributes->img }}" width="150" alt="Picture">
				</div>
				<span class="bl">Цена: {{ number_format($item->price,2,',',' ') }} руб.</span> 
				<span class="bl">Количество: {{ $item->quantity }} шт.</span>
				<h5 class="text-center my-3">Итого: {{ number_format($item->quantity*$item->price,2,',',' ') }} руб.</h5>
				<button type="button" class="btn btn-outline-primary w-100 btn-sm btn-delete" data-id="{{$item->id}}" data-qty="{{$item->quantity}}">Удалить из корзины</button>
			</div>
        </div>
    </form>
@endforeach
<div>
	<h4 class="fw-normal head mt-4 me-4 ms-1 i-b">Всего: <span class="itog">{{isset($_COOKIE['cart_id']) ? number_format(\Cart::getTotal(),2,',',' ') : 0}}</span> рублей</h4>
	@if(Auth::check())
		<a href="{{ route('user.cabinet') }}" class="btn btn-lg btn-primary btn-end"><h4 class="fw-normal head mb-1">Оформить заказ</h4></a>
	@else
		<a href="{{ route('user.log') }}" class="btn btn-lg btn-primary btn-sm btn-end"><h4 class="fw-normal head mb-1">Оформить заказ</h4></a>
	@endif
</div>	
</div>	
@endsection 