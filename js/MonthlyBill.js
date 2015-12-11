// JavaScript Document

$(document).ready(function () {
	
	$(".bgoverlay").hide();
	
	$("#addMonthlyBill").validationEngine({scroll: true, showArrow: true });
	
	$("#idTxPayby,#idTxToDt,#idTxFromDt").change(function(){
		
		var frmDt = $('#idTxFromDt').val();
		var toDT = $('#idTxToDt').val();
		var paybyId = $('#idTxPaybyCid').val();
		
		if ( frmDt != '' && toDT != '' && paybyId != '' && paybyId != '0' ) {
			
			$.ajax({
				type:"POST",
				url: "Get_MonthlyBill_DocketList.php?from="+frmDt+"&to="+toDT+"&payby="+paybyId,
				datatype: "json",
				data: "{}",
				beforeSend : function(){
					$(".bgoverlay").show();
				},
				contentType: "application/json; charset=utf-8",
				success: function(data,textStatus,xhr) {
				data = JSON.parse(xhr.responseText);
				//alert(data);
				var count = $('#idHfDocketCount').val();
				$('#idTbDocketList').find("tr:gt(0)").remove();

				if ( data != "" && data != null) {
					for (var i = 0, len = data.length ; i < len; i++) {
					count = 1 * count + 1 * 1;

					$('#idHfDocketCount').val(count);
					
					$('#idTbDocketList').append( '<tr id="idTrCkSelect'+count+'">' +
					'<td><input type="checkbox" name="ckSelect'+count+'" id="idCkSelect'+count+'" value="'+data[i].did+'" style="margin:0 !important; display: block; text-align:left; padding:0px; width:50px; " dir="ltr" class="validate[groupRequired[payments]]" onclick="caltot()"  /> <input type="hidden" name="hfSelect'+count+'" id="idHfSelect'+count+'" value="'+data[i].did+'" /> </td>' +							
					'<td>'+data[i].idid+'</td>' +
					'<td>'+data[i].manualdocketnum+'</td>' +
					'<td>'+data[i].date+'</td>' +
					'<td>'+data[i].Paybyname+'</td>' +
					'<td id="idTdTot'+count+'">'+data[i].tot+'</td>' +
					'</tr>' );
					}
				}
				else {
					$("#nodoc").show();
					$(".bgoverlay").hide();
					$("#nodoc").html("No Docket Found.").delay(2000).fadeOut(400);
					
				}
				
				$(".bgoverlay").hide();
				}
			});    // End Ajax
			
		} // End If
		else {
			
		}
		
  	});  // End Change
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$("#idCkSelectAll").click(function(){
		var	checkCount = $('#idHfDocketCount').val(); 
		//alert($(this).is(':checked'));
		//if ($("#idCkSelectAll").is(':checked')) {
		if ($(this).is(':checked')) {
			for (i = 1 ; i <= checkCount; i++) {
				//$("#idCkSelect"+i).attr('checked', this.checked );
				$("#idCkSelect"+i).prop('checked', true);
				caltot();
				calcbill();
			}
		}
		else {
			for (i = 1 ; i <= checkCount; i++) {
				//$("#idCkSelect"+i).removeAttr('checked');
				$("#idCkSelect"+i).prop('checked', false);
				caltot();
				calcbill();
				$('#txIdTot').val('');
				$('#txIdServcieTax').val('');
				$('#txIdEduChess').val('');
				$('#txIdHighEduChess').val('');
				$('#txIdLaboutCharges').val('');
				$('#txIdWaitingCharges').val('');
				$('#txIdOtherCharges').val('');
				$('#txIdPreGT').val('');
				$('#txIdGT').val('');
			}	
		}
		
	});  // End Click
	
	
	
	
		
});  // Document Ready
	

	