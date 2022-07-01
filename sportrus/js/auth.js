$(document).ready( function() { // обработчик для страницы "Авторизация"
	$('#formauth').bind("submit", function(e) {  // нажатие кнопки "авторизоваться"
		e.preventDefault();
		var message = $("#message");
		var login = $("#login").val();
		var pass = $("#pass").val();
		
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
			$.ajax({ // и отправляем ajax-запрос для авторизации пользователя
				url: "php/auth.php", // в auth.php запрос к базе для проверки правильности введённых логина и пароля
				type: "POST",
				data: ({login,pass}),
				success: function(data) {
					if(data == 'None') {
						message.css("visibility", "visible");
						message.html("Нет связи с сервером!");	
					} else 
					if(data == 'Error') {
						message.css("visibility", "visible");
						message.html("Неверный логин или пароль!");	
					} else
					if(data == 'Success'){
						window.location.replace(document.referrer);  // если регистрация успешна, то возвращаемся на предыдущую страницу
					}
				},
				error: function() {
					message.css("visibility", "visible");
					message.html("Нет связи с сервером!");
				}
			});
		}
	});
});