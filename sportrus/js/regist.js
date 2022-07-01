$(document).ready(function() { // обработчик для страницы "Регистрация"
	$("#formreg").submit(function(e) { // нажатие кнопки "зарегистрироваться"
		e.preventDefault();
		var message = $("#message");
		var login = $('#login').val();
		var pass = $('#pass').val();

		var errors = []; // валидация логина и пароля
		if (login === '') errors.push("Введите логин!");	
		else if (login.length < 3 || login.length > 20) 
			errors.push("Логин должен быть от 3 до 20 символов!");
		if (pass === '') errors.push("Введите пароль!");	
		else if (pass.length < 5 || pass.length > 20) 
			errors.push("Пароль должен быть от 5 до 20 символов!");

		if (errors.length > 0) { // вывод ошибок на экран в элемент message
			message.html("");
			message.css("visibility", "visible");
			for(let i = 0; i < errors.length; i++) {
				message.append("<li>"+errors[i]+"</li>");
			} 
		} else { // если ошибок нет, скрываем message
			message.css("visibility", "hidden");
			message.html("");
			$.ajax({  // и отправляем ajax-запрос для регистрации пользователя
				url: "php/reg.php", // в reg.php запрос к базе для отправки в базу введённых логина и пароля
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
						window.location.replace(document.referrer); // если регистрация успешна, то возвращаемся на предыдущую страницу
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