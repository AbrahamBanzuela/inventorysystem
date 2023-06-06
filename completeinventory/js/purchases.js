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
	
	$('#view_window').on('shown.bs.modal', function () {
		View();
	});
	$(document.body).on("change",".quantity1",function() {
		UpdateQty(parseInt(Math.abs($(this).attr("index"))));
	});
	$(document.body).on("change",".price",function() {
		UpdatePrice(parseInt(Math.abs($(this).attr("index"))));
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
	
	
	
	
	LoadSuppliers();
	LoadProducts();

});	

function ShowTotal() {
	
	var nTotal = Round(Math.abs($("#quantity").val())*Math.abs($("#price").val()));
	$("#total").val(nTotal);
}

function Round(nValue) {
	
	return Math.round(nValue*100)/100;
}
function UpdateQty(nIndex) {

	$.ajax({
		type: "POST",
		url: "purchases_qty.php",
		data: "index="+nIndex+"&quantity1="+$("#quantity1"+nIndex).val(),
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
function UpdatePrice(nIndex) {

	$.ajax({
		type: "POST",
		url: "purchases_price.php",
		data: "index="+nIndex+"&price="+$("#price"+nIndex).val(),
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

function GetPrice() {
	
	
	$.ajax( {
		type: "POST",
		url: "get_product.php",
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
        url: "get_purchases.php",
        data: "purchase_id="+cID
        ,
        success : function(text) {

			var f = JSON.parse(text);
			
			$("#invoice_number").val(f.invoice_number);
			$("#invoice_date").val(f.invoice_date);
			$("#supplier_id").val(f.supplier_id);
			$("#purchase_id").val(cID);
			
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
        url: "delete_purchases.php",
        data: "purchase_id="+$("#purchase_id").val()
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
        url: "view_purchases.php",
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


function LoadSuppliers() {
	
	
    $.ajax({
        type: "POST",
        url: "load_supplier.php",
        data: ""
        ,
        success : function(text) {
			$("#supplier_id").html(text);
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
	
	if ( $("#invoice_number").val() == "" ) {
		alert("Input invoice number!");
		$("#invoice_number").focus();
		return false;
	}
	
	if ( $("#invoice_date").val() == "" ) {
		alert("Input invoice_date!");
		$("#invoice_date").focus();
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
        url: "add_purchases_product.php",
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
		url: "remove_purchases_detail.php",
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
        url: "load_purchases_detail.php",
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
        url: "save_purchases.php",
        data: "invoice_number="+encodeURIComponent($("#invoice_number").val())+
			"&invoice_date="+encodeURIComponent($("#invoice_date").val())+
			"&price="+$("#price").val()+
			"&supplier_id="+$("#supplier_id").val()+
			"&purchase_id="+$("#purchase_id").val()
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
	
	$("#invoice_number").attr("disabled",false);
	$("#invoice_date").attr("disabled",false);
	$("#supplier_id").attr("disabled",false);
	
	$("#product_id").attr("disabled",false);
	$("#quantity").attr("disabled",false);
	$("#price").attr("disabled",false);
	$("#btn_add_product").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#invoice_number").focus();
	
	
	
	ClearProduct();
		
}


function Adding() {
	
	$("#invoice_number").attr("disabled",false);
	$("#invoice_date").attr("disabled",false);
	$("#supplier_id").attr("disabled",false);
	
	$("#product_id").attr("disabled",false);
	$("#quantity").attr("disabled",false);
	$("#price").attr("disabled",false);
	$("#btn_add_product").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#invoice_number").focus();
	
	Clear();
	
	GetPrice();
	
	window.setTimeout(function() {
		ShowTotal();
	},300);
	
		
}

function Cancelled() {
	
	location="purchases.php";
	
}

function Clear() {
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	$("#quantity").val("1");
	$("#price").val("0");
	$("#purchase_id").val("0");
	

}
