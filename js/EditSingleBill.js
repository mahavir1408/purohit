// JavaScript Document
$(document).ready(function () {
			
			$("#addtran").validationEngine({scroll: true, showArrow: true });
			
			var qs = $.url().param('bid');
			
			$('#idHfBillNum').val(qs);
			//var did = 0;
            
			$.ajax({
                type:"POST",
                url: "Get_EditSingleBill.php?bid="+qs,
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
				   
				   $('#idTxBilldt').val(data[i].date);	
				   
				   $('#txIdTot').val(data[i].subtot);
				   $('#txIdServcieTax').val(data[i].setax);
				   $('#txIdEduChess').val(data[i].educhess);
				   $('#txIdHighEduChess').val(data[i].higheduchess);
				   $('#idTxServcieTaxRate').val(data[i].setaxrate);
				   $('#idTxEduChessRate').val(data[i].educhessrate);
				   $('#idTxHighEduChessRate').val(data[i].higheduchessrate);
				   $('#txIdLaboutCharges').val(data[i].laborcharges);
				   $('#txIdWaitingCharges').val(data[i].waitingcharges);
				   $('#txIdOtherCharges').val(data[i].othercharges);
				   $('#txIdGT').val(data[i].gt);
				   $('#idSePayment').val(data[i].payment);
				   $('#txIdPayDate').val(data[i].paydate);
				   $('#idTxBankName').val(data[i].bankname);
				   $('#idTxChequeNum').val(data[i].chequenum);
				 }
            }); // End Ajax
			
			$.ajax({
                type:"POST",
                url: "Get_EditSingleBill_DocketDetails.php?bid="+qs,
                datatype: "json",
				data: "{}",
                contentType: "application/json; charset=utf-8",
                success: function(data,textStatus,xhr) {
                   data = JSON.parse(xhr.responseText);
                   var i = 0;
				   
				   var did = data[i].did;
				   $('#idHfDocNum').val(did);
				   $('#idTxDocDt').val(data[i].date);
				   if ( data[i].manualdocketnum == 0 ) {
					   
				   }
				   else {
					   $('#idTxDocNum').val(data[i].manualdocketnum);
				   }
				   
				   $('#idHfManualDocNum').val(data[i].manualdocketnum);
				   $('#idTxFromInvNum').val(data[i].invnum);
				   $('#idTxFromInvAmt').val(data[i].invamt);
				   $('#idTxFromGrnNum').val(data[i].grnnum);
				   $('#idTxFromOctriNum').val(data[i].octrinum);
				   $('#idTxFromOctriAmt').val(data[i].octriamt);
				   
				   $('#idSeDelivery').val(data[i].delivered);
				   $('#idTxDeliveryDt').val(data[i].delivereddt);
				   $('#idTxRecieverName').val(data[i].receivername);
				   $('#idTxRecieverDetail').val(data[i].receivercontactdetail);
				   $('#idTaNotice').val(data[i].notice);
				   
				   var FrmSnameSplit = data[i].Fromsname;
				   var FrmSnameSplit = FrmSnameSplit.split(" - ");
				   
				   $('#idTxFromCid').val(data[i].frm);
				   $('#idTxFrom').val(data[i].Fromname);
				   $('#idTxFromShortName').val(FrmSnameSplit[0]);
				   $('#idTxFromLocation').val(FrmSnameSplit[1]);
				   $('#idTxFromState').val(data[i].Fromstate);
				   $('#idTxFromCity').val(data[i].Fromcity);
				   $('#idTxFromPin').val(data[i].Frompin);
				   $('#idTxFromAd1').val(data[i].Fromal1);
				   $('#idTxFromAd2').val(data[i].Fromal2);
				   $('#idTxFromCell').val(data[i].Fromcontact);
				   $('#idTxFromEmail').val(data[i].Fromemailid);
				   
				   var ToSnameSplit = data[i].tosname;
				   var ToSnameSplit = ToSnameSplit.split(" - ");
				   
				   $('#idTxToCid').val(data[i].too);
				   $('#idTxTo').val(data[i].toname);
				   $('#idTxToShortName').val(ToSnameSplit[0]);
				   $('#idTxToLocation').val(ToSnameSplit[1]);
				   $('#idTxToState').val(data[i].tostate);
				   $('#idTxToCity').val(data[i].tocity);
				   $('#idTxToPin').val(data[i].topin);
				   $('#idTxToAd1').val(data[i].toal1);
				   $('#idTxToAd2').val(data[i].toal2);
				   $('#idTxToCell').val(data[i].tocontact);
				   $('#idTxToEmail').val(data[i].toemailid); 
				   
				   
				    $.ajax({
					type:"POST",
					url: "Get_Rate.php?from="+data[i].Fromname,
					datatype: "json",
					data: "{}",
					contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
						data = JSON.parse(xhr.responseText);
						// do something with data
					
						for (var i = 0, len = data.length; i < len; i++) {
						
						
						$('body').append( '<input type="hidden" id="idHfRate'+i+'" value="'+data[i].locationfrom+'_'+data[i].locationto+'_'+data[i].tillkg+'_'+data[i].tillkgrate+'_'+data[i].abovetillkgrate+'" />' );
						 
						}
						$('body').append( '<input type="hidden" id="idHfRateCount" value="'+data.length+'" />' );
					} ///end success
					});    // End Ajax
				   
					$.ajax({
						type:"POST",
						url: "Get_EditSingleBill_PartiDetails.php?did="+did,
						datatype: "json",
						data: "{}",
						contentType: "application/json; charset=utf-8",
						success: function(data,textStatus,xhr) {
						   data = JSON.parse(xhr.responseText);
						   var i = 0;
						   var rows = data[i].rowcount;
						  // var count =  data[i].rowcount;
						   var j = 0;
						   for ( count=0; count < rows; count++) {
						   j = j + 1;
						   
						   $('#tbParti').append( '<tr id="idTrParti'+ j +'">' +
						   '<td><input type="text" class="validate[required] text-input"  name="txParti'+ j +'" id="idTxParti'+ j +'" value="'+ data[count].parti +'"   /></td>' +
						   '<td><input type="text" class="validate[required] text-input" name="txQty'+ j +'" id="idTxQty'+ j +'"  onkeyup="calc(this.id)" value="'+ data[count].qty +'" /></td>' +
						   '<td><input type="text" class="validate[required] text-input" name="txWeight'+ j +'" id="idTxWeight'+ j +'"  onkeyup="calc(this.id)" value="'+ data[count].kg +'" /></td>' +
						   '<td><input type="text" class="validate[required] text-input" name="txRate'+ j +'" id="idTxRate'+ j +'"  onkeyup="calc(this.id)" value="'+ data[count].rate +'"  /></td>' +
						   '<td><input type="text" class="validate[required] text-input" name="txAmount'+ j +'" id="idTxAmount'+ j +'" value="'+ data[count].amt +'" /></td>' +
						   '<td><a href="javascript:void(0);" id="idADelItem" onclick="DelRow(\'idTrParti'+j+'\')" value="'+ data[count].parti +'" >Delete Item</a> <input type="hidden" name="hfPid'+ j +'" id="idHfPid'+ j +'" value="'+ data[count].pid +'" /></td>' +
						   '</tr>' );
						   
							$('#idHiRowCount').val(j);

							}
			
						 }
					}); // End Particular Ajax
				   
				   
				   
				   
				   
				   
				   
				 }
            }); // End Docket Ajax
			
			
			
			
			
			
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
