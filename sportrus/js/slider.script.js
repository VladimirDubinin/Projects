window.onload = function() { // //функция для слайдеров на главной странице
	let sliders = document.querySelectorAll('.slider'); // выбираем все слайдеры на странице
	for(let i = 0; i < sliders.length; i++) {
		showSlides(sliders[i]); //функция для работы каждого слайдера
	}
	function showSlides(slider) {
		let prev = slider.querySelector(".prev"); //кнопка следующего слайда
		let next = slider.querySelector(".next"); //кнопка следующего слайда
		let slide = slider.querySelectorAll(".slide"); //выбираем все слайды
		let dots = slider.querySelectorAll(".dot"); //кнопки выбора слайда

		slide[0].classList.add('block'); //показываем первый слайд по умолчанию
		dots[0].classList.add('active');
		let i = 0;
		prev.addEventListener("click", function() { //обработчик кнопки предыдущего слайда
			slide[i].classList.remove('block'); //скрываем текущий слайд
			dots[i].classList.remove('active');
			if (i - 1 < 0)  i = slide.length - 1; else i -= 1;  //если текущий слайд первый, переходим на последний
			slide[i].classList.add('block');  //показываем новый слайд
			dots[i].classList.add('active');
		});
		next.addEventListener("click", function() { //обработчик кнопки следующего слайда
			slide[i].classList.remove('block'); //скрываем текущий слайд
			dots[i].classList.remove('active');
			if (i + 1 > slide.length - 1) i = 0; else i += 1; //если текущий слайд последний, переходим на первый
			slide[i].classList.add('block');  //показываем новый слайд
			dots[i].classList.add('active');
		});
		dots.forEach(function(dot) {
			dot.addEventListener("click", function() { // обработчик кнопки выбора слайда
				slide[i].classList.remove('block'); //скрываем текущий слайд
				dots[i].classList.remove('active');
				i = parseInt(this.getAttribute("data-num")); // номер выбранного слайда
				slide[i].classList.add('block');  //показываем новый слайд
				dots[i].classList.add('active');
			});
		});
	}
}