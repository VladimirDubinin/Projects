$(document).ready(function() { // Отправка комментария на странице viewing.php
	$("#send").bind("click", function(e) {
		e.preventDefault();
		var comm = $("#comm").val();
		var id = $("#userid").val();
		var nid = $("#newsid").val();
		// ajax-запрос
		if (comm !== '') {
			$.ajax({
				url: "php/comm.php", // добавляем в базу 
				type: "POST",
				data: ({id,comm,nid}),
				success: function(data) {
					if(data == 'Error') {
						
					} else
					if(data == 'Success'){
						$("#comm").val('');
						location.reload();
					}
				},
				error: function() {

				}
			});	
		} 
	});
});