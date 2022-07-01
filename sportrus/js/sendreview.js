$(document).ready(function() { // Отправка отзыва на странице forum.php
	$("#send").bind("click", function(e) {
		e.preventDefault();
		var id = $("#userid").val();
		var theme = $("#theme").val();
		var comm = $("#comm").val();
		// ajax-запрос
		if ((comm !== '') && (theme !== '')) {
			$.ajax({
				url: "php/review.php", // добавляем в базу 
				type: "POST",
				data: ({id,theme,comm}),
				success: function(data) {
					if(data == 'Error') {
						
					} else
					if(data == 'Success'){
						$("#theme").val('');
						$("#comm").val('');
						location.reload();
					}
				},
				error: function() {

				}
			});	
		} 
	});
});