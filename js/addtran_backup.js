// JavaScript Document

$.fn.doesExist = function() {
	return jQuery(this).length > 0;
}
		
function calc(id)
{
	var ids = id;
	var value = $('#'+ids).val();
	var str = value;
	str = str.replace(/[^0-9]+/ig, "");
	str = str.replace(/^0+/, '');
	$('#'+ids).val(str);

	var rowid = ids;
	rowid = rowid.replace(/[^0-9]+/ig, ""); 	// get current row number
	
	var from = $('#idTxFrom').val();
	var to = $('#idTxTo').val();
	var ratecount = $('#idHfRateCount').val();
	
	var tillKg = "";
	var tillKgRate = "";
	var aboveTillKgRate = "";
	
	if ($("#chkIdRateOnOff").is(':checked')) { // chk if rate is turned on or off
		//alert("sam");
	}
	
	for ( i=0; i<ratecount; i++ ) {
		
		var strrate = $('#idHfRate'+i).val();
		var strrate = strrate.split("_");
		
		//alert(from); alert(to); alert(ratecount);

		if ( from == strrate[0] && to == strrate[1] ) {
			
			var tillKg = strrate[2];
			var tillKgRate = strrate[3];
			var aboveTillKgRate = strrate[4];
			
			//alert(tillKg); alert(tillKgRate); alert(aboveTillKgRate);
			
			if ( $('#idTxQty'+rowid).val() == 0 || $('#idTxQty'+rowid).val() == '' ) {
				$('#idTxQty'+rowid).val(0);
			}
			
			if ( $('#idTxWeight'+rowid).val() == 0 || $('#idTxWeight'+rowid).val() == '' ) {
				$('#idTxWeight'+rowid).val(0);
			}
			
			if ( $('#idTxRate'+rowid).val() == 0 || $('#idTxRate'+rowid).val() == '' ) {
				$('#idTxRate'+rowid).val(0);
			}
			
			var qty = $('#idTxQty'+rowid).val();
			var kg = $('#idTxWeight'+rowid).val();
			var rate = $('#idTxRate'+rowid).val();
			
			if ( kg == 0 ) { // some times they just want to put zero
				$('#idTxAmount'+rowid).val(0);
				//alert(qty); alert(kg); alert(rate);
			}
			else {
				if ( (kg*1) <= (tillKg*1) ) {
				//alert("true");
				$('#idTxRate'+rowid).val(tillKgRate);
				$('#idTxAmount'+rowid).val(tillKgRate);
				}
				else {
					$('#idTxRate'+rowid).val(aboveTillKgRate);
					$('#idTxAmount'+rowid).val(kg * aboveTillKgRate);
				}
			}
		
			//////////
			
		}
		else {
			// do something
			if ( $('#idTxQty'+rowid).val() == 0 || $('#idTxQty'+rowid).val() == '' ) {
				$('#idTxQty'+rowid).val(0);
			}
			
			if ( $('#idTxWeight'+rowid).val() == 0 || $('#idTxWeight'+rowid).val() == '' ) {
				$('#idTxWeight'+rowid).val(0);
			}
			
			if ( $('#idTxRate'+rowid).val() == 0 || $('#idTxRate'+rowid).val() == '' ) {
				$('#idTxRate'+rowid).val(0);
			}
			
			var qty = $('#idTxQty'+rowid).val();
			var kg = $('#idTxWeight'+rowid).val();
			var rate = $('#idTxRate'+rowid).val();
			
			// $('#idTxAmount'+rowid).val(kg * rate);
			

		}
		
	}
	

	
	
	var tot=0;
	count = $('#idHiRowCount').val();
	
	for ( i = 1; i <= count; i++ ) {
		
		if ( $('#idTxAmount'+i).doesExist() ) {
			var add = $('#idTxAmount'+i).val();
			tot = (1*tot + 1*add);
		}
		else { 
			 
		}

	}
	
	$('#txIdTot').val(tot);
	
	var setaxrate = $('#idTxServcieTaxRate').val();
	var educhessrate = $('#idTxEduChessRate').val();
	var heduchessrate = $('#idTxHighEduChessRate').val();
	
	
	var setax = tot * setaxrate / 100;
	$('#txIdServcieTax').val(setax);
	
	var educhess = setax * educhessrate / 100;
	$('#txIdEduChess').val(educhess);
	
	var heduchess = setax * heduchessrate / 100;
	$('#txIdHighEduChess').val(heduchess);


	if ( $('#txIdLaboutCharges').val() == '') {
		$('#txIdLaboutCharges').val(0);					
	}
	
	if ( $('#txIdWaitingCharges').val() == '') {
		$('#txIdWaitingCharges').val(0);					
	}
	if ( $('#txIdOtherCharges').val() == '') {
		$('#txIdOtherCharges').val(0);					
	}
	var labourcharge = $('#txIdLaboutCharges').val();
	var waitingcharge = $('#txIdWaitingCharges').val();	
	var othercharge = $('#txIdOtherCharges').val();	
	
	var Pregt = ( 1*tot + 1*setax + 1*educhess + 1*heduchess + 1*labourcharge + 1*waitingcharge + 1*othercharge );
	
	$('#txIdPreGT').val(Pregt);	
	
	var gt = Math.round(Pregt);
	$('#txIdGT').val(gt);
	

}  //END FUN CACL 

function calcbill()
{
	var tot = $('#txIdTot').val();
	
	var setaxrate = $('#idTxServcieTaxRate').val();
	var educhessrate = $('#idTxEduChessRate').val();
	var heduchessrate = $('#idTxHighEduChessRate').val();
	
	var setax = tot * setaxrate / 100;
	$('#txIdServcieTax').val(setax);
	
	var educhess = setax * educhessrate / 100;
	$('#txIdEduChess').val(educhess);
	
	var heduchess = setax * heduchessrate / 100;
	$('#txIdHighEduChess').val(heduchess);


	if ( $('#txIdLaboutCharges').val() == '') {
		$('#txIdLaboutCharges').val(0);					
	}
	
	if ( $('#txIdWaitingCharges').val() == '') {
		$('#txIdWaitingCharges').val(0);					
	}
	if ( $('#txIdOtherCharges').val() == '') {
		$('#txIdOtherCharges').val(0);					
	}
	var labourcharge = $('#txIdLaboutCharges').val();
	var waitingcharge = $('#txIdWaitingCharges').val();	
	var othercharge = $('#txIdOtherCharges').val();	
	
	var Pregt = ( 1*tot + 1*setax + 1*educhess + 1*heduchess + 1*labourcharge + 1*waitingcharge + 1*othercharge );
	
	$('#txIdPreGT').val(Pregt);	
	
	var gt = Math.round(Pregt);
	$('#txIdGT').val(gt);
} //END FUN CACL Bill







