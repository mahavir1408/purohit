// JavaScript Document
$(document).ready(function () {
	
	$("#row2" ).hide();
	$("#row3" ).hide();
	$(".idTxSearch" ).val('');
	
	$('#idSeBillSearchOption').change(function() {								
		
		// 1 = Bill No.
		// 2 = Bill Date
		// 3 = Client Name

		if ( $('#idSeBillSearchOption').val() == 1 ) {			
			$("#row2" ).hide();
			$("#row3" ).hide();
			$("#row4" ).show();
			$("#row1" ).show();
			$(".idTxSearch" ).val('');
			$( "#idTxSearch" ).autocomplete( "destroy" );
		}
		else if ( $('#idSeBillSearchOption').val() == 2 ) {	
			
			$("#row2" ).show();
			$("#row3" ).show();
			$("#row1" ).hide();
			$("#row4" ).hide();
			$(".idTxSearch" ).val('');
			
			$("#idTxFromDate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd-mm-yy" ,
			showButtonPanel: true
			});
			
			$("#idTxToDate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd-mm-yy" ,
			showButtonPanel: true
			});
			
		}
		else if ( $('#idSeBillSearchOption').val() == 3 ) {	
			
			$("#row2" ).hide();
			$("#row3" ).hide();
			$("#row4" ).show();
			$("#row1" ).show();
			$("#idTxSearch" ).val('');
			
			$( "#idTxSearch" ).autocomplete({
			source: "getclient.php",
			minLength: 1,
			select: function( event, ui ) {
				
				if( ui.item )
				{		
				$("#clTxSearch" ).val(ui.item.value);
				$("#ifHfSearchCid" ).val(ui.item.id);
				}
				else
				{			
				}

			}
			});
			
		}
		else {
			// Do Something
		}
			
	}); // End Search Option Function
	
	$('.clTxSearch').focus(function() {
		if ( $(".clTxSearch" ).val() == "Please enter value." ) {
			$(".clTxSearch" ).val("");
			$(".clTxSearch" ).css('border-color','#999999');
		}
	});								 
	
	$("#idTxFromDate,#idTxToDate").change(function(){
	
		var frmDt = $('#idTxFromDate').val();
		var toDT = $('#idTxToDate').val();
		
		if ( frmDt != '' && toDT != '' ) {
			
			$.ajax({
			type:"POST",
			url: "ajaxListBillsByDate.php?from="+frmDt+"&to="+toDT,
			datatype: "json",
			data: "{}",
			contentType: "application/json; charset=utf-8",
			success: function(data,textStatus,xhr) {
			   data = JSON.parse(xhr.responseText);
			   // do something with data
			   $('#idTbListBills').find("tr:gt(0)").remove();
			   for (var i = 0, len = data.length; i < len; i++) {

				   if ( data[i].trantype == 1) {
				   var ViewBill = '<a href="ViewSingleBill.php?bid='+data[i].bid+'">View Bill</a>';
				   var EditBill = '<a href="EditSingleBill.php?bid='+data[i].bid+'">Edit Bill</a>';
				   }
				   else {
				   var ViewBill = '<a href="ViewMonthlyBill.php?bid='+data[i].bid+'">View Bill</a>';
				   var EditBill = '<a href="EditMonthlyBill.php?bid='+data[i].bid+'">Edit Bill</a>';
				   }
				   
					 $('#idTbListBills').append( '<tr>' +	
						'<td>'+data[i].idate+'</td>' +
						'<td>'+data[i].manualbillnum+'</td>' +
						'<td>'+data[i].paybyname+'</td>' +
						'<td>'+data[i].gt+'</td>' +
						'<td>'+data[i].payment+'</td>' +
						'<td>'+data[i].paydate+'</td>' +
						'<td>'+data[i].bankname+'</td>' +
						'<td>'+data[i].chequenum+'</td>' +
						'<td>'+ViewBill+'</td>' + 
						'<td>'+EditBill+'</td>' +  
						'</tr>' );///end success
				}
			}
			}); // End Ajax
			
		} // End If
	}); // End Change
	
	$('#idBtnSearch').click(function() {
		
		var option = $("#idSeBillSearchOption").val();
		var value = $("#idTxSearch").val();
		
		if ( value == "" || value == "Please enter value.") {
			//alert("Please enter value.");
			$(".clTxSearch" ).css('border-color','red');
			$(".clTxSearch" ).css('border-width','1px');
			$(".clTxSearch" ).css('border-style','solid');
			$(".clTxSearch" ).val('Please enter value.');
		}						 
		else {
			
			if (option == 1 || option == 3) {
				
				$.ajax({
				type:"POST",
				url: "Get_SearchBill_BillDetails.php?option="+option+"&value="+encodeURIComponent(value),
				datatype: "json",
				data: "{}",
				contentType: "application/json; charset=utf-8",
				success: function(data,textStatus,xhr) {
				   data = JSON.parse(xhr.responseText);
				   // do something with data
				   $('#idTbListBills').find("tr:gt(0)").remove();
				   for (var i = 0, len = data.length; i < len; i++) {
	
					   if ( data[i].trantype == 1) {
					   var ViewBill = '<a href="ViewSingleBill.php?bid='+data[i].bid+'">View Bill</a>';
					   var EditBill = '<a href="EditSingleBill.php?bid='+data[i].bid+'">Edit Bill</a>';
					   }
					   else {
					   var ViewBill = '<a href="ViewMonthlyBill.php?bid='+data[i].bid+'">View Bill</a>';
					   var EditBill = '<a href="EditMonthlyBill.php?bid='+data[i].bid+'">Edit Bill</a>';
					   }
					   
						 $('#idTbListBills').append( '<tr>' +	
							'<td>'+data[i].idate+'</td>' +
							'<td>'+data[i].manualbillnum+'</td>' +
							'<td>'+data[i].paybyname+'</td>' +
							'<td>'+data[i].gt+'</td>' +
							'<td>'+data[i].payment+'</td>' +
							'<td>'+data[i].paydate+'</td>' +
							'<td>'+data[i].bankname+'</td>' +
							'<td>'+data[i].chequenum+'</td>' +
							'<td>'+ViewBill+'</td>' + 
							'<td>'+EditBill+'</td>' +  
							'</tr>' );
					}  // end for
				} ///end success
				}); // End Ajax
				
			}
			else if ( option == 3) {
				/////////////
			}
		
		} // end if
		
     });
	
	
	
			
}); // End Doc Ready
