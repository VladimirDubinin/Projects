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
				<p>{{ $good->cost }} руб.</p>
				<button class="w-100 btn btn-lg btn-outline-primary cart-button" data-id="{{$good->id}}">В корзину</button>
			</div>
        </div>
    </form>
	@endforeach