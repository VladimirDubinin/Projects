window.onload = function() {
	let sliders = document.querySelectorAll('.slider');
	for(let i = 0; i < sliders.length; i++) {
		showSlides(sliders[i]);
	}
	
	function showSlides(slider) {
		let prev = slider.querySelector(".prev");
		let next = slider.querySelector(".next");
		let slide = slider.querySelectorAll(".slide");
		let dots = slider.querySelectorAll(".dot");
		slide[0].classList.add('block');
		dots[0].classList.add('active');
		
		let i = 0;
		prev.addEventListener("click", function() {
			slide[i].classList.remove('block');
			dots[i].classList.remove('active');
			if (i - 1 < 0)  i = slide.length - 1; else i -= 1;
			slide[i].classList.add('block');
			dots[i].classList.add('active');
		});
		next.addEventListener("click", function() {
			slide[i].classList.remove('block');
			dots[i].classList.remove('active');
			console.log('if ('+i+' + 1 >='+slide.length+') '+i+' = 0; else '+i+' += 1');
			if (i + 1 > slide.length - 1) i = 0; else i += 1;
			slide[i].classList.add('block');
			dots[i].classList.add('active');
		});
		
		for(let j = 0; j < dots.length; j++) {
			dots[j].addEventListener("click", function() {
				i = parseInt(this.getAttribute("data-num"));
				for(let k = 0; k < dots.length; k++) {
					slide[k].classList.remove('block');
					dots[k].classList.remove('active');
				}
				slide[i].classList.add('block');
				dots[i].classList.add('active');
			});
		}
	}
}