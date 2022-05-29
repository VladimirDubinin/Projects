@extends('layout.app')

@section('custom_scripts')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		$(".cart-button").click(function(event){
			event.preventDefault();
			let id = $(this).data('id');
			addToCart(id);
		});
		
		$('select').on('change',function(){
			var orderby = $("#sort").val();
			$.ajax({
				url: "{{route('category', $alias)}}",
				type: "GET",
				data: {
					orderby: orderby,
					_token: $("input[name='_token']").val()
				},
				success: function(data) {
					let posParam = location.pathname.indexOf('?');
					let url = location.pathname.substring(posParam,location.pathname.length);
					let newurl = url+'?';
					newurl+= 'orderby=' + orderby;
					history.pushState({},'',newurl);
					
					$(".goods").html(data);
				}
			});
		});
	});

	function addToCart(id) {
		$.ajax({
			url: "{{route('addtocart')}}",
			type: "POST",
			data: {
				id: id,
				qty: 1,
				_token: $("input[name='_token']").val()
			},
			success: function() {
				let total_qty = parseInt($('.cart-qty').text());
				$('.cart-qty').text(total_qty+1);
			}
		});
	}
	</script>
@endsection

@section('body')
<h1 class="header">Каталог товаров</h1>
@if(count($goods) == 0)
	<h4 class="sort-select">Товар закончился :(</h4>
@else
<form class="sort-select">
	<p class="i-b">Сортировка:</p>
	@csrf
	<select class="i-b" id="sort">
		<option value="default" selected>по умолчанию</option>
		<option value="price-lh">сначала недорогие</option>
		<option value="price-hl">сначала дорогие</option>
		<option value="alphabet">по наименованию</option>
	</select>
</form>
@endif

<div class="goods">
	@foreach($goods as $good)
	<form class="goods-form">
	@csrf
        <div class="card mb-4 rounded-3 shadow-sm">
			<div class="card-header py-3">
				<a href="{{route('product', $good->id)}}" class="link"><h4 class="my-0 fw-normal head">{{ $good->name }}</h4></a>
			</div>
			<div class="card-body">
				<div class="image">
					<img src="/{{ $good->img }}" width="150" alt="Picture">
				</div>
				<p>{{ $good->cat_name }}</p>
				<p class="desc">{{ $good->short }}</p>
				<p>{{ number_format($good->cost,2,',',' ') }} руб.</p>
				<button class="w-100 btn btn-lg btn-outline-primary cart-button" data-id="{{$good->id}}">В корзину</button>
			</div>
        </div>
    </form>
	@endforeach
	
	@if(count($goods) != 0)
	<div class="paginator">	
	{{ $goods->links('pagination') }}	
	</div>
	@endif
</div>	
@endsection