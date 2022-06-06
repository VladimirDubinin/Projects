$(document).ready(function() {
	$("#del").bind("click", function(e) {
		e.preventDefault();
		let id = $("#com-id").val();
		let fc = $(this).parents("#form-comment");
		if (id !== '') {
			$.ajax({
				url: "php/commdelete.php",
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