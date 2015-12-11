// JavaScript Document
$(document).ready(function () {
		
	$('#idSeDocSearchOption').change(function() {							
		// 1 = id
		// 2 = Docket No.
		// 3 = Date
		// 4 = Client Name
		// no Single bill docket
		//alert("sam");
		
		
		$(".clTxSearch" ).removeAttr('readonly');
		$(".clTxSearch" ).val('');
		
		if ( $('#idSeDocSearchOption').val() == 3 ) {		

			$(".clTxSearch" ).val('');
			$(".clTxSearch" ).attr('readonly', 'readonly');
			$(".clTxSearch" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd-mm-yy" ,
			showButtonPanel: true
			});
		}
		else if ( $('#idSeDocSearchOption').val() == 4 ) {
			
			$(".clTxSearch" ).val('');
			$(".clTxSearch" ).removeAttr('readonly');
			$( ".clTxSearch" ).autocomplete({
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
		else if ( $('#idSeDocSearchOption').val() == 1 ) {
			
			$(".clTxSearch").datepicker("destroy");
			$( ".clTxSearch" ).autocomplete( "destroy" );
			$(".clTxSearch" ).removeAttr('readonly');
			$(".clTxSearch" ).val('');
			
		}
		else if ( $('#idSeDocSearchOption').val() == 2 ) {
			
			$(".clTxSearch").datepicker("destroy");
			$( ".clTxSearch" ).autocomplete( "destroy" );
			$(".clTxSearch" ).removeAttr('readonly');
			$(".clTxSearch" ).val('');
			
		}
			
	}); // End Search Option Funct
	
	
	
	$('.clTxSearch').focus(function() {
		if ( $(".clTxSearch" ).val() == "Please enter value." ) {
			$(".clTxSearch" ).val("");
			$(".clTxSearch" ).css('border-color','#999999');
		}
	});								 
	
	
	$('#idBtnSearch').click(function() {
			
			var option = $("#idSeDocSearchOption").val();
			var value = $("#idTxSearch").val();
			
			if (  value == "" || value == "Please enter value." ) {
				//alert("Please enter value.");
				$(".clTxSearch" ).css('border-color','red');
				$(".clTxSearch" ).css('border-width','1px');
				$(".clTxSearch" ).css('border-style','solid');
				$(".clTxSearch" ).val('Please enter value.');
			}
			
			else {
			
				$.ajax({
					type:"POST",
					url: "AjaxListDockets.php?option="+option+"&value="+encodeURIComponent(value),
					datatype: "json",
					data: { },
					contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
					   data = JSON.parse(xhr.responseText);
					   // do something with data
					   $('#idTbListBills').find("tr:gt(0)").remove();
					   for (var i = 0, len = data.length; i < len; i++) {
						   
						   if ( data[i].trantype == 1) {
						   var tag = '<a href="ViewSingleBill.php?bid='+data[i].bid+'">View Bill</a>';
						   }
						   else {
						   var tag = '<a href="ViewDocket.php?id='+data[i].did+'">View</a>';
						   var EditDocket = '<a href="EditMonthlyTranscation.php?did='+data[i].did+'">Edit</a>';
						   }
						   
						   var bgcolor = "#DCDCDC";
						   
						   if (i%2 == 0) {
								bgcolor = "#F8F8FF";
								//alert("sam");
					   	   }
						   
							 $('#idTbListBills').append( '<tr style=" background-color:'+bgcolor+';">' +
								'<td valign="top" >'+data[i].date+'</td>' +
								'<td valign="top" >'+data[i].docId+'</td>' +
								'<td valign="top" >'+data[i].manualdocketnum+'</td>' +
								'<td valign="top" >'+data[i].Paybyname+'</td>' +
								'<td valign="top" >'+data[i].Fromname+'</td>' +
								'<td valign="top" >'+data[i].toname+'</td>' +
								//'<td>'+data[i].delivered+'</td>' +
								'<td valign="top" >'+tag+'</td>' +
								'<td valign="top" >'+EditDocket+'</td>' +
								'</tr>' );///end success
						}
					}
				});	// End Ajax
			
			}
			
     });		// End Btn Click
	
	
	
			
}); // End Doc Ready
