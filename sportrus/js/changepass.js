$(document).ready(function() { // Для смены пароля на странице usercabinet.php
	$("#send-pass").bind("click", function(e) {  // Обработчик нажатия кнопки "Изменить пароль"
		e.preventDefault();
		var id = $("#userid").val();
		var oldpass = $("#oldpass").val();
		var newpass1 = $("#newpass1").val();
		var newpass2 = $("#newpass2").val();
		// Если введённые данные корректны, меняем пароль с помощью ajax-запроса
		if ((newpass1 == newpass2) && (newpass1 != oldpass)) { 
			$.ajax({
				url: "php/pass.php",
				type: "POST",
				data: ({id,oldpass,newpass1}),
				success: function(data) {
					if (data == 'Success'){
						alert("Изменения сохранены!");
						location.reload();
					} else {
						alert(data);
					}
				},
				error: function() {

				}
			});
		} else alert("Пароли не совпадают!");	
 
	});
});