$(document).ready(function() {


	$("#btn_new").click(function() {
		
		if ( $("#btn_new").text() == "New" ) {
			
			Adding();
		}
		else {
			
			Save();
			
		}
		
	});
	
	$("#supplier_code").focus(function() {
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
	
	cParam = "supplier_id="+nID;
	
	$.ajax({
		"type":"POST",
		"url" : "get_supplier.php",
		"data": cParam,
		"success": function(text) {
			var f = JSON.parse(text); // Convert JSON string to actual JSON object
			$("#supplier_code").val(f.supplier_code);
			$("#name").val(f.name);
			$("#address").val(f.address);
			$("#contact").val(f.contact);
			$("#message").addClass("hidden"); // Hide message
			$("#supplier_id").val(nID);

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
        data: "supplier_id="+$("#supplier_id").val()
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
        url: "view_supplier.php",
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
	
	if ( $("#supplier_code").val() == "" ) {
		alert("Input Customer Code!");
		$("#customer_code").focus();
		return false;
	}
	
	if ( $("#name").val() == "" ) {
		alert("Input Last Name!");
		$("#last_name").focus();
		return false;
	}
    if ( $("#address").val() == "" ) {
		alert("Input Address!");
		$("#address").focus();
		return false;
	}
	
	if ( $("#contact").val() == "" ) {
		alert("Input Contact!");
		$("#contact").focus();
		return false;
	}
	
	
	return true;
}
	

function Save() {
	
	if ( !Check() ) 
		return false;
	
    $.ajax({
        type: "POST",
        url: "save_supplier.php",
        data: "supplier_code="+($("#supplier_code").val())+
			"&name="+($("#name").val())+
			"&address="+$("#address").val()+
			"&contact="+($("#contact").val())+
			"&supplier_id="+$("#supplier_id").val()
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
	
	$("#supplier_code").attr("disabled",false);
	$("#name").attr("disabled",false);
    $("#address").attr("disabled",false);
	$("#contact").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#supplier_code").focus();
		
}


function Adding() {
	
	$("#supplier_code").attr("disabled",false);
	$("#name").attr("disabled",false);
    $("#address").attr("disabled",false);
	$("#contact").attr("disabled",false);

	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#supplier_code").focus();
		
}

function Cancelled() {
	
	Clear();
	
	$("#supplier_code").attr("disabled",true);
	$("#name").attr("disabled",true);
    $("#address").attr("disabled",true);
	$("#contact").attr("disabled",true);
	
	$("#btn_new").text("New");
	$("#btn_cancel").attr("disabled",true);
	$("#btn_delete").attr("disabled",true);
	
}
function Clear() {
	
	
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	$("#supplier_id").val("0");
	

}