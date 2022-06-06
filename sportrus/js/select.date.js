window.onload = function() {
	let period = document.querySelector("#period");
	let url = new URL(window.location.href);
	let sdate = url.searchParams.get("sdate");
	let fdate = url.searchParams.get("fdate");
	if (sdate !== null && fdate !== null) {
		showDateController();
	} else { 
		period.addEventListener("click", showDateController);
	}
	
	let show  = document.querySelector("#show");
	show.addEventListener("click", function() {
		let datestart = document.querySelector("#start");
		let datefinish = document.querySelector("#finish");
		let regexp = /^[0-9]{4}[-][0-9]{2}[-][0-9]{2}$/;
		if (regexp.exec(datestart.value) !== null && regexp.exec(datefinish.value) !== null) {
			window.location.href = "allmatches.php?sdate="+datestart.value+"&fdate="+datefinish.value;
		} 
		else if (regexp.exec(datestart.value) === null) datestart.focus();
		else if (regexp.exec(datefinish.value) === null) datefinish.focus();
			
	});
	
	let start = document.querySelector("#start");
	let finish = document.querySelector("#finish");
	start.addEventListener("blur", function() {
		if(start.value > finish.value) start.value = finish.value;
	});
	finish.addEventListener("blur", function() {
		let today = new Date();
		console.log(today);
		if(finish.value > today) finish.value = today;
	});
	
	function showDateController() {
		period.classList.add("selected");
		document.querySelector("#date-container").style.visibility = 'visible'; 
		document.querySelector("#all").classList.remove("selected");
		document.querySelector("#all").innerHTML = '<a href="allmatches.php">За всё время</a>';
	}
}	