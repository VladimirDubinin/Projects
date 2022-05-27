//console.log('Hi');
$(document).ready(function() {
	$(".cart-button").click(function(){
		addToCart();
	});
});

function addToCart() {
	$.ajax({
		url: "{{route('addtocart')}}",
		type: "POST",
		data: {
			id: 'Здарова'
		},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(data) {
			console.log('hi');
		}
	});
}