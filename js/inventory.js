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
	
	$("#btn_view").click(function() {
		$("#view_window").modal("show");
	});
	
	$('#btn_view').on('shown.bs.modal', function () {
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
		GetPrice();
		window.setTimeout(function() {
			ShowTotal();
		},300);
	});
	LoadProducts();
});	

function ShowTotal() {
	
	var nTotal = Round(Math.abs($("#quantity").val())*Math.abs($("#price").val()));
	$("#total").val(nTotal);
}

function Round(nValue) {
	
	return Math.round(nValue*100)/100;
}

function GetPrice() {
	
	
	$.ajax( {
		type: "POST",
		url: "get_inventory.php",
		data: "product_id="+$("#product_id").val(),
		success: function(text) {
			var f = JSON.parse(text);
			$("#price").val(f.price);
		},
		beforeSend: function() {
			
		},
		error: function(a,b,c) {
		}
	});
}

function Get(cID) {
	
	
    $.ajax({
        type: "POST",
        url: "get_product_inventory.php",
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
        url: "delete_inventory.php",
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


function View() {
	
	
    $.ajax({
        type: "POST",
        url: "view_product_inventory.php",
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
	
	if ( Math.abs($("#price").val()) == 0 ) {
		alert("Input price");
		window.setTimeout(function() {
			$("#price").focus();
		},150);
		return false;
	}
	
	return true;
}

function ClearProduct() {
	
	$("#quantity").val("1");
	$("#price").val("0");
	$("#total").val("0");
	GetPrice();
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
        url: "add_product_inventory.php",
        data: "product_id="+encodeURIComponent($("#product_id").val())+
			"&description="+encodeURIComponent($("#product_id :selected").text())+
			"&price="+$("#price").val()+
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
		url: "remove_product_detail.php",
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
        url: "load_inventory_details.php",
        data: "",
        success : function(text) {
			$("#details").html(text);			
			$("#message").addClass("hidden");
			location="#inventory_bottom";
			
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
        url: "save_inventory.php",
        data: "inventory_date="+encodeURIComponent($("#inventory_date").val())+
			"&price="+$("#price").val()+
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
	$("#price").attr("disabled",false);
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
	$("#price").attr("disabled",false);
	$("#btn_add_product").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#inventory_date").focus();
	
	Clear();
	
	GetPrice();
	
	window.setTimeout(function() {
		ShowTotal();
	},300);
	
		
}

function Cancelled() {
	
	location="product_inventory.php";
	
}

function Clear() {
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	
	$("#quantity").val("1");
	$("#price").val("0");
	$("#physical_id").val("0");
	

}
