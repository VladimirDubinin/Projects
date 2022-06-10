window.onload = function() {
	showSlider(); //функция для работы слайдера
	
	document.querySelector("#btnSub").addEventListener("click", function() {  //функция открытия модального окна по кномке "Записаться на приём"
		document.querySelector(".pop-up").classList.remove('hidden')
	});
	document.querySelector("#closeModal").addEventListener("click", function() { //функция закрытия модального окна по кномке "Закрыть"
		document.querySelector(".pop-up").classList.add('hidden');
	});
}

function showSlider() {
	let slide = document.querySelectorAll(".slide"); //выбираем все слайды
	let prev = document.querySelector("#prev"); //кнопка предыдущего слайда
	let next = document.querySelector("#next"); //кнопка следующего слайда
	let current = document.querySelector("#current-number"); //номер текущего слайда
	
	slide[0].classList.remove('hidden'); //показываем первый слайд по умолчанию
	current.innerHTML = 1;
	
	let i = 0;
	prev.addEventListener("click", function() { //обработчик кнопки предыдущего слайда
		slide[i].classList.add('hidden'); //скрываем текущий слайд
		if (i - 1 < 0) i = slide.length - 1; else i -= 1; //если текущий слайд первый, переходим на последний
		slide[i].classList.remove('hidden'); //показываем новый слайд
		current.innerHTML = i + 1;
	});
	next.addEventListener("click", function() { //обработчик кнопки следующего слайда
		slide[i].classList.add('hidden'); //скрываем текущий слайд
		if (i + 1 >= slide.length) i = 0; else i += 1; //если текущий слайд последний, переходим на первый
		slide[i].classList.remove('hidden');  //показываем новый слайд
		current.innerHTML = i + 1;
	});
}