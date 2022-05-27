@extends('layout.app')

@section('custom_scripts')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		$(".btn-delete").click(function(event){
			event.preventDefault();
			let id = $(this).data('id');
			let count = parseInt($("#count").text());
			fc = $(this).parents(".form-admin")
			deleteGoods(id,count);
		});
	});
	
	function deleteGoods(id,count) {
		$.ajax({
			url: "{{route('delete')}}",
			type: "POST",
			data: {
				id: id,
				_token: $("input[name='_token']").val()
			},
			success: function(data) {	
				fc.remove();	
				$("#count").text(count - 1);
			}
		});
	}
	</script>
@endsection

@section('body')
<h1 class="header">Панель администратора</h1>
<form method="POST" class="form-group mb-5" action="{{ route('submit') }}" enctype="multipart/form-data">
@csrf
	<label class="media-head text-justify" for="name">Название</label>
	<input type="text" class="form-control no-resize" name="name" id="name" maxlength="25" required>
	
	<label class="media-head text-justify" for="type">Тип товара</label>
	<select class="form-select form-select" id="type" name="type" aria-label=".form-select-lg example">
		<option value="1">Процессор</option>
		<option value="2">Видеокарта</option>
		<option value="3">Материнская плата</option>
		<option value="4">Оперативная память</option>
		<option value="5">Постоянная память</option>
		<option value="6">Монитор</option>
		<option value="7">Корпус</option>
		<option value="8">Периферия</option>
		<option value="9">Блок питания</option>
		<option value="10">Ноутбук</option>
	</select>
	
	<label class="media-head text-justify" for="vendor">Вендор</label>
	<input type="text" class="form-control no-resize" name="vendor" id="vendor" maxlength="50" required>
	<label class="media-head text-justify" for="cost">Цена</label>
	<input type="text" id="cost" name="cost" class="form-control input-number w-25" value="0" min="0" required>
	<label class="media-head text-justify" for="short">Характеристики</label>
	<input type="text" class="form-control no-resize" name="short" id="short" required>
	<label class="media-head text-justify" for="description">Описание</label>
	<textarea class="form-control no-resize mb-2" name="description" id="description" rows="3" required></textarea>
	
	<label class="media-head text-justify" for="img">Изображение</label>
	<input type="file" class="form-control no-resize" name="img" id="img" required>
	
	<button class="btn btn-primary mt-4" type="submit" required>Добавить</button>
</form>

<h4>Всего: <span id="count">{{ count($goods) }}</span></h4>
@foreach($goods as $good)
<form method="POST" class="form-admin flex">
	<div class="mw-1000">
		@csrf
		<span class="me-2">ID: {{$good->id}}. </span>
		<span class="me-2">{{$good->cat_name}} </span>
		<a href="{{ route('product',$good->id)}}"><span class="me-2"> {{$good->name}} </span></a>
		</div>
	<div class="jc-fe">
		<button type="button" class="btn btn-outline-primary btn-sm btn-delete" data-id="{{$good->id}}">Удалить</button>
	</div>
</form>	
@endforeach

@endsection