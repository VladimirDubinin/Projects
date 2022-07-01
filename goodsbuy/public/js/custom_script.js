function toaster(msg) { // Всплывающие сообщения (при добавлении товара в корзину)
	let container;
	if(document.querySelector(".toastr-container") === null) {
		container = document.createElement('div'); // создаём контейнер, в который будут добавляться сообщения
		container.className = "toastr-container";
		document.body.append(container);
		container = document.querySelector(".toastr-container");
	} else {
		container = document.querySelector(".toastr-container");
	}

	let toast = document.createElement('div'); // создаём элемент с введённым сообщением
	toast.classList.add("toastr","appear")
	toast.innerHTML = "<p class='toastr-msg'>"+msg+"</p>";
	toast.innerHTML += "<span class='exit' id='x'>&#10006;</span>";
	container.append(toast);
	let exit = toast.querySelector("#x");
	exit.addEventListener("click", function() { // кнопка удаления сообщения
		exit.parentNode.remove();
		console.log("msg")
	});
	setTimeout(function(){ // автоматическое удаление сообщения через 2 секунды
		toast.remove();
		if (document.querySelectorAll(".toastr").length === 0) { // и контейнера, если сообщений больше нет
			document.querySelector(".toastr-container").remove();
		}
	}, 2000);
}