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
@endif

<script>
	$(".btn-add").click(function(event){
		event.preventDefault();
		let id = $(this).data('id');
		addToCart(id);
		let total_qty = parseInt($('.cart-qty').text());
		$('.cart-qty').text(total_qty+1);
	});
</script>

@if(count($goods) != 0)
	<div class="paginator">	
	{{ $goods->links('pagination') }}	
	</div>
@endif	