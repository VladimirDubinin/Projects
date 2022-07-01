window.onload = function() { // выбор режима вывода матчей на странице allmatches.php
	let period = document.querySelector("#period");
	let url = new URL(window.location.href);
	let sdate = url.searchParams.get("sdate");
	let fdate = url.searchParams.get("fdate");
	if (sdate !== null && fdate !== null) { // если переданы начальная и конечная дата периода
		showDateController(); // показываются поля полей ввода периода и кнопка "Показать"
	} else { // если нет, то поля скрыты, покажутся по нажатию на "За период"
		period.addEventListener("click", showDateController);
	}
	
	let show  = document.querySelector("#show");
	show.addEventListener("click", function() { // нажатие кнопки "Показать"
		let datestart = document.querySelector("#start");
		let datefinish = document.querySelector("#finish");
		let regexp = /^[0-9]{4}[-][0-9]{2}[-][0-9]{2}$/;
		if (regexp.exec(datestart.value) !== null && regexp.exec(datefinish.value) !== null) {
			// если введённые даты корректны, показываем матчи из заданного периода, передаём данные в адресную строку
			window.location.href = "allmatches.php?sdate="+datestart.value+"&fdate="+datefinish.value;
		} // если введённые даты некорректны, нужно исправить
		else if (regexp.exec(datestart.value) === null) datestart.focus();
		else if (regexp.exec(datefinish.value) === null) datefinish.focus();
			
	});
	
	let start = document.querySelector("#start");
	let finish = document.querySelector("#finish");
	// функции инпутов дат для получения правильного интревала
	start.addEventListener("blur", function() { // начальная дата не может быть больше конечной
		if(start.value > finish.value) start.value = finish.value;
	});
	finish.addEventListener("blur", function() { // конечная дата не может быть меньше начальной
		if(start.value > finish.value) finish.value = start.value;
	});
	
	function showDateController() { // показ полей ввода периода
		period.classList.add("selected");
		document.querySelector("#date-container").style.visibility = 'visible'; 
		document.querySelector("#all").classList.remove("selected");
		document.querySelector("#all").innerHTML = '<a href="allmatches.php">За всё время</a>';
	}
}	