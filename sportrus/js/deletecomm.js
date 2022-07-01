$(document).ready(function() { // удаление комменариев на странице viewing.php
	$("#del").bind("click", function(e) { // обработчик нажатия на крестик
		e.preventDefault(); 
		let id = $("#com-id").val();
		let fc = $(this).parents("#form-comment");
		if (id !== '') { // удаляем комментарий ajax-запросом
			$.ajax({
				url: "php/commdelete.php", // удаление из БД
				type: "POST",
				data: ({id}),
				success: function(data) {
					if(data == 'Error') {
						console.log('Ошибка удаления');
					} else
					if(data == 'Success'){
						fc.remove(); // удаление со страницы, есил из БД удалено успешно
					}
				},
				error: function() {
					console.log('Ошибка удаления');
				}
			});	
		} 
	});
});