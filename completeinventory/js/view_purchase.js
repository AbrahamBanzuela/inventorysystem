$(function() {

	window.setTimeout(function() {
		
		$("#date_from").focus();
	},300);
	
	$("#btn_process").click(function() {
		
		LoadRecords();
		
	});
	$("#btn_print").click(function() {
		var date_from = document.getElementById("date_from").value;
		var date_to = document.getElementById("date_to").value;
		window.open("purchase_print.php?date_from="+date_from+"&date_to="+date_to);
		
		
	});
});


function LoadRecords() {
	

	$.ajax({
		"type":"POST",
		"url": "purchase_view.php",
		"data": {
			'date_from': $("#date_from").val(),
			'date_to': $("#date_to").val()
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
