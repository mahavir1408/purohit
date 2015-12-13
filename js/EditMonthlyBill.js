// JavaScript Document
$(document).ready(function () {
	$(".bgoverlay").hide();
	$("#updateMonthlyBill").validationEngine({scroll: true, showArrow: true });
			
	var qs = $.url().param('bid');
	$('#idHfBillNum').val(qs);
            
	$.ajax({
        type:"POST",
        url: "Get_EditMonthlyBill.php?bid="+qs,
        datatype: "json",
		data: "{}",
        contentType: "application/json; charset=utf-8",
        success: function(data,textStatus,xhr) {
			data = JSON.parse(xhr.responseText);
			var i = 0;

			var snamesplit = data[i].sname;
			var snamesplit = snamesplit.split(" - ");

			$('#idTxPaybyCid').val(data[i].payby);	
			$('#idTxPayby').val(data[i].paybyname);
			$('#idTxShortName').val(snamesplit[0]);
			$('#idTxLocation').val(snamesplit[1]);
			$('#idTxState').val(data[i].state);
			$('#idTxCity').val(data[i].city);
			$('#idTxPaybyPin').val(data[i].pin);
			$('#idTxPaybyAl1').val(data[i].al1);
			$('#idTxPaybyAl2').val(data[i].al2);
			$('#idTxPaybyCell').val(data[i].contact);
			$('#idTxPaybyEmail').val(data[i].emailid);

			$('#idTxBillDt').val(data[i].date);	
			$('#idTxFromDt').val(data[i].fromdate);	
			$('#idTxToDt').val(data[i].todate);	  


			$('#txIdLaboutCharges').val(data[i].laborcharges);
			$('#txIdWaitingCharges').val(data[i].waitingcharges);
			$('#txIdOtherCharges').val(data[i].othercharges);

			$('#idSePayment').val(data[i].payment);
			$('#txIdPayDate').val(data[i].paydate);
			$('#idTxBankName').val(data[i].bankname);
			$('#idTxChequeNum').val(data[i].chequenum);

			var payby = data[i].payby
			var fromDt = data[i].fromdate;
			var toDt = data[i].todate;
			
			$.ajax({
                type:"POST",
                url: "Get_EditMonthlyBilll_DocketList.php?bid="+qs+"&from="+fromDt+"&to="+toDt+"&pay="+payby,
                datatype: "json",
				data: "{}", 
				beforeSend : function(){
					$(".bgoverlay").show();
				},
                contentType: "application/json; charset=utf-8",
                success: function(data,textStatus,xhr) {
                	data = JSON.parse(xhr.responseText);  
					var count = $('#idHfDocketCount').val();
					$('#idTbDocketList').find("tr:gt(0)").remove();					
					if ( data != "" && data != null) {					
						for ( var i = 0, len = data.length ; i < len; i++ ) {
							count = 1 * count + 1 * 1;
							$('#idHfDocketCount').val(count);
							
							$('#idTbDocketList').append( '<tr id="idTrCkSelect'+count+'">' +
							'<td><input type="checkbox" name="ckSelect'+count+'" id="idCkSelect'+count+'" value="'+data[i].did+'" style="margin:0 !important; display: block; text-align:left; padding:0px; width:50px; " dir="ltr" class="validate[groupRequired[payments]]" onclick="caltot()"  />  <input type="hidden" name="hfSelect'+count+'" id="idHfSelect'+count+'" value="'+data[i].did+'" /> </td>' +							
							'<td>'+data[i].idid+'</td>' +
							'<td>'+data[i].manualdocketnum+'</td>' +
							'<td>'+data[i].date+'</td>' +
							'<td>'+data[i].Paybyname+'</td>' +
							'<td id="idTdTot'+count+'">'+data[i].tot+'</td>' +
							'</tr>' );
							if (data[i].billed == 1) {
								$("#idCkSelect"+count).prop('checked', true);
							} else {
								$("#idCkSelect"+count).prop('checked',false );
							}					
						}
						caltot();						
					} else {
						$("#nodoc").show();
						$(".bgoverlay").hide();
						$("#nodoc").html("No Docket Found.").delay(2000).fadeOut(400);
						
					}					
					$(".bgoverlay").hide();					
				}
            }); // End Docket List Ajax
		}		
	}); // End Ajax	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	$("#idTxPayby,#idTxFromDt,#idTxToDt").change(function(){
		
		var fromDt = $('#idTxFromDt').val();
		var toDt = $('#idTxToDt').val();
		var payby = $('#idTxPaybyCid').val();
		if ( fromDt != '' && toDt != '' && payby != '' && payby != '0' ) {
			alert("sam");
			$.ajax({
				type:"POST",
				url: "Get_EditMonthlyBilll_DocketList.php?bid="+qs+"&from="+fromDt+"&to="+toDt+"&pay="+payby,
				datatype: "json",
				data: "{}",
				beforeSend : function(){
					$(".bgoverlay").show();
				},
				contentType: "application/json; charset=utf-8",
				success: function(data,textStatus,xhr) {
				data = JSON.parse(xhr.responseText);
								
				var count = $('#idHfDocketCount').val();
				$('#idTbDocketList').find("tr:gt(0)").remove();
				
				if ( data != "" && data != null) {
				
					for (var i = 0, len = data.length ; i < len; i++) {
						count = 1 * count + 1 * 1;
	
						$('#idHfDocketCount').val(count);
						
						$('#idTbDocketList').append( '<tr id="idTrCkSelect'+count+'">' +
						'<td><input type="checkbox" name="ckSelect'+count+'" id="idCkSelect'+count+'" value="'+data[i].did+'" style="margin:0 !important; display: block; text-align:left; padding:0px; width:50px; " dir="ltr" class="validate[groupRequired[payments]]" onclick="caltot()"  /></td>' +							
						'<td>'+data[i].did+'</td>' +
						'<td>'+data[i].manualdocketnum+'</td>' +
						'<td>'+data[i].date+'</td>' +
						'<td>'+data[i].Paybyname+'</td>' +
						'<td id="idTdTot'+count+'">'+data[i].tot+'</td>' +
						'</tr>' );
						if (data[i].billed == 1) {
							$("#idCkSelect"+count).prop('checked', true);
						} else {
							$("#idCkSelect"+count).prop('checked',false );
						}						
					} // End For
					caltot();
				} else {
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
			
			$("#idTxShortName" ).removeAttr('readonly');
			$("#idTxLocation" ).removeAttr('readonly');
			$("#idSePaybyCountry" ).removeAttr('readonly');
			$("#idTxState" ).removeAttr('readonly');
			$("#idTxCity" ).removeAttr('readonly');
			$("#idTxPaybyPin" ).removeAttr('readonly');
			$("#idTxPaybyEmail" ).removeAttr('readonly');
			$("#idTxPaybyCell" ).removeAttr('readonly');
			$("#idTxPaybyAl1" ).removeAttr('readonly');
			$("#idTxPaybyAl2" ).removeAttr('readonly');
			
			$("#idTxFromShortName" ).removeAttr('readonly');
			$("#idTxFromLocation" ).removeAttr('readonly');
			$("#idSeFromCountry" ).removeAttr('readonly');
			$("#idTxFromState" ).removeAttr('readonly');
			$("#idTxFromCity" ).removeAttr('readonly');
			$("#idTxFromPin" ).removeAttr('readonly');
			$("#idTxFromEmail" ).removeAttr('readonly');
			$("#idTxFromCell" ).removeAttr('readonly');
			$("#idTxFromAd1" ).removeAttr('readonly');
			$("#idTxFromAd2" ).removeAttr('readonly');
			
			$("#idTxToShortName" ).removeAttr('readonly');
			$("#idTxToLocation" ).removeAttr('readonly');
			$("#idSeToCountry" ).removeAttr('readonly');
			$("#idTxToState" ).removeAttr('readonly');
			$("#idTxToCity" ).removeAttr('readonly');
			$("#idTxToPin" ).removeAttr('readonly');
			$("#idTxToEmail" ).removeAttr('readonly');
			$("#idTxToCell" ).removeAttr('readonly');
			$("#idTxToAd1" ).removeAttr('readonly');
			$("#idTxToAd2" ).removeAttr('readonly');
});
