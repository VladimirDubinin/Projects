@extends('layout.app')

@section('custom_scripts')
	<script src="{{ asset('public/js/custom_script.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		$(".btn-add").click(function(event){
			event.preventDefault();
			let id = $(this).data('id');
			addToCart(id);
			let total_qty = parseInt($('.cart-qty').text());
			$('.cart-qty').text(total_qty+1);
		});
		
		$('select').on('change',function(){
			let orderby = $("#sort").val();
			let url = new URL(window.location.href);
			let min = url.searchParams.get("min");
			let max = url.searchParams.get("max");
			let vendor = url.searchParams.get("vendor");
			$.ajax({
				url: "{{route('category', $alias)}}",
				type: "GET",
				data: {
					orderby: orderby,
					min: min,
					max: max,
					vendor: vendor,
					_token: $("input[name='_token']").val()
				},
				success: function(data) {
					let posParam = location.pathname.indexOf('?');
					let url = location.pathname.substring(posParam,location.pathname.length);
					let newurl = url+'?';
					if(orderby) newurl+= 'orderby=' + orderby+'&';
					if(min) newurl+= 'min=' + min +'&';
					if(max) newurl+= 'max=' + max +'&';
					if(vendor) newurl+= 'vendor=' + vendor;
					history.pushState({},'',newurl);
					
					$(".goods").html(data);
				}
			});
		});
		
		$('#settings').on('submit',function(){
			event.preventDefault();
			let url = new URL(window.location.href);
			let orderby = url.searchParams.get("orderby");
			
			let min = $("input[name=cost]:checked").attr('data-min');
			let max = $("input[name=cost]:checked").attr('data-max');
			let vendor = $("input[name=vendor]:checked").attr('data-value');
			$.ajax({
				url: "{{route('category', $alias)}}",
				type: "GET",
				data: {
					orderby: orderby,
					min: min,
					max: max,
					vendor: vendor,
					_token: $("input[name='_token']").val()
				},
				success: function(data) {
					let posParam = location.pathname.indexOf('?');
					let url = location.pathname.substring(posParam,location.pathname.length);
					let newurl = url+'?';
					if(orderby) newurl+= 'orderby=' + orderby+'&';
					if(min) newurl+= 'min=' + min +'&';
					if(max) newurl+= 'max=' + max +'&';
					if(vendor) newurl+= 'vendor=' + vendor;
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
				toaster("Товар добавлен");
			}
		});
	}
	</script>
@endsection

@section('body')
<h1 class="header">Каталог товаров</h1>
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

<div class="d-flex p-2">
	<div class="settings">
		<form id="settings">
		@csrf
		<div id="cost" class="mb-4">
			<p class="text-center head border-bottom">Цена</p>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="default" name="cost" checked>
				<label for="default">Все</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="beforetenk" name="cost" data-min="0" data-max="10000">
				<label for="cost">0 - 10 000</label>
			</div>
			<div class="form-check">	
				<input class="form-check-input" type="radio" id="beforetfk" name="cost" data-min="10000" data-max="25000">
				<label for="beforetfk">10 000 - 25 000</label>
			</div>
			<div class="form-check">	
				<input class="form-check-input" type="radio" id="beforefk" name="cost" data-min="25000" data-max="50000">
				<label for="beforefk">25 000 - 50 000</label>
			</div>
			<div class="form-check">	
				<input class="form-check-input" type="radio" id="beforehk" name="cost" data-min="50000" data-max="100000">
				<label for="beforehk">50 000 - 100 000</label>
			</div>
			<div class="form-check">	
				<input class="form-check-input" type="radio" id="afterhk" name="cost" data-min="100000" data-max="1000000">
				<label for="afterhk">более 100 000</label>
			</div>	
		</div>
		<div id="vendor" class="mb-4">
			<p class="text-center head border-bottom">Производитель</p>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="all" name="vendor" checked>
			<label for="default">Все</label>
			</div>
			@foreach($vendors as $vendor)
			<div class="form-check">
				<input class="form-check-input" type="radio" id="{{ $vendor->vendor }}" name="vendor" data-value="{{ $vendor->vendor }}">
			<label for="{{ $vendor->vendor }}">{{ $vendor->vendor }}</label>
			</div>
			@endforeach
		</div>	
		<input type="submit" class="btn btn-sm btn-primary w-100 btn-accept" value="Применить">
		</form>
	</div>
	
	<div class="goods d-flex flex-column">
	@if(count($goods) == 0)
	<h4 class="sort-select">Товар закончился :(</h4>
	@else
		
		@foreach($goods as $good)
		<form class="goods-form-flex">
		@csrf
			<img class="image" src="/{{ $good->img }}" width="150" alt="Picture">
			<div class="goods-form-flex-body">
				<a class="link-left" href="{{route('product', $good->id)}}"><p class="my-0 fw-normal head">{{ $good->cat_name.' '.$good->name}}</p></a>
				<p class="my-1 fw-normal head">{{ $good->short}}</p>
				<p class="my-0 fw-normal head">{{ number_format($good->cost,2,',',' ') }} руб.</p>
				<button class="btn btn-sm btn-outline-primary btn-add" data-id="{{$good->id}}">В корзину</button>
			</div>
		</form>
		@endforeach
	
		@if(count($goods) != 0)
		<div class="paginator">	
		{{ $goods->links('pagination') }}	
		</div>
		@endif
	@endif
</div>
</div>		
@endsection