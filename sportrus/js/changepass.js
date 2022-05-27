$(document).ready(function() {
	$("#send-pass").bind("click", function(e) {
		e.preventDefault();
		var id = $("#userid").val();
		var oldpass = $("#oldpass").val();
		var newpass1 = $("#newpass1").val();
		var newpass2 = $("#newpass2").val();

		if ((newpass1 == newpass2) && (newpass1 != oldpass)) {
			$.ajax({
				url: "php/pass.php",
				type: "POST",
				data: ({id,oldpass,newpass1}),
				success: function(data) {
					if (data == 'Success'){
						alert("Изменения сохранены!");
						location.reload();
					} else {
						alert(data);
					}
				},
				error: function() {

				}
			});
		} else alert("Пароли не совпадают!");	
 
	});
});