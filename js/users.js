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

function Get(nID) {
	
	var cParam="";
	
	cParam = "login_id="+nID;
	
	$.ajax({
		"type":"POST",
		"url" : "get_user.php",
		"data": cParam,
		"success": function(text) {
			var f = JSON.parse(text); // Convert JSON string to actual JSON object
			$("#names").val(f.names);
			$("#username").val(f.username);
			$("#password").val(f.password);
			$("#user_type").val(f.user_type);
			$("#message").addClass("hidden"); // Hide message
			$("#login_id").val(nID);

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
        url: "delete_user.php",
        data: "login_id="+$("#login_id").val()
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
        url: "view_user.php",
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
	
	if ( $("#names").val() == "" ) {
		alert("Input Name!");
		$("#names").focus();
		return false;
	}
	
	if ( $("#username").val() == "" ) {
		alert("Input Username!");
		$("#username").focus();
		return false;
	}

    if ( $("#password").val() == "" ) {
		alert("Input Password!");
		$("#password").focus();
		return false;
	}
	
	
	return true;
}
	

function Save() {
	
	if ( !Check() ) 
		return false;
	
    $.ajax({
        type: "POST",
        url: "save_user.php",
        data: "names="+encodeURIComponent($("#names").val())+
			"&username="+encodeURIComponent($("#username").val())+
			"&password="+$("#password").val()+
            "&user_type="+$("#user_type").val()+
			"&login_id="+$("#login_id").val()
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
	
	$("#names").attr("disabled",false);
	$("#username").attr("disabled",false);
	$("#password").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#names").focus();
		
}


function Adding() {
	
	$("#names").attr("disabled",false);
	$("#username").attr("disabled",false);
	$("#password").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#names").focus();
		
}

function Cancelled() {
	
	Clear();
	
	$("#names").attr("disabled",true);
	$("#username").attr("disabled",true);
	$("#password").attr("disabled",true);
	
	$("#btn_new").text("New");
	$("#btn_cancel").attr("disabled",true);
	$("#btn_delete").attr("disabled",true);
	
}
function Clear() {
	
	
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	$("#login_id").val("0");
	

}