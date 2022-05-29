$(document).ready(function() {
	$("#send").bind("click", function(e) {
		e.preventDefault();
		var id = $("#userid").val();
		var theme = $("#theme").val();
		var comm = $("#comm").val();
		
		if ((comm != '') && (theme != '')) {
			$.ajax({
				url: "php/review.php",
				type: "POST",
				data: ({id,theme,comm}),
				success: function(data) {
					if(data == 'Error') {
						
					} else
					if(data == 'Success'){
						$("#theme").val('');
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