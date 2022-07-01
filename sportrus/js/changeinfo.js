$(document).ready(function() { // Для смены информации о пользователе на странице usercabinet.php
	$("#send-info").bind("click", function(e) { // Обработчик нажатия кнопки "Изменить информацию"
		e.preventDefault();
		var id = $("#userid").val();
		var surn = $("#srname").val();
		var name = $("#name").val();
		var lastn = $("#lastname").val();
		var about = $("#about").val();
		// Меняем информацию с помощью ajax-запроса
		$.ajax({
			url: "php/info.php",
			type: "POST",
			data: ({id,surn,name,lastn,about}),
			success: function(data) {
				if (data == 'Success'){
					alert("Изменения сохранены!");
					location.reload();
				}
			},
			error: function() {

			}
		});	
 
	});
});