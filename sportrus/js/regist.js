$(document).ready(function() {
	$("#formreg").submit(function(e) {
		e.preventDefault();
		var message = $("#message");
		var login = $('#login').val();
		var pass = $('#pass').val();

		if (login === '') {
			message.css("visibility", "visible");
			message.html("Введите логин!");	
		} else 
		if (login.length < 3 || login.length > 20) {
			message.css("visibility", "visible");
			message.html("Логин должен быть от 3 до 20 символов!");
		} else	
		if (pass === '') {	
			message.css("visibility", "visible");
			message.html("Введите пароль!");	
		} else
		if (pass.length < 5 || pass.length > 20) {
			message.css("visibility", "visible");
			message.html("Пароль должен быть от 5 до 20 символов!");
		} else {
			message.css("visibility", "hidden");
			message.html("");
			$.ajax({
				url: "php/reg.php",
				type: "POST",
				data: ({login,pass}),
				success: function(data) {
					if (data == 'Error') {
						message.css("visibility", "visible");
						message.html("Логин занят!");
					} 
					else if (data == 'None') {
						message.css("visibility", "visible");
						message.html("Ошибка! Сервер недоступен");	
					}
					else if (data == 'Success'){
						window.location.replace(document.referrer);
						//window.location.replace('http://sportrus/index.php');
						//message.css("visibility", "visible");
						//message.html(data);
					}
				},
				error: function() {
					message.css("visibility", "visible");
					message.html("Ошибка! Сервер недоступен");	
				}
			});
		}
		
	});
});