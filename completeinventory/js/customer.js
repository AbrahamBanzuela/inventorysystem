$(document).ready(function() {


	$("#btn_new").click(function() {
		
		if ( $("#btn_new").text() == "New" ) {
			
			Adding();
		}
		else {
			
			Save();
			
		}
		
	});
	
	$("#customers_code").focus(function() {
		$(this).select();
	});
	
	$("#btn_cancel").click(function() {
		Cancelled();
	});
	
	$("#btn_view").click(function() {
		$("#view_window").modal("show");
	});
	
	$('#view_window').on('shown.bs.modal', function () {
		View();
	});
	$(document.body).on("mousemove",".current_record",function() {
		$(this).addClass("hilite");
	});
	
	$(document.body).on("mouseout",".current_record",function() {
		$(this).removeClass("hilite");
	});
	
	$(document.body).on("click",".current_record",function() {
		Get($(this).attr("record_id"));
	});

	$("#btn_delete").click(function() {
		if ( confirm("Delete current record?") )
			Delete();
	});
	

});

function Get(nID) {
	
	var cParam="";
	
	cParam = "customers_id="+nID;
	
	$.ajax({
		"type":"POST",
		"url" : "get_customer.php",
		"data": cParam,
		"success": function(text) {
			var f = JSON.parse(text); // Convert JSON string to actual JSON object
			$("#customers_code").val(f.customer_code);
			$("#last_name").val(f.last_name);
            $("#first_name").val(f.first_name);
            $("#middle_name").val(f.middle_name);
			$("#address").val(f.address);
			$("#contact_number").val(f.contact);
			$("#message").addClass("hidden"); // Hide message
			$("#customers_id").val(nID);

            $("#view_window").modal("hide");
			
            Editing();
		},
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Checking...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}

function Delete() {
	
	
    $.ajax({
        type: "POST",
        url: "delete_customer.php",
        data: "customers_id="+$("#customers_id").val()
        ,
        success : function(text) {
			
			$("#message").addClass("hidden");
			if ( text = "" )
				alert(text);
			
			
			Cancelled();
			
        },
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Checking...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}


function View() {
	
	
    $.ajax({
        type: "POST",
        url: "view_customer.php",
        data: ""
        ,
        success : function(text) {
			$("#records").html(text);
			$("#message").addClass("hidden");
        },
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Checking...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}

function Check() {
	
	if ( $("#customers_code").val() == "" ) {
		alert("Input Customer Code!");
		$("#customers_code").focus();
		return false;
	}
	
	if ( $("#last_name").val() == "" ) {
		alert("Input Last Name!");
		$("#last_name").focus();
		return false;
	}

    if ( $("#first_name").val() == "" ) {
		alert("Input First Name!");
		$("#first_name").focus();
		return false;
	}

    if ( $("#middle_name").val() == "" ) {
		alert("Input Middle Name!");
		$("#middle_name").focus();
		return false;
	}
    if ( $("#address").val() == "" ) {
		alert("Input Address!");
		$("#address").focus();
		return false;
	}
	
	if ( $("#contact_number").val() == "" ) {
		alert("Input Contact!");
		$("#contact_number").focus();
		return false;
	}
	
	
	return true;
}
	

function Save() {
	
	if ( !Check() ) 
		return false;
	
    $.ajax({
        type: "POST",
        url: "save_customer.php",
        data: "&customers_code="+($("#customers_code").val())+
			"&last_name="+($("#last_name").val())+
			"&first_name="+$("#first_name").val()+
            "&middle_name="+$("#middle_name").val()+
            "&address="+($("#address").val())+
			"&contact_number="+($("#contact_number").val())+
			"&customers_id="+$("#customers_id").val()
        ,
        success : function(text) {
			
			$("#message").addClass("hidden");
			if ( text == "success" ) {
				Cancelled();
			}
			else {
				alert(text);
			}
        },
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Saving...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}

function Editing() {
	
	$("#customers_code").attr("disabled",false);
	$("#last_name").attr("disabled",false);
	$("#first_name").attr("disabled",false);
    $("#middle_name").attr("disabled",false);
	$("#address").attr("disabled",false);
	$("#contact_number").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#customer_code").focus();
		
}


function Adding() {
	
	$("#customers_code").attr("disabled",false);
	$("#last_name").attr("disabled",false);
	$("#first_name").attr("disabled",false);
    $("#middle_name").attr("disabled",false);
	$("#address").attr("disabled",false);
	$("#contact_number").attr("disabled",false);

	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#customer_number").focus();
		
}

function Cancelled() {
	
	Clear();
	
	$("#customers_code").attr("disabled",true);
	$("#last_name").attr("disabled",true);
	$("#first_name").attr("disabled",true);
    $("#middle_name").attr("disabled",true);
	$("#address").attr("disabled",true);
	$("#contact_number").attr("disabled",true);
	
	$("#btn_new").text("New");
	$("#btn_cancel").attr("disabled",true);
	$("#btn_delete").attr("disabled",true);
	
}
function Clear() {
	
	
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	$("#customers_id").val("0");
	

}