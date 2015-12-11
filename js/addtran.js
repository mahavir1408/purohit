$.fn.doesExist = function() {
	return jQuery(this).length > 0;
};

function calc(id)
{	
	//alert("START");
	var ids = id;
	var value = $('#'+ids).val();
	var str = value;
	str = str.replace(/[^0-9]+/ig, "");
	str = str.replace(/^0+/, '');
	$('#'+ids).val(str);

	var rowid = ids;
	rowid = rowid.replace(/[^0-9]+/ig, ""); 	// get current row number
	
	var from = $('#idTxFromCid').val();
	var to = $('#idTxToCid').val();
	var ratecount = $('#idHfRateCount').val();
	
	//alert("TEST");
	
	var tillKg = "";
	var tillKgRate = "";
	var aboveTillKgRate = "";
	
	//alert("TEST");
	
	var qty = "";
	var kg = "";
	var rate = "";
	
	if ($("#chkIdRateOnOff").is(':checked')) {// chk if rate is turned on or off
		
		for (i=0; i<ratecount; i++) {
			
			var strrate = $('#idHfRate'+i).val();
			var strrate = strrate.split("_");
			
			//alert(from);

			if (from === strrate[0] && to === strrate[1]) {
				
				tillKg = strrate[2];
				tillKgRate = strrate[3];
				aboveTillKgRate = strrate[4];
						
				if ( $('#idTxQty'+rowid).val() == 0 || $('#idTxQty'+rowid).val() == '' ) {
					$('#idTxQty'+rowid).val(0);
				}
				
				if ( $('#idTxWeight'+rowid).val() == 0 || $('#idTxWeight'+rowid).val() == '' ) {
					$('#idTxWeight'+rowid).val(0);
				}
				
				if ( $('#idTxRate'+rowid).val() == 0 || $('#idTxRate'+rowid).val() ==='' ) {
					$('#idTxRate'+rowid).val(0);
				}
			
				qty = $('#idTxQty'+rowid).val();
				kg = $('#idTxWeight'+rowid).val();
				rate = $('#idTxRate'+rowid).val();
				
				
			
				if ( kg == 0 ) {	// some times they just want to put zero
					$('#idTxAmount'+rowid).val(0);
					$('#idTxWeight'+rowid).val(0);
					$('#idTxRate'+rowid).val(0);
				}
				else {
															
					if ( (kg*1) <= (tillKg*1) ) {
						
						$('#idTxRate'+rowid).val(tillKgRate);
						$('#idTxAmount'+rowid).val(tillKgRate);
						break;
					}
					else {
						
						$('#idTxRate'+rowid).val(aboveTillKgRate);
						$('#idTxAmount'+rowid).val(kg * aboveTillKgRate);
						break;
					
					}	// (kg*1) <= (tillKg*1)
					
				}	// kg === 0 
			
			}
			else {
				
				if ( $('#idTxQty'+rowid).val() == 0 || $('#idTxQty'+rowid).val() == '' ) {
					$('#idTxQty'+rowid).val(0);
				}
				
				if ( $('#idTxWeight'+rowid).val() == 0 || $('#idTxWeight'+rowid).val() == '' ) {
					$('#idTxWeight'+rowid).val(0);
				}
				
				if ( $('#idTxRate'+rowid).val() == 0 || $('#idTxRate'+rowid).val() == '' ) {
					$('#idTxRate'+rowid).val(0);
				}
			
				qty = $('#idTxQty'+rowid).val();
				kg = $('#idTxWeight'+rowid).val();
				rate = $('#idTxRate'+rowid).val();
				
				//if (from != strrate[0] && to != strrate[1]) {
//					alert("TEST");
				$('#idTxAmount'+rowid).val(kg * rate);
					
				//}
				
				
			}	// End from === strrate[0] && to == strrate[1]
		
		} // End For
	

	}
	else {
		
		if ( $('#idTxQty'+rowid).val() == 0 || $('#idTxQty'+rowid).val() == '' ) {
			$('#idTxQty'+rowid).val(0);
		}
		
		if ( $('#idTxWeight'+rowid).val() == 0 || $('#idTxWeight'+rowid).val() == '' ) {
			$('#idTxWeight'+rowid).val(0);
		}
		
		if ( $('#idTxRate'+rowid).val() == 0 || $('#idTxRate'+rowid).val() == '' ) {
			$('#idTxRate'+rowid).val(0);
		}
	
		qty = $('#idTxQty'+rowid).val();
		kg = $('#idTxWeight'+rowid).val();
		rate = $('#idTxRate'+rowid).val();
	
		$('#idTxAmount'+rowid).val(kg * rate);
		
		
	}	// end is checked off 
	
	var tot=0;
	count = $('#idHiRowCount').val();
	
	for ( i = 1; i <= count; i++ ) {
		
		if ( $('#idTxAmount'+i).doesExist() ) {
			var add = $('#idTxAmount'+i).val();
			tot = (1*tot + 1*add);
		}
		else {
			// Do Some thing
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


	if ( $('#txIdLaboutCharges').val() === '') {
		$('#txIdLaboutCharges').val(0);					
	}
	
	if ( $('#txIdWaitingCharges').val() === '') {
		$('#txIdWaitingCharges').val(0);					
	}
	if ( $('#txIdOtherCharges').val() === '') {
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


	if ( $('#txIdLaboutCharges').val() === '') {
		$('#txIdLaboutCharges').val(0);					
	}
	
	if ( $('#txIdWaitingCharges').val() === '') {
		$('#txIdWaitingCharges').val(0);					
	}
	if ( $('#txIdOtherCharges').val() === '') {
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







