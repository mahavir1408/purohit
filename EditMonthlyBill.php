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
	/*include("config.inc");
	$sql="Select Role, Company_Name from login where Login_Id='$login_id'";
	$result = mysql_query($sql);  
	while($row=mysql_fetch_array($result))  
	{  
		$role = $row['Role'];
		$company_name = $row['Company_Name'];
	} */ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/reset-fonts-grids.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />



<!--<script language="javascript" src="js/jquery-1.8.2.min.js" type="text/javascript" ></script>-->

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
<script language="javascript" src="js/EditMonthlyBill.js" type="text/javascript" ></script>

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
				$("#idTxShortName" ).attr('readonly','readonly');
				$("#idTxLocation" ).attr('readonly','readonly');
				$("#idSePaybyCountry" ).attr('readonly','readonly');
				$("#idTxState" ).attr('readonly','readonly');
				$("#idTxCity" ).attr('readonly','readonly');
				$("#idTxPaybyPin" ).attr('readonly','readonly');
				$("#idTxPaybyEmail" ).attr('readonly','readonly');
				$("#idTxPaybyCell" ).attr('readonly','readonly');
				$("#idTxPaybyAl1" ).attr('readonly','readonly');
				$("#idTxPaybyAl2" ).attr('readonly','readonly');
				
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
					$("#idTxLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp]] text-input");
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
					$("#idTxLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
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
					$("#idTxLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
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
		$( "#idTxFromDt" ).datepicker({
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
	
	$(function() {
		$( "#idTxToDt" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
//		onSelect: function (dateText, inst) {
		//$(this).parent('form').submit();
		//alert(dateText);
		//var frmDt = $('#idTxFromDt').val();
//		var paybyId = $('#idTxPaybyCid').val();
//		//alert(frmDt);
//		$.ajax({
//                type:"POST",
//                url: "getBillAmtForMbill.php?from="+frmDt+"&"+"to="+dateText+"&payby="+paybyId,
//                datatype: "json",
//				data: "{}",
//                contentType: "application/json; charset=utf-8",
//                success: function(data,textStatus,xhr) {
//                   data = JSON.parse(xhr.responseText);
//                   // do something with data
//                    for (var i = 0, len = data.length; i < len; i++) {
//						$('#txIdTot').val(data[0].amount);
//					}
//					calcbill();
//				}
//            	});    // End Ajax
		
//		} // END ON SELECT
		});
	});
	
	$(function() {
		$( "#idTxBillDt" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy" ,
		showButtonPanel: true
		});
	});
	
	function flushtxtval()
	{
		//alert("sam");
		//$("#idCid" ).val()= "";
		//$("#idCid" ).val("");
		
	}
	//$('#idTxPayby').('keydown', function(e) { 
//	  var keyCode = e.keyCode || e.which; 
//	  
//	  if (keyCode == 9) { 
//		e.preventDefault(); 
//		// call custom function here
//	  } 
//	  else {
//	  document.getElementById("idPaybyCid").value = "";
//		$("#idPaybystatus" ).text("");
//		
//	  }
//	});
	
	$('#aIdAddItem').click(function() {
			alert("SAM");
       	//	$('#tbparti tbody').append('<tr class="child"><td colspan="4">blahblah</td></tr>');
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
					$("#idTxFromShortName" ).attr('readonly','readonly');
					$("#idTxFromLocation" ).attr('readonly','readonly');
					$("#idSeFromCountry" ).attr('readonly','readonly');
					$("#idTxFromState" ).attr('readonly','readonly');
					$("#idTxFromCity" ).attr('readonly','readonly');
					$("#idTxFromPin" ).attr('readonly','readonly');
					$("#idTxFromEmail" ).attr('readonly','readonly');
					$("#idTxFromCell" ).attr('readonly','readonly');
					$("#idTxFromAd1" ).attr('readonly','readonly');
					$("#idTxFromAd2" ).attr('readonly','readonly');
					
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
$("#idTxFromLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp]] text-input");
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
$("#idTxFromLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
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
$("#idTxFromLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
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
					$("#idTxToShortName" ).attr('readonly','readonly');
					$("#idTxToLocation" ).attr('readonly','readonly');
					$("#idSeToCountry" ).attr('readonly','readonly');
					$("#idTxToState" ).attr('readonly','readonly');
					$("#idTxToCity" ).attr('readonly','readonly');
					$("#idTxToPin" ).attr('readonly','readonly');
					$("#idTxToEmail" ).attr('readonly','readonly');
					$("#idTxToCell" ).attr('readonly','readonly');
					$("#idTxToAd1" ).attr('readonly','readonly');
					$("#idTxToAd2" ).attr('readonly','readonly');
					
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
$("#idTxToLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp]] text-input");
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
$("#idTxToLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
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
$("#idTxToLocation" ).attr("class","validate[required,groupRequired[payByShortName],custom[onlyLetterSp],ajax[ajaxUserCallsnames]] text-input");
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

function caltot() {
		var selTot = 0;
		//alert("sam");
		var	chkCount = $('#idHfDocketCount').val(); 
		for ( j = 1 ; j <= chkCount; j++) {		
			if ($('#idCkSelect'+j).is(':checked')) {
				selTot = 1 * selTot + 1 * $('#idTdTot'+j).text();
			}
		}
		var finalTot = selTot;
		
		if ( finalTot != 0 ) {
		$('#txIdTot').val(selTot);
		calcbill();
		}
		else {
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

</script>


<style type="text/css">
.cl2ndblock td {text-align:left;}

table { margin: 0 auto; }
th{ text-align:center; font-weight:bold; border: solid 1px #000;}

.clTbPayBy
{
text-align:left;
}
 
.clTbPayBy input
{
width:210px;
}
.tblTot
{
text-align:left;
}

.ui-autocomplete-loading { background:url('images/loading.gif') no-repeat right center;  }

.bgoverlay {
    position:fixed;
	z-index:2000;
    left:0;
    top:0;
    background: rgba(0,0,0,.5);
    width: 100%;
    height: 100%;
	line-height:100%;
}

</style>

</head>
<body>

<div class="bgoverlay"><span style="padding:10px 5px; display:block; background:#FFFFFF;">Loading&nbsp;<img src="images/loading.gif" /></span></div>

<form name="updateMonthlyBill" id="updateMonthlyBill" action="updateMonthlyBill.php" method="post"  enctype="multipart/form-data">

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
            <a href="#">Edit Monthly Bill</a>
            </div>
            <br />
            
            <table class="clTbPayBy">
            <tr>
            <td>Bill Date</td>
            <td colspan="3">
            <input type="text" readonly="readonly" class="validate[required]" name="txBillDt" id="idTxBillDt" style="width:200px;"/>
            </td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr>
            <tr>
            <td><span style="font-weight:bold;">Pay by</span></td>
            <td colspan="3"> 
            <input type="text" name="txPayBy"  class="validate[required,funcCall[PaybyNameTrim],ajax[ajaxUserCallnameforSbill]] text-input" style="width:550px;"  onkeypress="resetcid(event,'idTxPaybyCid','idTxPayby')"  id="idTxPayby" /> <br />
            <label id="idPaybystatus" style="color:#FF0000; font-size:12px;"></label>
            </td>
            </tr>
            <tr>
            <td>Cust Id</td>
            <td colspan="3"><input type="text" id="idTxPaybyCid" name="txPaybyCid"  readonly="readonly" class="validate[required] text-input" /> 
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
            <select id="idSePaybyCountry"   name="sePaybyCountry" style="width:210px;">
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
            <td><input type="text" readonly="readonly" id="idTxPaybyPin" name="txPaybyPin"/></td>
            </tr>
            <tr>
            <td>Email</td>
            <td><input type="text" readonly="readonly" class="validate[custom[email]]"  id="idTxPaybyEmail" name="txPaybyEmail"/></td>
            <td>Phone</td>
            <td><input type="text" readonly="readonly"  id="idTxPaybyCell" name="txPaybyCell"/></td>
            </tr>
            <tr>
            <td>Address Line 1</td>
            <td colspan="3"><input type="text" id="idTxPaybyAl1" readonly="readonly" style="width:550px;"  name="txPaybyAl1"/></td>
            </tr>
            <tr>
            <td>Address Line 2</td>
            <td colspan="3"><input type="text" id="idTxPaybyAl2" readonly="readonly" style="width:550px;"  name="txPaybyAl2"/></td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr>
            
            
            <tr>
            <td>Docket From Date</td>
            <td><input type="text" readonly="readonly" class="validate[required]" name="txFromDt" id="idTxFromDt" style="width:200px;"/></td>
            <td>Docket To Date</td>
            <td>
            <input type="text" readonly="readonly" class="validate[required]" name="txToDt" id="idTxToDt" style="width:200px;"/></td>
            </tr>
            
			<tr><td colspan="4">&nbsp;</td></tr>
            <tr><td colspan="4">
            
            <div style="line-height:50px; text-align:center; font-weight:bold;" id="nodoc" class="ui-state-error"></div>
            <br />
            
            <table id="idTbDocketList">
            <tr>
            <th style="width:20px; text-align:left; margin-right:10px;"> 
          	<input name="ckSelectAll" type="checkbox" id="idCkSelectAll" style="margin:0 !important; display: block; text-align:left; padding:0px; width:50px; " dir="ltr" value="0" />
            </th>
            <th>Docket Id</th>
            <th>Docket Num</th>
            <th>Date</th>
            <th>Payby</th>
            <th>Amount</th>
            </tr>
            </table>
            
            <input type="hidden" id="idHfDocketCount" name="hfDocketCount" value="0" />
            <input type="hidden" id="idHfBillNum" name="hfBillNum" value="0" />
            
            </td></tr>
            <tr><td colspan="4">&nbsp;</td></tr>
                        
            	<tr>
                <td>Total</td>
                <td colspan="3"><input type="text" name="txTot" id="txIdTot" readonly="readonly" class="validate[required]" /></td>
                </tr>
                <tr>
                <td>Servcie Tax &nbsp;<input type="text" name="txServcieTaxRate" value="12" style="font-size:10px; height:15px; width:50px;" id="idTxServcieTaxRate" onkeyup="calcbill()" /> % &nbsp;</td>
                <td colspan="3"><input type="text" name="txServcieTax" id="txIdServcieTax" readonly="readonly" class="validate[required]" /></td>
                </tr>
                <tr>
                <td>Edu Chess &nbsp;<input type="text" name="txEduChessRate" value="2" style="font-size:10px; height:15px; width:50px;" id="idTxEduChessRate" onkeyup="calcbill()" /> %  &nbsp;</td>
                <td colspan="3"><input type="text" name="txEduChess" id="txIdEduChess" readonly="readonly" class="validate[required]" /></td>
                </tr>
                <tr>
                <td>Higher Edu Chess &nbsp;<input type="text" name="txHighEduChessRate" value="1" style="font-size:10px; height:15px; width:50px;" id="idTxHighEduChessRate" onkeyup="calcbill()"  /> %  &nbsp;</td>
                <td colspan="3"><input type="text" name="txHighEduChess" readonly="readonly" class="validate[required]" id="txIdHighEduChess"/></td>
                </tr>
                <tr>
                <td>Labour Carges</td>
                <td colspan="3"><input type="text" name="txLaboutCharges" onkeyup="calcbill()" id="txIdLaboutCharges" class="validate[required]" /></td>
                </tr>
                <tr>
                <td>Waiting Charges</td>
                <td colspan="3"><input type="text" name="txWaitingCharges" onkeyup="calcbill()" id="txIdWaitingCharges" class="validate[required]"  /></td>
                </tr>
                <tr>
                <td>Other Charges</td>
                <td colspan="3"><input type="text" name="txOtherCharges" onkeyup="calcbill()" id="txIdOtherCharges" class="validate[required]"  /></td>
                </tr>
                <tr>
                <td>Pre Grand Total</td>
                <td colspan="3"><input type="text" name="txPreGT"  id="txIdPreGT" class="validate[required]" readonly="readonly" /></td>
                </tr>
                <tr>
                <td>Grand Total</td>
                <td colspan="3"><input type="text" name="txGT"  id="txIdGT" readonly="readonly" class="validate[required]"  /></td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
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
                <td><input type="text" name="txBankName"/></td>
                </tr>
                <tr>
                <td>Cheque no.</td>
                <td><input type="text" name="txChequeNum"/></td>
                </tr>
                
                <tr>
                <td>&nbsp;</td>
                <td colspan="3" style="text-align:right;">&nbsp;<input type="submit" value="Generate Bill" /></td>
                </tr>
            	</table>
            	
                <br />
               
            
        
	</div>
</div>



	

		
<div id="footer">
	<p>Powered by iSAM IT</p>
</div>

</form>
</body>
</html>