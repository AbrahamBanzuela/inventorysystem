$(function() {

	window.setTimeout(function() {
		
		$("#date1").focus();
	},300);
	
	$("#btn_process").click(function() {
		
		LoadRecords();
		
	});
	$("#btn_print").click(function() {
		var date1 = document.getElementById("date1").value;
		window.open("inventory_print.php?date1="+date1);
		
		
	});

});


function LoadRecords() {
	

	$.ajax({
		"type":"POST",
		"url": "inventory_view.php",
		"data": {
			'date1': $("#date1").val(),
		},
		"success":function(text) {
			
			$(".load-body").html(text);
			$("#message").addClass("hidden"); // Hide message
			
		},
		"beforeSend":function() {
			$("#message").html("Loading records....");
			$("#message").removeClass("hidden"); // Show message
			
		},
		"error":function(x,a,t) {
		}
	});
	
}
