@extends('layout.app')

@section('custom_scripts')
	<script src="{{ asset('public/js/custom_script.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
	$(document).ready(function() {    // нажатие кнопки "В корзину"
		$(".cart-button").click(function(event){
			event.preventDefault();
			let id = $(this).data('id');
			addToCart(id);
			let total_qty = parseInt($('.cart-qty').text());
			$('.cart-qty').text(total_qty+1);  // + товар в корзине в шапке
		});
	});

	function addToCart(id) { // функция добавить товар из корзину
		$.ajax({
			url: "{{route('addtocart')}}",
			type: "POST",
			data: {
				id: id,
				qty: 1,
				_token: $("input[name='_token']").val()
			},
			success: function() {
				toaster("Товар добавлен");   // показываем всплывающее сообщение
			}
		});
	}
	</script>
@endsection

@section('body')
<h1 class="header">Результаты поиска</h1>
<div class="main-goods">
@if(count($goods) == 0)
	<h4 class="fw-normal head link-left my-5 link-h">Ничего не найдено :(</h4>
@else
	<h4 class="fw-normal head link-left mb-4 link-h">Найдено: {{ count($goods) }}</h4>
@endif
@foreach($goods as $good)
	<form class="goods-form">
	@csrf
        <div class="card mb-4 rounded-3 shadow-sm">
			<div class="card-header py-3">
				<a href="{{route('product', $good->id)}}" class="link"><h4 class="my-0 fw-normal head">{{ $good->name }}</h4></a>
			</div>
			<div class="card-body">
				<div class="image">
					<img src="{{ $good->img }}" width="150" alt="Picture">
				</div>
				<p><a class="link" href="{{ route('category', $alias = $good->alias) }}">{{ $good->cat_name  }}</a></p>
				<p class="desc">{{ $good->short }}</p>
				<p>{{ number_format($good->cost,2,',',' ') }} руб.</p>
				<button class="w-100 btn btn-sm btn-outline-primary cart-button" data-id="{{$good->id}}">В корзину</button>
			</div>
        </div>
    </form>
@endforeach
</div>	
@endsection