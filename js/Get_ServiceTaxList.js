// JavaScript Document

$(function() {
		$( "#idTxFromDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	}); 

$(function() {
		$( "#idTxToDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	}); 

$(document).ready(function () {
	
	$("#frmIdListDockets").validationEngine({scroll: true, showArrow: true });
	
	$('#idTxFromDate,#idTxToDate').change(function() {
	
	var from = $('#idTxFromDate').val();
	var to = $('#idTxToDate').val();
	
	if (from != "" && to  != "" ) {
		//alert("sam");
		$.ajax({	// Get Parent Details Ajax	for heading
			type:"POST",
			url: "Get_ServiceTaxList.php?fromdate="+from+"&todate="+to,
			datatype: "json",
			data: "{}",
			async: false,
			contentType: "application/json; charset=utf-8",
			success: function(data,textStatus,xhr) {
				data = JSON.parse(xhr.responseText);
				var i = 0;
				var totst = 0;
				
				var subtotal = 0;
				var st = 0;
				var ec = 0;
				var hec = 0;
				var gt = 0;
				var stt = 0;
				
				for (j=0; j<data.length; j++) {
					
					totst = (data[j].setax * 1) + (data[j].educhess * 1) + (data[j].higheduchess * 1);
					subtotal = (subtotal * 1) + (data[j].subtot * 1);
					st = (st * 1) + (data[j].setax * 1);
					ec = (ec * 1) + (data[j].educhess * 1);
					hec = (hec * 1) + (data[j].higheduchess * 1);
					gt = (gt * 1) + (data[j].gt * 1);
					stt = (stt * 1) + (totst.toFixed(2) * 1);
					
					$('#idTbStReport').append( '<tr>' +
					'<td style="text-align:left; width:200px;">'+data[j].paybyname+'</td>' +
					'<td>'+data[j].manualbillnum+'</td>' +
					'<td>'+data[j].idate+'</td>' +
					'<td>'+data[j].subtot+'</td>' +
					'<td>'+data[j].setax+'</td>' +
					'<td>'+data[j].educhess+'</td>' +
					'<td>'+data[j].higheduchess+'</td>' +
					'<td>'+data[j].gt+'</td>' +
					'<td>'+totst.toFixed(2)+'</td>' +
					'</tr>' );
					
				} // End for
				
				$('#idTbStReport').append( '<tr style=" background-color:#EEEEEE; font-weight:bold;">' +
				'<td style="text-align:left;">TOTAL</td>' +
				'<td></td>' +
				'<td></td>' +
				'<td>'+subtotal+'</td>' +
				'<td>'+st.toFixed(2)+'</td>' +
				'<td>'+ec.toFixed(2)+'</td>' +
				'<td>'+hec.toFixed(2)+'</td>' +
				'<td>'+gt+'</td>' +
				'<td>'+stt.toFixed(2)+'</td>' +
				'</tr>' );
				
			} // End Success
		}); 
	}
	
	});  // End Change
			

}); // End Doc Ready	
