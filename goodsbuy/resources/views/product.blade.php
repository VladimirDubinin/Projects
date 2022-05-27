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
		
		$(".quantity-left-minus").click(function(){
			let value = parseInt($("#quantity").val());
			if(value-1 > 0) $("#quantity").val(value-1); else $("#quantity").val(1);
		});
		
		$(".quantity-right-plus").click(function(){
			let value = parseInt($("#quantity").val());
			if(value+1 < 1000) $("#quantity").val(value+1); else $("#quantity").val(999);
		});
	
	});

	function addToCart(id) {
		let qty = parseInt($("#quantity").val())
		$.ajax({
			url: "{{route('addtocart')}}",
			type: "POST",
			data: {
				id: id,
				qty: qty,
				_token: $("input[name='_token']").val()
			},
			success: function() {
				let total_qty = parseInt($('.cart-qty').text());
				$('.cart-qty').text(total_qty+qty);
			}
		});
	}
	</script>
@endsection

@section('body')
<h3> {{$good->cat_name}} {{$good->name}}</h3>
<form class="container borders flex">
@csrf
	<div class="image-product" >
		<img class="shadow-image" src="../{{$good->img}}" width="400" alt="Picture">
	</div>
	<div class="main-product">	
		<h4>Характеристики: </h4>
		<p class="desc-product"><small>{{$good->short}}</small>.</p><br>
		<p class="desc-product">Производитель: <small>{{$good->vendor}}</small></p><br>
		<p class="desc-product">Отзывы: {{count($comments)}}</p><br>
		<h4>Цена: {{number_format($good->cost,2,',',' ')}} рублей</h4><br>
		<div class="col-lg-2 mb-4">
            <div class="input-group">
                <span class="input-group-btn">
					<button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
						<span class="glyphicon glyphicon-minus mt-n1">-</span>
					</button>
                </span>
                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="999">
                <span class="input-group-btn">
                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                        <span class="glyphicon glyphicon-plus mt-n1">+</span>
                    </button>
                </span>
            </div>
        </div>
		<button class="w-25 btn btn-lg btn-outline-primary minw cart-button" data-id="{{$good->id}}">В корзину</button>
	</div>
</form>	
<div class="container borders">
	<h3 class="h">Описание</h3>
	<p class="desc-product"><small>{{$good->description}}</small></p><br>
</div>	
<div class="container borders">
	<h3 class="h mb-4">Отзывы о товаре ({{count($comments)}})</h3>
	
	@if(Auth::check())
	<p class="desc-product mb-2 mt-2">Оставить отзыв</p><br>
	<form method="POST" class="form-group mb-5" action="{{ route('addcomment') }}">
		@csrf
		<input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
		<input type="hidden" id="good_id" name="good_id" value="{{$good->id}}">
		<label class="media-head text-justify" for="plus">Преимущества</label>
		<textarea class="form-control no-resize" name="plus" id="plus" rows="2" required></textarea>
		<label class="media-head text-justify" for="plus">Недостатки</label>
		<textarea class="form-control no-resize" name="minus" id="minus" rows="2" required></textarea>
		<label class="media-head text-justify" for="plus">Комментарий</label>
		<textarea class="form-control no-resize" name="comment" id="comment" rows="2" required></textarea>
		
		<button class="btn btn-primary mt-2" type="submit">Отправить</button>
	</form>
	@endif
	
	@if(count($comments) == 0)
	<p class="desc-product">Нет отзывов :(</p><br>
	@endif
	
	<div class="comments">
	@foreach($comments as $comment)
		<div class="media-body mb-5">
			<div class="media-heading">
				<div class="author">{{ $comment->name }}</div>
					<div class="metadata">
						<span class="date">{{ $comment->date }}</span>
					</div>
			</div>
			<div class="media-head text-justify">Преимущества</div>
			<div class="media-text text-justify">{{ $comment->plus }}</div>
			<div class="media-head text-justify">Недостатки</div>
			<div class="media-text text-justify">{{ $comment->minus }}</div>
			<div class="media-head text-justify">Комментарий</div>
			<div class="media-text text-justify">{{ $comment->comment }}</div>
		</div>
	@endforeach
	</div>	
@endsection