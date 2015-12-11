<?php
	session_start();
	include("config.inc");
	//echo $_SESSION['cid'];
	if (!isset($_SESSION['login_id']))
	{
		// not logged in, move to login page
		header('Location: index.php');
		exit;
	}
	else if (isset($_SESSION['login_id'])) 
	{
		$login_id = $_SESSION['login_id'];
		//echo "$login_id";	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />

<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" src="js/jquery.validationEngine-en.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.validationEngine.js" type="text/javascript" ></script>

<script language="javascript" src="js/jquery.ui.core.js" type="text/javascript" ></script>
<script language="javascript" src="js/jquery.ui.autocomplete.js" type="text/javascript" ></script>

<script type="text/javascript" language="javascript" src="js/purl.js"></script>
<script language="javascript" src="js/date.format.js" type="text/javascript" ></script>
<script language="javascript" src="js/addtran.js" type="text/javascript" ></script>
<script language="javascript" src="js/EditSingleBill.js" type="text/javascript" ></script>

	</script>

<script type="text/javascript">
	$(function() {
		function log( message ) {
			$( "<div>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}

		$( "#idTxPayby" ).autocomplete({
			source: "getclient.php",
			//source: function(req, response) {
//			   $.ajax({
//				url: "getclient.php",
//				dataType: "json",
//				success: function( data ) {
//					var re = $.ui.autocomplete.escapeRegex(req.term);
//					var matcher = new RegExp( "^" + re, "i" );
//					response($.grep(data, function(item){return matcher.test(item.value);}) );
//					}
//				});
//				 },
			minLength: 1,
			delay: 1000,
			select: function( event, ui ) {
				
				if( ui.item )
				{		
				$("#idTxPaybyCid" ).val(ui.item.id);
				$("#idPaybystatus" ).text("");
				
				
				$.ajax({
                type:"POST",
                url: "getClientDetailsSingleBill.php?cid="+ui.item.id,
                datatype: "json",
				data: "{}",
                contentType: "application/json; charset=utf-8",
                success: function(data,textStatus,xhr) {
                   data = JSON.parse(xhr.responseText);
                   // do something with data
                  // for (var i = 0, len = data.length; i < len; i++) {
//                       //
//					     $('#idTbListBills').append( '<tr>' +
//							'<td>'+data[i].bid+'</td>' +
//							'<td>'+data[i].manualbillnum+'</td>' +
//							'<td>'+data[i].paybyname+'</td>' +
//							'<td>'+data[i].gt+'</td>' +
//							'<td>'+data[i].payment+'</td>' +
//							'<td><a href="ViewBill.php?bid='+data[i].bid+'">View Bill</a></td>' +
//							'</tr>' );///end success
//					}
					var i = 0;
					var snamesplit = data[i].sname;
					var snamesplit = snamesplit.split(" - ");
					$("#idTxShortName" ).val(snamesplit[0]);
					$("#idTxLocation" ).removeAttr("Class");
					//$("#idTxLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp]] text-input");
				//	class="validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input"  />
					$("#idTxLocation" ).val(data[i].location);
					$("#idSePaybyCountry" ).val(data[i].country);
					$("#idTxState" ).val(data[i].state);
					$("#idTxCity" ).val(data[i].city);
					$("#idTxPaybyPin" ).val(data[i].pin);
					$("#idTxPaybyEmail" ).val(data[i].emailid);
					$("#idTxPaybyCell" ).val(data[i].contact);
					$("#idTxPaybyAl1" ).val(data[i].al1);
					$("#idTxPaybyAl2" ).val(data[i].al2);
					
					$("#hfIdTillKg" ).val(data[i].tillkg);
					$("#hfIdTillKgRate" ).val(data[i].tillkgrate);
					$("#hfIdAboveTillKgRate" ).val(data[i].kgRateabovetillkg);
					
				}
            	});    // End Ajax
				
				
				}
				else
				{			
				}

			},
			response: function(event, ui) {
				// ui.content is the array that's about to be sent to the response callback.
				if (ui.content.length === 0) {
				    $("#idPaybystatus" ).text("No results found");
					$("#idTxPaybyCid" ).val("0");
					$("#idTxLocation" ).removeAttr("Class");
					//$("#idTxLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
				//	class="validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input"  />
					$("#idSePaybyCountry" ).removeAttr('readonly');
					$("#idTxShortName" ).removeAttr('readonly');
					$("#idTxLocation" ).removeAttr('readonly');
					$("#idTxState" ).removeAttr('readonly');
					$("#idTxCity" ).removeAttr('readonly');
					$("#idTxPaybyPin" ).removeAttr('readonly');
					$("#idTxPaybyEmail" ).removeAttr('readonly');
					$("#idTxPaybyCell" ).removeAttr('readonly');
					$("#idTxPaybyAl1" ).removeAttr('readonly');
					$("#idTxPaybyAl2" ).removeAttr('readonly');
				} 
				else {
					
				}
			},
			close: function( event, ui ) {
				if ( $("#idTxPaybyCid" ).val() == 0 ) {
				$("#idSePaybyCountry" ).removeAttr('readonly');
					$("#idTxShortName" ).removeAttr('readonly');
					$("#idTxLocation" ).removeAttr("Class");
					//$("#idTxLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
					$("#idTxLocation" ).removeAttr('readonly');
					$("#idTxState" ).removeAttr('readonly');
					$("#idTxCity" ).removeAttr('readonly');
					$("#idTxPaybyPin" ).removeAttr('readonly');
					$("#idTxPaybyEmail" ).removeAttr('readonly');
					$("#idTxPaybyCell" ).removeAttr('readonly');
					$("#idTxPaybyAl1" ).removeAttr('readonly');
					$("#idTxPaybyAl2" ).removeAttr('readonly');
				}
			}
		});
	});
	
	
	
	
	
	$(function() {
		$( "#idTxDocDt" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	});
	$(function() {
		$( "#idTxBilldt" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true,
		onSelect: function (dateText, inst) {
			 var today = $('#idTxBilldt').val();     // from user in dd-mm-yyyy
			 var part = today.split("-");
			 var day = part[0];
			 var month = part[1];
			 var year = part[2];
			 var nextYear = 1 * part[2] + 1;
			 var lastYear = part[2] - 1;
			 
			 
			 var userDt = new Date();                 // from user in dd-mm-yyyy and created in js fomat
			 //d.setDate(15); 
			 userDt.setMonth(part[1] - 1,part[0])
			 userDt.setFullYear(part[2]); 
			 //alert(userDt);
			 
			 var finYearStartDt = new Date();                 // current fin year start date created
			 //d.setDate(15); 
			 finYearStartDt.setMonth(3,1)
			 finYearStartDt.setFullYear(year); 
			 //alert(finYearStartDt);
			 
			 var finYearEndDt = new Date();                 // current fin year end date created
			 //d.setDate(15); 
			 finYearEndDt.setMonth(2,31)
			 finYearEndDt.setFullYear(nextYear); 
			 //alert(finYearEndDt);
			 
			 
			 var curMonth = part[1]; //get current month
			 //alert(curMonth);
			 var fiscalYr = "";
	
			 if (curMonth > 3) { //
			 var nextYr1 = (userDt.getFullYear() + 1).toString();
			 //fiscalYr = userDt.getFullYear().toString() + " - " + nextYr1.charAt(2) + nextYr1.charAt(3);
			 fiscalYr = userDt.getFullYear().toString() + " - " + (userDt.getFullYear() + 1).toString();
			 //alert(fiscalYr);
			 $('#idLbFinYear').html(fiscalYr);
			 }
			 else {
			 var nextYr2 = userDt.getFullYear().toString();
			 //fiscalYr = (userDt.getFullYear() - 1).toString() + " - " + nextYr2.charAt(2) + nextYr2.charAt(3);
			 fiscalYr = (userDt.getFullYear() - 1).toString() + " - " + userDt.getFullYear().toString();
			 //alert(fiscalYr);
			 $('#idLbFinYear').html(fiscalYr);
		   }
		}
		});
	});
	
	$(function() {
		$( "#idTxDeliveryDt" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	});
	
	$(function() {
		$( "#txIdPayDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	}); 
</script>
<script>
	
	$(function() {
		function log( message ) {
			$( "<div>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}
		
	$( "#idTxFrom" ).autocomplete({
			source: "getclient.php",
			minLength: 1,
			select: function( event, ui ) {
				
				if( ui.item )
				{
				//log( ui.item ?
//				"Selected: " + ui.item.value + " aka " + ui.item.id :
//				"Nothing selected, input was " + this.value );
				$("#idTxFromCid" ).val(ui.item.id);
					
					$("#idFromstatus" ).text("");
					
					
					$("#idTxFromInvNum" ).removeAttr('readonly');
					$("#idTxFromInvAmt" ).removeAttr('readonly');
					$("#idTxFromOctriNum" ).removeAttr('readonly');
					$("#idTxFromOctriAmt" ).removeAttr('readonly');
					$("#idTxFromGrnNum" ).removeAttr('readonly');
					
					
					$.ajax({
					type:"POST",
					url: "getClientDetailsSingleBill.php?cid="+ui.item.id,
					datatype: "json",
					data: "{}",
					contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
					data = JSON.parse(xhr.responseText);
                   // do something with data
                  // for (var i = 0, len = data.length; i < len; i++) {
//                       //
//					     $('#idTbListBills').append( '<tr>' +
//							'<td>'+data[i].bid+'</td>' +
//							'<td>'+data[i].manualbillnum+'</td>' +
//							'<td>'+data[i].paybyname+'</td>' +
//							'<td>'+data[i].gt+'</td>' +
//							'<td>'+data[i].payment+'</td>' +
//							'<td><a href="ViewBill.php?bid='+data[i].bid+'">View Bill</a></td>' +
//							'</tr>' );///end success
//					}
					var i = 0;
					var snamesplitFrom = data[i].sname;
					var snamesplitFrom = snamesplitFrom.split(" - ");
					$("#idTxFromShortName" ).val(snamesplitFrom[0]);
					$("#idTxFromLocation" ).removeAttr("Class");
					//$("#idTxFromLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp]] text-input");
					$("#idTxFromLocation" ).val(data[i].location);
					$("#idSeFromCountry" ).val(data[i].country);
					$("#idTxFromState" ).val(data[i].state);
					$("#idTxFromCity" ).val(data[i].city);
					$("#idTxFromPin" ).val(data[i].pin);
					$("#idTxFromEmail" ).val(data[i].emailid);
					$("#idTxFromCell" ).val(data[i].contact);
					$("#idTxFromAd1" ).val(data[i].al1);
					$("#idTxFromAd2" ).val(data[i].al2);
				}
            	});    // End Ajax
				
				
				$.ajax({
					type:"POST",
					url: "Get_Rate.php?from="+ui.item.value,
					datatype: "json",
					data: "{}",
					contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
					data = JSON.parse(xhr.responseText);
                   	// do something with data
					
					 	for (var i = 0, len = data.length; i < len; i++) {
						
						var rtcount = $('#idHfRateCount').val();
							
							if ( rtcount > 0 ) {
							
								for (s = 0; s < rtcount ; s ++) {
									$('#idHfRate'+s).remove();
								}
								$('#idHfRateCount').remove();
							}
							
						
 						$('body').append( '<input type="hidden" id="idHfRate'+i+'" value="'+data[i].locationfrom+'_'+data[i].locationto+'_'+data[i].tillkg+'_'+data[i].tillkgrate+'_'+data[i].abovetillkgrate+'" />' );
						 
						}
						$('body').append( '<input type="hidden" id="idHfRateCount" value="'+data.length+'" />' );
					} ///end success
            	});    // End Ajax
				
				
				}
				else
				{			
				}

			},
			response: function(event, ui) {
				// ui.content is the array that's about to be sent to the response callback.
				if (ui.content.length === 0) {
				  $("#idSePaybyCountry" ).removeAttr('readonly');
					$("#idTxFromCid" ).val("0");
					$("#idFromstatus" ).text("No Result Found");
					$("#idTxFromShortName" ).removeAttr('readonly');
					$("#idTxFromLocation" ).removeAttr("Class");
					//$("#idTxFromLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
					$("#idTxFromLocation" ).removeAttr('readonly');
					$("#idSeFromCountry" ).removeAttr('readonly');
					$("#idTxFromState" ).removeAttr('readonly');
					$("#idTxFromCity" ).removeAttr('readonly');
					$("#idTxFromPin" ).removeAttr('readonly');
					$("#idTxFromEmail" ).removeAttr('readonly');
					$("#idTxFromCell" ).removeAttr('readonly');
					$("#idTxFromAd1" ).removeAttr('readonly');
					$("#idTxFromAd2" ).removeAttr('readonly');
					
					$("#idTxFromInvNum" ).removeAttr('readonly');
					$("#idTxFromInvAmt" ).removeAttr('readonly');
					$("#idTxFromOctriNum" ).removeAttr('readonly');
					$("#idTxFromOctriAmt" ).removeAttr('readonly');
					$("#idTxFromGrnNum" ).removeAttr('readonly');
				} 
				else {
					//
				}
			},
			close: function( event, ui ) {
				if ( $("#idTxFromCid" ).val() == 0 ) {
					$("#idTxFromShortName" ).removeAttr('readonly');
					$("#idTxFromLocation" ).removeAttr("Class");
					//$("#idTxFromLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
					$("#idTxFromLocation" ).removeAttr('readonly');
					$("#idSeFromCountry" ).removeAttr('readonly');
					$("#idTxFromCity" ).removeAttr('readonly');
					$("#idTxFromState" ).removeAttr('readonly');
					$("#idTxFromPin" ).removeAttr('readonly');
					$("#idTxFromEmail" ).removeAttr('readonly');
					$("#idTxFromCell" ).removeAttr('readonly');
					$("#idTxFromAd1" ).removeAttr('readonly');
					$("#idTxFromAd2" ).removeAttr('readonly');
					
					$("#idTxFromInvNum" ).removeAttr('readonly');
					$("#idTxFromInvAmt" ).removeAttr('readonly');
					$("#idTxFromOctriNum" ).removeAttr('readonly');
					$("#idTxFromOctriAmt" ).removeAttr('readonly');
					$("#idTxFromGrnNum" ).removeAttr('readonly');
				}
			}
		});
	});
	
	
	

</script>

<script>
	
	$(function() {
		function log( message ) {
			$( "<div>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}
		
	$( "#idTxTo" ).autocomplete({
			source: "getclient.php",
			minLength: 1,
			change: function( event, ui ) {
		   		
			//	$("#idPaybyCid" ).val()= "";
			//	/$("#idPaybyCid" ).val("");
			//	document.getElementById("idCid").value = "";
			},
			select: function( event, ui ) {
				
				if( ui.item )
				{
				//log( ui.item ?
//				"Selected: " + ui.item.value + " aka " + ui.item.id :
//				"Nothing selected, input was " + this.value );
					$("#idTxToCid" ).val(ui.item.id);
					$("#idTostatus" ).text("");
					
					$.ajax({
					type:"POST",
					url: "getClientDetailsSingleBill.php?cid="+ui.item.id,
					datatype: "json",
					data: "{}",
					contentType: "application/json; charset=utf-8",
					success: function(data,textStatus,xhr) {
					data = JSON.parse(xhr.responseText);
                   // do something with data
                  // for (var i = 0, len = data.length; i < len; i++) {
//                       //
//					     $('#idTbListBills').append( '<tr>' +
//							'<td>'+data[i].bid+'</td>' +
//							'<td>'+data[i].manualbillnum+'</td>' +
//							'<td>'+data[i].paybyname+'</td>' +
//							'<td>'+data[i].gt+'</td>' +
//							'<td>'+data[i].payment+'</td>' +
//							'<td><a href="ViewBill.php?bid='+data[i].bid+'">View Bill</a></td>' +
//							'</tr>' );///end success
//					}
					var i = 0;
					var snamesplitTo = data[i].sname;
					var snamesplitTo = snamesplitTo.split(" - ");
					$("#idTxToShortName" ).val(snamesplitTo[0]);
					$("#idTxToLocation" ).removeAttr("Class");
					//$("#idTxToLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp]] text-input");
					$("#idTxToLocation" ).val(data[i].location);
					$("#idSeToCountry" ).val(data[i].country);
					$("#idTxToState" ).val(data[i].state);
					$("#idTxToCity" ).val(data[i].city);
					$("#idTxToPin" ).val(data[i].pin);
					$("#idTxToEmail" ).val(data[i].emailid);
					$("#idTxToCell" ).val(data[i].contact);
					$("#idTxToAd1" ).val(data[i].al1);
					$("#idTxToAd2" ).val(data[i].al2);
				}
            	});    // End Ajax
					
				}
				else
				{			
				}

			},
			response: function(event, ui) {
				// ui.content is the array that's about to be sent to the response callback.
				if (ui.content.length === 0) {
				  $("#idSePaybyCountry" ).removeAttr('readonly');
					$("#idTxToCid" ).val("0");
					$("#idTostatus" ).text("");
					$("#idTxToShortName" ).removeAttr('readonly');
					$("#idTxToLocation" ).removeAttr("Class");
					//$("#idTxToLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
					$("#idTxToLocation" ).removeAttr('readonly');
					$("#idSeToCountry" ).removeAttr('readonly');
					$("#idTxToState" ).removeAttr('readonly');
					$("#idTxToCity" ).removeAttr('readonly');
					$("#idTxToPin" ).removeAttr('readonly');
					$("#idTxToEmail" ).removeAttr('readonly');
					$("#idTxToCell" ).removeAttr('readonly');
					$("#idTxToAd1" ).removeAttr('readonly');
					$("#idTxToAd2" ).removeAttr('readonly');
				} 
				else {
					
				}
			},
			close: function( event, ui ) {
				if ( $("#idTxToCid" ).val() == 0 ) {
					$("#idTxToShortName" ).removeAttr('readonly');
					$("#idTxToLocation" ).removeAttr('readonly');
					$("#idTxToLocation" ).removeAttr("Class");
					//$("#idTxToLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
					$("#idSeToCountry" ).removeAttr('readonly');
					$("#idTxToState" ).removeAttr('readonly');
					$("#idTxToCity" ).removeAttr('readonly');
					$("#idTxToPin" ).removeAttr('readonly');
					$("#idTxToEmail" ).removeAttr('readonly');
					$("#idTxToCell" ).removeAttr('readonly');
					$("#idTxToAd1" ).removeAttr('readonly');
					$("#idTxToAd2" ).removeAttr('readonly');
				}
			}
		});
	});
	
	
//}); 

	

</script>

<script type="text/javascript">
function AddRow()
{
	//alert("SAM");
	
	//var valid=$("#idTxParti1").validationEngine('validate');
	//$('#formID1').validationEngine('hide');
    //alert(valid);
	
	var count = $('#idHiRowCount').val();
	count++;
    $('#tbParti').append( 	'<tr id="idTrParti'+ count +'">' +
							'<td><input type="text" class="validate[required] text-input"  name="txParti'+ count +'" id="idTxParti'+ count +'" /></td>' +
							'<td><input type="text" class="validate[required] text-input" name="txQty'+ count +'" id="idTxQty'+ count +'"  onkeyup="calc(this.id)" /></td>' +
							'<td><input type="text" class="validate[required] text-input" name="txWeight'+ count +'" id="idTxWeight'+ count +'"  onkeyup="calc(this.id)" /></td>' +
							'<td><input type="text" class="validate[required] text-input" name="txRate'+ count +'" id="idTxRate'+ count +'"  onkeyup="calc(this.id)"  /></td>' +
							'<td><input type="text" class="validate[required] text-input" name="txAmount'+ count +'" id="idTxAmount'+ count +'"/></td>' +
							'<td><a href="javascript:void(0);" id="idADelItem" onclick="DelRow(\'idTrParti'+count+'\')" >Delete Item</a></td>' +
							'</tr>' );
							$('#idHiRowCount').val(count);
							//id="' + nicknames[i] + '"
				}
				

function validatesname(ids) {
			var str = $('#'+ids).val();
			//alert ("sam");
			var str = $('#'+ids).val().toUpperCase();
			var trim = str.replace(/\s/g, '');
			$('#'+ids).val(trim);
	  		}
			
function chkcid() {
	 //return false;
	 //return "This is from Custom Validator";
	if ( $('#idTxPaybyCid').val() == 0 ) {
		//return "Customer Not Selected";
	 }
	 else {
		return true;
	 }
}	
			
function resetcid(e, ids, tid)
{
var TABKEY = 9;					
if (e.keyCode == TABKEY) { 
	
	}
	else {
	$('#'+ids).val(0);
	
	}

}
function filedrequired()
{
	if ( $('#idTxShortName').val() == 0 ) {
		
		return "Shortname and Location compulsory required";
	 }
	
}
function fromfiledrequired()
{
	if ( $('#idTxFromShortName').val() == 0 ) {
		
		return "Shortname and Location compulsory required";
	 }
	
}
function tofiledrequired()
{
	if ( $('#idTxToShortName').val() == 0 ) {
		
		return "Shortname and Location compulsory required";
	 }
	
}

function PaybyNameTrim()
{
	var val = $('#idTxPayby').val();
	var val = val.replace(/(^\s+|\s+$)/g, '');
	var val = val.replace(/\s{2,}/g,' ');
	var val = val.toUpperCase();	
	$('#idTxPayby').val(val);	
}
function fromNameTrim()
{
	var val = $('#idTxFrom').val();
	var val = val.replace(/(^\s+|\s+$)/g, '');
	var val = val.replace(/\s{2,}/g,' ');
	var val = val.toUpperCase();	
	$('#idTxFrom').val(val);
}
function toNameTrim()
{
	var val = $('#idTxTo').val();
	var val = val.replace(/(^\s+|\s+$)/g, '');
	var val = val.replace(/\s{2,}/g,' ');
	var val = val.toUpperCase();	
	$('#idTxTo').val(val);
}

function billDtReq() {
	if ( $('#idTxBilldt').val() == 0 || $('#idTxBilldt').val() == '' ) {
		return "* Bill date required. ";
	}
	else {
		 //get current date
		 
		 var today = $('#idTxBilldt').val();     // from user in dd-mm-yyyy
		 var part = today.split("-");
		 var day = part[0];
		 var month = part[1];
		 var year = part[2];
		 var nextYear = 1 * part[2] + 1;
		 var lastYear = part[2] - 1;
		 
		 
		 var userDt = new Date();                 // from user in dd-mm-yyyy and created in js fomat
		 //d.setDate(15); 
		 userDt.setMonth(part[1] - 1,part[0])
		 userDt.setFullYear(part[2]); 
		 //alert(userDt);
		 
		 var finYearStartDt = new Date();                 // current fin year start date created
		 //d.setDate(15); 
		 finYearStartDt.setMonth(3,1)
		 finYearStartDt.setFullYear(year); 
		 //alert(finYearStartDt);
		 
		 var finYearEndDt = new Date();                 // current fin year end date created
		 //d.setDate(15); 
		 finYearEndDt.setMonth(2,31)
		 finYearEndDt.setFullYear(nextYear); 
		 //alert(finYearEndDt);
		 
		 
		 var curMonth = part[1]; //get current month
		 //alert(curMonth);
		 var fiscalYr = "";

		 if (curMonth > 3) { //
		 var nextYr1 = (userDt.getFullYear() + 1).toString();
		 //fiscalYr = userDt.getFullYear().toString() + " - " + nextYr1.charAt(2) + nextYr1.charAt(3);
		 fiscalYr = userDt.getFullYear().toString() + " - " + (userDt.getFullYear() + 1).toString();
		 //alert(fiscalYr);
		 $('#idLbFinYear').html(fiscalYr);
		 }
		 else {
		 var nextYr2 = userDt.getFullYear().toString();
		 //fiscalYr = (userDt.getFullYear() - 1).toString() + " - " + nextYr2.charAt(2) + nextYr2.charAt(3);
		 fiscalYr = (userDt.getFullYear() - 1).toString() + " - " + userDt.getFullYear().toString();
		 //alert(fiscalYr);
		 $('#idLbFinYear').html(fiscalYr);
		 }
		 
		 
		 
		 
		 
		 
		 //if ( userDt >= finYearStartDt && userDt <= finYearEndDt ) {
//		 $('#idLbFinYear').text(Year + nextYear);
//		 alert("okk");
//		 }
//		 else {
//		 alert("ok");
//		 }
		 
	}
}


</script>

<script>
function DelRow(RowId) {
	$('#' + RowId ).remove();
	//$(this).closest("tr").remove();
}
</script>

<style type="text/css">
.cl2ndblock td {text-align:left;}
.cl7thblock td {text-align:left;}
.cl8thblock td {text-align:left;}
table { margin: 0 auto; }
th { text-align:center; font-weight:bold; border: solid 1px #000; background-color:#EEEEEE; line-height:30px;}
</style>



</head>
<body>

<form name="addtran" id="addtran" action="updateSingleBill.php" method="post"  enctype="multipart/form-data">


<input id="hfIdTillKg" type="hidden" />
<input id="hfIdTillKgRate" type="hidden" />
<input id="hfIdAboveTillKgRate" type="hidden" />

<div class="head1"> <span class="cname"> Purohit Transport Managment System </span> <a href="logout.php" class="logout" >Logout</a> </div>
<div class="header-wrapper">
	<div class="header">
		<h1> <?php  echo $_SESSION['companyname'];  ?></h1>
		<table class="menu">
		<tr>
        <td>
            <nav>
                <ul>
                	<li style=" width:50px;">&nbsp;</li>
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="#">Docket</a>
                        <ul>
                            <li><a href="MonthlyTranscation.php">Generate Docket</a></li>
                            <li><a href="SearchDocket.php">Search Docket</a></li>
                            <li><a href="UndeliveredDockets.php">Pending Delivery</a></li>
                            <li><a href="ListDockets.php">List Dockets</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Billing</a>
                        <ul>
                            <li><a href="SingleBill.php">Generate Single Bill</a></li>
                            <li><a href="MonthlyBill.php">Generate Monthly Bill</a></li>
                            <li><a href="SearchBill.php">Search Bill</a></li>
                            <li><a href="PendingPayments.php">Pending Payments</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Reports</a>
                        <ul>
                            <li><a href="Report_ServiceTax.php">Servcie Tax Report</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Accounts</a>
                    	<ul>
                            <li><a href="Accounts_NewTranscation.php">Add Transcation</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Master</a>
                    	<ul>
                            <li><a href="ClientMaster.php">Add Client Details</a></li>
                            <li><a href="ListClients.php">Edit Client Details</a></li>
                            <li><a href="List_Add_Rate.php">List/Add Rates</a></li>
                        </ul>
                    </li>
                    <li style=" width:50px;">&nbsp;</li>
                </ul>
            </nav>
        </td>
		</tr>
		</table>
	</div>
</div>



<div class="mid-wrapper">
	<div class="mid">
    	
        <div class="pagehead">
        <a href="#">EDIT SINGLE BILL</a>
        </div>
	        <br />
        <div class="cl2ndblock">
        		
                <input type="hidden" id="idHfDocNum" name="hfDocNum" value="0" />
                <input type="hidden" id="idHfBillNum" name="hfBillNum" value="0" />
        
        		<table class="clTbPayBy">
        		<tr>
                <td><span style="font-weight:bold;">Pay by</span></td>
                <td colspan="3"> 
                	<input type="text" name="txPayBy"  class="validate[required,funcCall[PaybyNameTrim],ajax[ajaxUserCallnameforSbill]] text-input" style="width:500px;"  onkeypress="resetcid(event,'idTxPaybyCid','idTxPayby')"  id="idTxPayby" /> <br />
                	<label id="idPaybystatus" style="color:#FF0000; font-size:12px;"></label>
                </td>
                </tr>
                <tr>
                <td>Cust Id</td>
                <td colspan="3"><input type="text" id="idTxPaybyCid" name="txPaybyCid"  readonly="readonly" class="validate[required] text-input" />  <input type="hidden" id="idHfManualDocNum" value="0" />
                </td>
                </tr>
                <tr>
                <td>Short name</td>
                <td>
                <input type="text" id="idTxShortName" name="txShortName" readonly="readonly" onkeydown="validatesname('idTxShortName')" class="validate[required,funcCall[filedrequired],groupRequired[payByShortName],custom[onlyLetterSp]] text-input"  /> 
                </td>
                <td>Location</td>
                <td> <input type="text" id="idTxLocation" name="txLocation" readonly="readonly" onkeydown="validatesname('idTxLocation')" class="validate[required,groupRequired[payByShortName],custom[onlyLetterSp]] text-input"  /> </td>
                </tr>
                <tr>
                <td>Country</td>
                <td>
                <select id="idSePaybyCountry"   name="sePaybyCountry">
                <option value="INDIA" selected="selected">India</option>
                </select>
                </td>
                <td>State</td>
                <td>
              	<input type="text" id="idTxState" name="txState" readonly="readonly"  />
                </td>
                </tr>
                <tr>
                <td>City</td>
                <td>
                <input type="text" id="idTxCity" name="txCity" readonly="readonly"  />
                </td>
                <td>Pin code</td>
                <td><input type="text" readonly="readonly" class="validate[custom[posotivenumber]]" id="idTxPaybyPin" name="txPaybyPin"/></td>
                </tr>
                <tr>
                <td>Email</td>
                <td><input type="text" readonly="readonly" class="validate[custom[email]]"  id="idTxPaybyEmail" name="txPaybyEmail"/></td>
                <td>Phone</td>
                <td><input type="text" readonly="readonly"  id="idTxPaybyCell" name="txPaybyCell"/></td>
                </tr>
                <tr>
                <td>Address Line 1</td>
                <td colspan="3"><input type="text" id="idTxPaybyAl1" readonly="readonly" style="width:500px;"  name="txPaybyAl1"/></td>
                </tr>
                <tr>
                <td>Address Line 2</td>
                <td colspan="3"><input type="text" id="idTxPaybyAl2" readonly="readonly" style="width:500px;"  name="txPaybyAl2"/></td>
                </tr>
                <tr><td colspan="4">&nbsp;</td></tr>
                 <tr>
                 <td>Docket Date</td>
                <td><input type="text" class="validate[required,groupRequired[docket]] text-input" readonly="readonly" id="idTxDocDt" name="txDocDt"></td>
                 <td>Manual Docket no.</td>
                <td><input type="text" name="txDocNum"
                class="validate[groupRequired[docket],custom[posotivenumber],ajax[ajxEditSBillDocNum]] text-input"  id="idTxDocNum"                 /></td>
                </tr>
               
                <tr>
                <td>Bill Date</td>
                <td><input type="text" class="validate[required] text-input"  readonly="readonly" id="idTxBilldt" name="txBilldt"/>
                </td>
                <td>Financial year</td>
                <td> <label id="idLbFinYear">&nbsp;</label> </td>
                <td></td>
                <td></td>
				</tr>
                <tr><td colspan="4">&nbsp;</td></tr>
                
                <tr>
                <td>From</td>
                <td colspan="3"> 
                <input type="text" name="txFrom" class="validate[required,funcCall[fromNameTrim],ajax[ajaxUserCallnameforSbill]] text-input" style="width:500px; " onkeypress="resetcid(event,'idTxFromCid','idTxFrom')"  id="idTxFrom"/> </td>
                <label id="idFromstatus"></label>
                </tr>
                </tr>
                <tr>
                <td>Cust Id</td>
                <td colspan="3"><input type="text" id="idTxFromCid" name="txFromCid" readonly="readonly" class="validate[required] text-input" /> </td>
                </tr>
                <tr>
                <td>Short name</td>
                <td> <input type="text" name="txFromShortName" id="idTxFromShortName" readonly="readonly" onkeydown="validatesname('idTxFromShortName')" class="validate[required,funcCall[fromfiledrequired],groupRequired[fromShortName],custom[onlyLetterSp]] text-input" /> </td>
                <td>Location</td>
                <td> <input type="text" name="txFromLocation" id="idTxFromLocation" readonly="readonly" onkeydown="validatesname('idTxFromLocation')"  class="validate[required,groupRequired[fromShortName],custom[onlyLetterSp]] text-input" /> </td>
                </tr>
                <tr>
                <td>Country</td>
                <td>
                <select name="seFromCountry" id="idSeFromCountry" readonly="readonly">
                <option value="INDIA" selected="selected">India</option>
                </select>
                </td>
                <td>State</td>
                <td>
                <input type="text" id="idTxFromState" name="txFromState" readonly="readonly" />
                </td>
                </tr>
                <tr>
                <td>City</td>
                <td>
				<input type="text" id="idTxFromCity" name="txFromCity" readonly="readonly" />
                </td>
                <td>Pin code</td>
                <td><input type="text"  id="idTxFromPin" name="txFromPin" readonly="readonly" /></td>
                </tr>
                <tr>
                <td>Email</td>
                <td><input type="text" id="idTxFromEmail"  name="txFromEmail"  readonly="readonly"/></td>
                <td>Phone</td>
                <td><input type="text" id="idTxFromCell" name="txFromCell" readonly="readonly"/></td>
                </tr>
                <tr>
                <td>Address Line 1</td>
                <td  colspan="3"><input type="text" style="width:500px;"  name="txFromAd1" id="idTxFromAd1" readonly="readonly" /></td>
                </tr>
                <tr>
                <td>Address Line 2</td>
                <td colspan="3"><input type="text" style="width:500px;"  name="txFromAd2" id="idTxFromAd2" readonly="readonly"  /></td>
                </tr>
                <tr><td colspan="4">&nbsp;</td></tr>
                <tr>
                <td>Invoice no.</td>
                <td><input type="text" name="txFromInvNum" id="idTxFromInvNum" /></td>
                <td>Invoice Amount</td>
                <td><input type="text" name="txFromInvAmt" id="idTxFromInvAmt" /></td>
                </tr>
                <tr>
                <td>Octri Reciept No.</td>
                <td><input type="text" name="txFromOctriNum" id="idTxFromOctriNum" /></td>
                <td>Octri Reciept Amt</td>
                <td><input type="text" name="txFromOctriAmt" id="idTxFromOctriAmt" /></td>
                </tr>
                <tr>
                <td>GRN No.</td>
                <td><input type="text" name="txFromGrnNum"  id="idTxFromGrnNum" /></td>
                </tr>
                
                <tr><td colspan="4">&nbsp;</td></tr>
                
                <tr>
                <td>To</td>
                <td colspan="3"><input type="text" name="txTo" id="idTxTo" class="validate[required,funcCall[toNameTrim],ajax[ajaxUserCallnameforSbill]] text-input" style="width:500px;" onkeypress="resetcid(event,'idTxToCid','idTxTo')"   /></td> &nbsp; <label id="idTostatus"></label>
                </tr>
                <tr>
                <td>Cust Id</td>
                <td colspan="3"><input type="text" name="txToCid" id="idTxToCid" readonly="readonly" class="validate[required] text-input" /> </td>
                </tr>
                <tr>
                <td>Short name</td>
                <td><input type="text" name="txToShortName" id="idTxToShortName" readonly="readonly" onkeydown="validatesname('idTxToShortName')" class="validate[required,funcCall[tofiledrequired],groupRequired[toShortName],custom[onlyLetterSp]] text-input" /> </td>
                <td>Location</td>
                <td> <input type="text" name="txToLocation" id="idTxToLocation" readonly="readonly"  onkeydown="validatesname('idTxToLocation')" class="validate[required,groupRequired[toShortName],custom[onlyLetterSp]] text-input" /> </td>
                </tr>
                <tr>
                <td>Country</td>
                <td>
                <select name="seToCountry" id="idSeToCountry"  readonly="readonly" >
                <option value="INDAI">India</option>
                </select>
                </td>
                <td>State</td>
                <td>
               	<input type="text" id="idTxToState" name="txTOState" readonly="readonly"   />
                </td>
                </tr>
                <tr>
                <td>City</td>
                <td>
                <input type="text" id="idTxToCity" name="txToCity" readonly="readonly"   />
                </td>
                <td>Pin code</td>
                <td><input type="text" name="txToPin" id="idTxToPin"  readonly="readonly" /></td>
                </tr>
                <tr>
                <td>Email</td>
                <td><input type="text" name="txToEmail" id="idTxToEmail"  readonly="readonly" /></td>
                <td>Phone</td>
                <td><input type="text" name="txToCell" id="idTxToCell" readonly="readonly" /></td>
                </tr>
                <tr>
                <td>Address Line 1</td>
                <td colspan="3"><input type="text" name="txToAd1" style="width:500px;"  id="idTxToAd1"  readonly="readonly" /></td>
                </tr>
                <tr>
                <td>Address Line 2</td>
                <td colspan="3"><input type="text"  name="txToAd2" style="width:500px;"  id="idTxToAd2"  readonly="readonly" /></td>
                </tr>
                
                </table>    
        </div>  <!--2nd block end-->
        
         <br />
    	
        <label style="font-weight:bold;">Rate On/Off</label>&nbsp;&nbsp;<input type="checkbox" checked="checked" id="chkIdRateOnOff" />
       
       <br />  <br />
    
       
       
        
         <div class="cl6stblock">
				<table style="" id="tbParti">
                <tr>
                <th>Particular</th>
                <th>Qty</th>
                <th>Weight</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
                </table>
                <br />
                <div style="text-align:right; margin-right:60px;">
                <label id="idLbAddItemStatus"></label>
                <a href="javascript:void(0);" id="idAAddItem" onclick="AddRow()" >Add Item</a>
                </div>
                
                <input type="hidden" name="hiRowCount" id="idHiRowCount" value="1"  />
		</div>    <!--cl6stblock end-->
        
         <br />
        
          <div class="cl7thblock">
				<table class="tblTot">
                <tr>
                <td>Total</td>
                <td><input type="text" name="txTot" id="txIdTot" /></td>
                </tr>
                <tr>
                <td>Servcie Tax &nbsp;<input type="text" name="txServcieTaxRate" value="12" style="font-size:10px; height:15px; width:50px;" id="idTxServcieTaxRate" onkeyup="calcbill()" /> % &nbsp;</td>
                <td><input type="text" name="txServcieTax" id="txIdServcieTax"/></td>
                </tr>
                <tr>
                <td>Edu Chess &nbsp;<input type="text" name="txEduChessRate" value="2" style="font-size:10px; height:15px; width:50px;" id="idTxEduChessRate" onkeyup="calcbill()" /> %  &nbsp;</td>
                <td><input type="text" name="txEduChess" id="txIdEduChess"/></td>
                </tr>
                <tr>
                <td>Higher Edu Chess &nbsp;<input type="text" name="txHighEduChessRate" value="1" style="font-size:10px; height:15px; width:50px;" id="idTxHighEduChessRate" onkeyup="calcbill()"  /> %  &nbsp;</td>
                <td><input type="text" name="txHighEduChess" id="txIdHighEduChess"/></td>
                </tr>
                <tr>
                <td>Labour Carges</td>
                <td><input type="text" name="txLaboutCharges" onkeyup="calcbill()" id="txIdLaboutCharges"/></td>
                </tr>
                <tr>
                <td>Waiting Charges</td>
                <td><input type="text" name="txWaitingCharges" onkeyup="calcbill()" id="txIdWaitingCharges"/></td>
                </tr>
                <tr>
                <td>Other Charges</td>
                <td><input type="text" name="txOtherCharges" onkeyup="calcbill()" id="txIdOtherCharges"/></td>
                </tr>
                <tr>
                <td>Pre Grand Total</td>
                <td><input type="text" name="txPreGT"  id="txIdPreGT"/></td>
                </tr>
                <tr>
                <td>Grand Total</td>
                <td><input type="text" name="txGT"  id="txIdGT"/></td>
                </tr>
                </table>
		</div>    <!--cl7thblock end-->
        <br />
        <div class="cl8thblock">
				<table class="tblDelivery">
                <tr>
                <td style="width:190px;">Delivery</td>
                <td>
                <select name="seDelivery" id="idSeDelivery" >
                <option value="YES">Yes</option>
                <option value="NO" selected="selected">No</option>
                </select>
                </td>
                </tr>
                <tr>
                <td>Delivery Date</td>
                <td><input type="text" name="txDeliveryDt" id="idTxDeliveryDt" /></td>
                </tr>
                <tr>
                <td>Recievers Name</td>
                <td><input type="text" name="txRecieverName" id="idTxRecieverName"/></td>
                </tr>
                <tr>
                <td>Recievers Contact Details</td>
                <td><input type="text" name="txRecieverDetail" id="idTxRecieverDetail" /></td>
                </tr>
                <tr>
                <td>Payment</td>
                <td>
                <select name="sePayment" id="idSePayment" class="validate[required] text-input" >
                <option value="PAID CASH">Paid Cash</option>
                <option value="PAID CHEQUE">Paid Cheque</option>
                <option value="NOT PAID" selected="selected">Not Paid</option>
                <option value="BAD DEBT">Bad Debt</option>
                </select>
                </td>
                </tr>
                <tr>
                <td>Payment Date</td>
                <td>
                <input type="text" name="txPayDate"  id="txIdPayDate"  readonly="readonly" />
                </td>
                </tr>
                <tr>
                <td>Bank Name</td>
                <td><input type="text" name="txBankName" id="idTxBankName"/></td>
                </tr>
                <tr>
                <td>Cheque no.</td>
                <td><input type="text" name="txChequeNum" id="idTxChequeNum" /></td>
                </tr>
                <tr>
                <td>Notice</td>
                <td><textarea name="taNotice" id="idTaNotice"></textarea></td>
                </tr>
                </table>
		</div>    <!--cl8thblock end-->
        
    		<br />
            
        <input type="submit" value="Submit"  />
        <br />
	</div>
</div>



	

		
<div id="footer">
	<p>Powered by iSAM IT</p>
</div>

</form>
</body>
</html>