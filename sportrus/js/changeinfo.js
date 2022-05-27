$(document).ready(function() {
	$("#send-info").bind("click", function(e) {
		e.preventDefault();
		var id = $("#userid").val();
		var surn = $("#srname").val();
		var name = $("#name").val();
		var lastn = $("#lastname").val();
		var about = $("#about").val();
		
		$.ajax({
			url: "php/info.php",
			type: "POST",
			data: ({id,surn,name,lastn,about}),
			success: function(data) {
				if (data == 'Success'){
					alert("Изменения сохранены!");
					location.reload();
				}
			},
			error: function() {

			}
		});	
 
	});
});