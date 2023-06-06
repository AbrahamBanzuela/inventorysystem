$(document).ready(function() {


	$("#btn_new").click(function() {
		
		if ( $("#btn_new").text() == "New" ) {
			
			Adding();
		}
		else {
			
			Save();
			
		}
		
	});
	
	$("#price").focus(function() {
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

function Get(cID) {
	
	
    $.ajax({
        type: "POST",
        url: "get_product.php",
        data: "product_id="+cID
        ,
        success : function(text) {
			
			var f = JSON.parse(text);
			
			$("#product_code").val(f.product_code);
			$("#description").val(f.description);
			$("#price").val(f.price);
			$("#product_id").val(cID);
			
			$("#message").addClass("hidden");
			
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
        url: "delete_product.php",
        data: "product_id="+$("#product_id").val()
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
        url: "view_product.php",
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
	
	if ( $("#product_code").val() == "" ) {
		alert("Input code!");
		$("#product_code").focus();
		return false;
	}
	
	if ( $("#description").val() == "" ) {
		alert("Input description!");
		$("#description").focus();
		return false;
	}
	
	
	return true;
}
	

function Save() {
	
	if ( !Check() ) 
		return false;
	
    $.ajax({
        type: "POST",
        url: "save_product.php",
        data: "product_code="+encodeURIComponent($("#product_code").val())+
			"&description="+encodeURIComponent($("#description").val())+
			"&price="+$("#price").val()+
			"&product_id="+$("#product_id").val()
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
	
	$("#product_code").attr("disabled",false);
	$("#description").attr("disabled",false);
	$("#price").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#product_code").focus();
		
}


function Adding() {
	
	$("#product_code").attr("disabled",false);
	$("#description").attr("disabled",false);
	$("#price").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#product_code").focus();
		
}

function Cancelled() {
	
	Clear();
	
	$("#product_code").attr("disabled",true);
	$("#description").attr("disabled",true);
	$("#price").attr("disabled",true);
	
	$("#btn_new").text("New");
	$("#btn_cancel").attr("disabled",true);
	$("#btn_delete").attr("disabled",true);
	
}
function Clear() {
	
	
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	$("#price").val("0");
	$("#product_id").val("0");
	

}