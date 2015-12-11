// JavaScript Document
$(document).ready(function () {
			
			
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
			
			$("#editTran").validationEngine({scroll: true, showArrow: true });
			
			var qs = $.url().param('did');
			var bid = 0;
			$('#idHfDocNum').val(qs);
			
			$.ajax({
                type:"POST",
                url: "Get_EditMonthlyTran_DocketDetails.php?bid="+qs,
                datatype: "json",
				data: "{}",
                contentType: "application/json; charset=utf-8",
                success: function(data,textStatus,xhr) {
                   data = JSON.parse(xhr.responseText);
                   var i = 0;
				   
				   var did = data[i].did;
				   //$('#idHfDocNum').val(did);
				   $('#idTxDocDt').val(data[i].date);
				   if ( data[i].manualdocketnum == 0 ) {
					   
				   }
				   else {
					   $('#idTxDocNum').val(data[i].manualdocketnum);
				   }
				   $('#idHfBilledStatus').val(data[i].billed);
				   $('#idHfBillId').val(data[i].bid);
				   bid = data[i].bid;
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
				   
				    var PaySnameSplit = data[i].Paybysname;
				    var PaySnameSplit = PaySnameSplit.split(" - ");
				   
				    $('#idTxPaybyCid').val(data[i].paybyid);
					$('#idTxPayby').val(data[i].Paybyname);
				    $("#idTxShortName" ).val(PaySnameSplit[0]);
					$("#idTxLocation" ).val(PaySnameSplit[1]);
					$("#idSePaybyCountry" ).val(data[i].Paybycountry);
					$("#idTxState" ).val(data[i].Paybystate);
					$("#idTxCity" ).val(data[i].Paybycity);
					$("#idTxPaybyPin" ).val(data[i].Paybypin);
					$("#idTxPaybyEmail" ).val(data[i].Paybyemailid);
					$("#idTxPaybyCell" ).val(data[i].Paybycontact);
					$("#idTxPaybyAl1" ).val(data[i].Paybyal1);
					$("#idTxPaybyAl2" ).val(data[i].Paybyal2);
				   
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
					url: "Get_Rate.php?from="+data[i].frm,
					datatype: "json",
					data: "{}",
					contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
						data = JSON.parse(xhr.responseText);
						// do something with data
					
						for (var i = 0, len = data.length; i < len; i++) {
						
						
						$('body').append( '<input type="hidden" id="idHfRate'+i+'" value="'+data[i].fromid+'_'+data[i].toid+'_'+data[i].tillkg+'_'+data[i].tillkgrate+'_'+data[i].abovetillkgrate+'" />' );
						 
						}
						$('body').append( '<input type="hidden" id="idHfRateCount" value="'+data.length+'" />' );
					} ///end success
					});    // End Ajax
				
				   
					$.ajax({
						type:"POST",
						url: "Get_EditSingleBill_PartiDetails.php?did="+qs,
						datatype: "json",
						data: "{}",
						contentType: "application/json; charset=utf-8",
						success: function(data,textStatus,xhr) {
						   data = JSON.parse(xhr.responseText);
						   var i = 0;
						   var rows = data[i].rowcount;
						  // var count =  data[i].rowcount;
						   var j = 0;
						   
						   var sum = 0;
						   
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
						    sum = 1 * sum + 1 * data[count].amt;
							$('#idHiRowCount').val(j);
							$('#idHfDocketSum').val(sum);
							}
			
						 }
					}); // End Particular Ajax
				   
				   $.ajax({
						type:"POST",
						url: "Get_EditMonthlyTran_BillDetails.php?bid="+bid,
						datatype: "json",
						data: "{}",
						contentType: "application/json; charset=utf-8",
						success: function(data,textStatus,xhr) {
						   data = JSON.parse(xhr.responseText);
						   var i = 0;
						   
						   $('#idHfServcieTaxRate').val(data[i].setaxrate);
						   $('#idHfEduChessRate').val(data[i].educhessrate);
						   $('#idHfHighEduChessRate').val(data[i].higheduchessrate);
						
							//laborcharges, waitingcharges, othercharges
							
						 }
					}); // End Bill Ajax
				    
				   
				   
				 }
            }); // End Docket Ajax
			
			
			
			
			
			
			
}); // End Doc Ready
