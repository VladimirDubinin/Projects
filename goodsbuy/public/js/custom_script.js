function toaster(msg) {
	let container;
	if(document.querySelector(".toastr-container") === null) {
		container = document.createElement('div');
		container.className = "toastr-container";
		document.body.append(container);
		container = document.querySelector(".toastr-container");
	} else {
		container = document.querySelector(".toastr-container");
	}

	let toast = document.createElement('div');
	toast.classList.add("toastr","appear")
	toast.innerHTML = "<p class='toastr-msg'>"+msg+"</p>";
	toast.innerHTML += "<span class='exit' id='x'>&#10006;</span>";
	container.append(toast);
	let exit = toast.querySelector("#x");
	exit.addEventListener("click", function() {
		exit.parentNode.remove();
		console.log("msg")
	});
	setTimeout(function(){ 
		toast.remove();
		if (document.querySelectorAll(".toastr").length === 0) {
			document.querySelector(".toastr-container").remove();
		}
	}, 2000);
}