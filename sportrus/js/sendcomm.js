$(document).ready(function() {
	$("#send").bind("click", function(e) {
		e.preventDefault();
		var comm = $("#comm").val();
		var id = $("#userid").val();
		var nid = $("#newsid").val();
		
		if (comm !== '') {
			$.ajax({
				url: "php/comm.php",
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