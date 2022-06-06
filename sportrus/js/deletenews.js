$(document).ready(function() {
	$("#del").bind("click", function(e) {
		e.preventDefault();
		let fc = $(this).parents("#form-comment");
		let id = $("#news-id").val();
		if (id !== '') {
			$.ajax({
				url: "php/newsdelete.php",
				type: "POST",
				data: ({id}),
				success: function(data) {
					if(data == 'Error') {
						console.log('Ошибка удаления');
					} else
					if(data == 'Success'){
						fc.remove();
					}
				},
				error: function() {
					console.log('Ошибка удаления');
				}
			});	
		} 
	});
});