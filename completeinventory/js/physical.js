$(document).ready(function() {


	$("#btn_new").click(function() {

		if ( $("#btn_new").text() == "New" ) {
			
			Adding();
		}
		else {
			
			Save();
			
		}
		
	});
	
	$("#btn_cancel").click(function() {
		Cancelled();
	});
    $("#btn_search").click(function() {
		$("#view_window").modal("show");
	});
	
	$('#view_window').on('shown.bs.modal', function () {
		Search();
	});
	$(document.body).on("change",".quantity",function() {
		UpdateQty(parseInt(Math.abs($(this).attr("index"))));
	});
	$(document.body).on("change",".cost",function() {
		UpdateCost(parseInt(Math.abs($(this).attr("index"))));
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
	
	$("#btn_add_product").click(function() {
		
		AddProduct();
	});
	
	$(document.body).on("mousemove",".details",function() {
		$(this).addClass("hilite");
	});
	
	$(document.body).on("mouseout",".details",function() {
		$(this).removeClass("hilite");
	});
	
	$(document.body).on("click",".remove_detail",function() {
		if ( confirm("Delete detail?") ) {
			var nIndex = Math.abs($(this).attr("index"));
			DeleteDetail(nIndex);
		};
	});
	
	$("#quantity,#price").focus(function() {
		$(this).select();
	});
	
	$("#quantity,#price").keyup(function() {
		ShowTotal();
	});
	
	$("#quantity,#price").change(function() {
		ShowTotal();
	});
	
	$("#product_id").change(function() {
		window.setTimeout(function() {
			ShowTotal();
		},300);
	});
	
	
	LoadProducts();

});	

function ShowTotal() {
	
	var nTotal = Round(Math.abs($("#quantity").val())*Math.abs($("#cost").val()));
	$("#total").val(nTotal);
}

function Round(nValue) {
	
	return Math.round(nValue*100)/100;
}

function UpdateQty(nIndex) {

	$.ajax({
		type: "POST",
		url: "physical_quantity.php",
		data: "index="+nIndex+"&quantity="+$("#quantity"+nIndex).val(),
		success: function(text) {
			$("#message").addClass("hidden");
			if ( text != "" )
				alert(text);
		},
		beforeSend: function() {
			$("#message").val("Saving...");
			$("#message").removeClass("hidden");
		},
		error: function(a,b,c) {
		}
	});
}
function UpdateCost(nIndex) {

		$.ajax({
		"type":"POST",
		"url": "physical_cost.php",
		"data": "index="+nIndex+"&cost="+$("#cost"+nIndex).val(),
		"success":function(text) {
		if ( text !== "" ) { // if there is an error 
		alert(text); // Show error
		}
		else {
		$("#records").html(text);
		$("#message").addClass("hidden"); // Hide message
		LoadDetails();
		Editing();
		Reset(); // Clear the fields
		}
		$("#btn_save").attr("disabled",false); // Enable button after saving
		},
		"beforeSend":function() {
		$("#message").html("Updating....");
		$("#message").removeClass("hidden"); // Show message
		},
		"error":function(x,a,t) {
		}
		});
}

function Get(cID) {
	
	
    $.ajax({
        type: "POST",
        url: "get_physical.php",
        data: "physical_id="+cID
        ,
        success : function(text) {

			var f = JSON.parse(text);
			
			$("#inventory_date").val(f.inventory_date);
			$("#physical_id").val(cID);
			
			$("#message").addClass("hidden");
			
			$("#view_window").modal("hide");
			
			Editing();
			LoadDetails();
			
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
        url: "delete_physical.php",
        data: "physical_id="+$("#physical_id").val()
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


function Search() {
	
	
    $.ajax({
        type: "POST",
        url: "view_physical.php",
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

function LoadProducts() {
	
	
    $.ajax({
        type: "POST",
        url: "load_product.php",
        data: ""
        ,
        success : function(text) {
			$("#product_id").html(text);
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
	
	if ( $("#inventory_date").val() == "" ) {
		alert("Input Inventory Date!");
		$("#inventory_date").focus();
		return false;
	}
	
	
	return true;
}

function CheckDetai() {
	
	if ( Math.abs($("#quantity").val()) == 0 ) {
		alert("Input quantity");
		window.setTimeout(function() {
			$("#quantity").focus();
		},150);
		return false;
	}
	
	if ( Math.abs($("#cost").val()) == 0 ) {
		alert("Input Cost");
		window.setTimeout(function() {
			$("#cost").focus();
		},150);
		return false;
	}
	
	return true;
}

function ClearProduct() {
	
	$("#quantity").val("1");
	$("#cost").val("0");
	$("#total").val("0");
	window.setTimeout(function() {
		ShowTotal();
	},300);
}

function AddProduct() {
	
	if ( !CheckDetai() ) {
		return false;
	}
	$("#btn_add_product").attr("disabled",true); // Disable button after clicking to prevent double click
    $.ajax({
        type: "POST",
        url: "add_physical_product.php",
        data: "product_id="+encodeURIComponent($("#product_id").val())+
			"&description="+encodeURIComponent($("#product_id :selected").text())+
			"&cost="+$("#cost").val()+
			"&quantity="+$("#quantity").val()
        ,
        success : function(text) {
			
			if ( text !== "" )
				alert(text);
			ClearProduct();
			$("#message").addClass("hidden");
			LoadDetails();
			
			window.setTimeout(function() {
				$("#btn_add_product").attr("disabled",false);
				$("#product_id").focus();
			},300);
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

function DeleteDetail(nIndex) {
	
	$.ajax({
		type: "POST",
		url: "remove_physical_details.php",
		data: "index="+nIndex,
		success: function(text) {
			$("#message").addClass("hidden");
			if ( text != "" )
				alert(text);
			LoadDetails();
		},
		beforeSend: function() {
			$("#message").val("Deleting...");
			$("#message").removeClass("hidden");
		},
		error: function(a,b,c) {
			
		}
	});
	
}

function LoadDetails() {
	
	$.ajax({
        type: "POST",
        url: "load_physical_details.php",
        data: ""
        ,
        success : function(text) {
			$("#details").html(text);			
			$("#message").addClass("hidden");
			
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


function Save() {
	
	if ( !Check() ) 
		return false;
	
    $.ajax({
        type: "POST",
        url: "save_physical.php",
        data: "inventory_date="+encodeURIComponent($("#inventory_date").val())+
			"&physical_id="+$("#physical_id").val()
        ,
        success : function(text) {
			
			$("#message").addClass("hidden");
			if ( text == "success" ) {
				Cancelled();
			}
			else {
				alert(text);
			}
			LoadDetails();
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
	
	$("#inventory_date").attr("disabled",false);
	
	$("#product_id").attr("disabled",false);
	$("#quantity").attr("disabled",false);
	$("#cost").attr("disabled",false);
	$("#btn_add_product").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#inventory_date").focus();
	
	
	
	ClearProduct();
		
}


function Adding() {
	
	$("#inventory_date").attr("disabled",false);
	
	$("#product_id").attr("disabled",false);
	$("#quantity").attr("disabled",false);
	$("#cost").attr("disabled",false);
	$("#btn_add_product").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#inventory_date").focus();
	
	Clear();
	
	window.setTimeout(function() {
		ShowTotal();
	},300);
	
		
}

function Cancelled() {
	
	location="physical_inventory.php";
	
}

function Clear() {
	
	$("input[type='text']").each(function() {
		$(this).val("");
	});

	$("#quantity").val("1");
	$("#cost").val("0");
	$("#physical_id").val("0");
	

}
