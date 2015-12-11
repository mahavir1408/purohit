// JavaScript Document
$(document).ready(function () {
			
	var qs = $.url().param('bid');
	//$('#idHfBillNum').val(qs);
    var billno = 0;		
	var billdt = 0;
	var to = "";
	var subtotalhigh = 0;
	var parentname ="";
	var clientname ="";
	
	$.ajax({	// Get Monthly Bill Details Ajax
		type:"POST",
		url: "Get_ViewMonthlyBill.php?bid="+qs,
		datatype: "json",
		data: "{}",
		contentType: "application/json; charset=utf-8",
		success: function(data,textStatus,xhr) {
		   data = JSON.parse(xhr.responseText);
		   var i = 0;


			$.ajax({	// Get Parent Details Ajax	for heading
				type:"POST",
				url: "Get_ViewMonthlyBill_ParentDetails.php?cid="+data[i].pid,
				datatype: "json",
				data: "{}",
				async: false,
				contentType: "application/json; charset=utf-8",
				success: function(data,textStatus,xhr) {
					data = JSON.parse(xhr.responseText);
					var i = 0;
					$('#idTblBillFormat').append( '<tr><td colspan="10" class="clBillHead">' +
					'<div class="clDivCompanyName">'+data[i].name+' </div>' +
					'<div class="" style="font-weight:bold;">PUNE TO MUMBAI TO PUNE & GUJARAT DAILY CARGO & PARCEL SERVICES</div>' +
					'<div class="clDivCompanyAl1">'+data[i].al1+',</div> <div class="clDivCompanyAl2">'+data[i].al2+',</div>' +
					'<div class="clDivCompanyStateCityPin">'+data[i].state+" "+data[i].city+" "+data[i].pin+'</div>' +
					'<div class="clDivCompanyEmailandContact"> Email id - '+data[i].emailid+" Mobile-  "+data[i].contact+'</div>' +
					'</td></tr>' );
					parentname = data[i].name;
				}
				
			}); 	// End Get Parent Details Ajax	
			
			var year = data[i].finyear;
			var nextyear = 1 * data[i].finyear + 1 * 1;
			var finyear = year + ' - ' + nextyear;
			
			billno = data[i].manualbillnum+ ' / ' + finyear;
			billdt = data[i].date;
			to = data[i].paybyname;
			
			$('#idTblBillFormat').append( '<tr><td colspan="10" class="clTdPayByDetail">' +
			
			'<div class="clDivPayByDetails">' +
			'<div class="clDivPayByName">TO,<br/>'+data[i].paybyname+'</div>' +
			'<div class="clDivPayByAl1">'+data[i].al1+',</div> <div class="clDivPayByAl2">'+data[i].al2+',</div>' +
			'<div class="clDivPayByStateCityPin">'+data[i].state+" "+data[i].city+" "+data[i].pin+'.</div>' +
			'<div class="clDivPayByEmailandContact">Mobile- '+data[i].contact+'</div>' +
			'<div class="clDivPayByEmailandContact">Email id - '+data[i].emailid+'</div>' +
			'</div>' +
			
			'<div class="clDivPayByBillDtandBillNo"><div style="float:right; font-weight:normal;">Page 1 of  <span id="idSpPageNo"></span></div><br/> BILL NO.&nbsp;&nbsp;&nbsp;&nbsp;- '+data[i].manualbillnum+' / '+finyear+'<br/>BILL DATE - '+data[i].date+ 
			
			'</div>' +
								
			'</td></tr>' );
			
			$('#idTblBillFormat').append( '<tr class="clTrPartihead">' +						
					'<td style="line-height:20px; width:70px;">DATE</td>' +
					'<td style="width:35px;">ID</td>' +
					'<td style="width:40px;">D NO.</td>' +
					'<td style="width:90px;">FROM</td>' +
					'<td style="width:90px;">TO</td>' +
					'<td style="width:170px;">PARTICULAR</td>' +
					'<td>QTY</td>' +
					'<td>KG</td>' +
					'<td>RATE</td>' +
					'<td>AMOUNT</td>' +
					'</tr>' );
	
			$.ajax({ //  Docket List Ajax
                type:"POST",
                url: "Get_ViewMonthlyBill_DocketList.php?bid="+qs+"&clientname="+encodeURIComponent(to),
                datatype: "json",
				data: "{}",
				async: false,
                contentType: "application/json; charset=utf-8",
                success: function(data,textStatus,xhr) {
                	data = JSON.parse(xhr.responseText);  
					
					
					var totalrowcount = data.length;    // total no. of rows/ dockets fetch from database
					var mainpagerowtot = 39	// actual total main page rows if one page.
					var mainpagerows = 0; 
					
					if ( totalrowcount > mainpagerowtot  ) { // total main page rows are 36 if more than one page and 39 if only one
						mainpagerows = 36;	// set mail page rows if more than one page
					}
					else {
						mainpagerows = totalrowcount; // set mail page rows if less than one page
					}


					var restpagerowtot = 66;	// actual total rest page rows are 66 ap per page.
					var restpagerows = totalrowcount - mainpagerows;  // set no. of row left apart from main page
					var pages =  Math.ceil(restpagerows / restpagerowtot) + 1;  /// calc no of pages
					
					
					$("#idSpPageNo").text(pages);  // assing tot page no if 1 of 2 / 1 of 1
					
					var currentstoprow = 0;
					var previousrowstop = 0;
					
					for ( page=0; page<pages; page++) {
						
						
						if ( page == 0 ) {
							//alert(page);
							var subtot = 0;
							
							
							for ( var i = 0; i < mainpagerows; i++ ) {
								$('#idTblBillFormat').append( '<tr>' +						
								'<td style="">'+data[i].date+'</td>' +
								'<td>'+data[i].docId+'</td>' +
								'<td>'+data[i].manualdocketnum+'</td>' +
								'<td>'+data[i].from.slice(0,10)+'</td>' +
								'<td>'+data[i].to.slice(0,10)+'</td>' +
								'<td>'+data[i].particular.slice(0,20)+'</td>' +
								'<td>'+data[i].quantity+'</td>' +
								'<td>'+data[i].kg+'</td>' +
								'<td>'+data[i].rate+'</td>' +
								'<td style="text-align:right; padding-right:5px;">'+data[i].tot+'</td>' +
								'</tr>' );
								subtot = ( subtot * 1 ) + ( 1 * data[i].tot );
							}	// End For
							
							
							if ( totalrowcount < mainpagerowtot ) {
								
								var diff = mainpagerowtot - totalrowcount;
								
								for (i = 0; i < diff; i++) {
									$('#idTblBillFormat').append( '<tr>' +
									'<td colspan="10" style=" border:none;">&nbsp;</td>' +
									'</tr>' );
								} // end for
								
							}
							else {
								
								for (i =0; i < 1; i++ ) {
								$('#idTblBillFormat').append( '<tr style=" font-weight:bold;">' +
								'<td colspan="8">Page 1 Total</td>' +
								'<td colspan="2" style=" text-align:right; padding-right:5px;">'+subtot+'</td>' +
								'</tr>' +
								'<tr>' +
								'<td colspan="10" style=" border:none; line-height:30px; font-style:italic;"> Continued on next page...' +
								'</td>' +
								'</tr>' );
								}
								
							}  // End If
							
							subtotalhigh = subtotalhigh * 1 + 1 * subtot;
						}
						else {
							
							currentstoprow = mainpagerows + restpagerowtot * page;
							previousrowstop = currentstoprow - restpagerowtot;
							
							$('table:last').after( '<table id="idTblBillFormat'+page+'" class="clTblBillFormat">' +	
							'<tr>' +
							'<td colspan="10" style="font-weight:bold; padding-left:5px; padding-right:5px; line-height:20px;">' +
							'<span style="float:left;">To- '+to+'</span>' +
							'<span style="float:right; font-weight:normal;">Page - '+(page+1)+' of '+pages+'</span>' +
							'<br/>' +
							'<span style="float:left;">Bill no. - '+billno+' </span>' +
							'<span style="float:right;">Bill date - '+billdt+' </span>' +
							'</td>' +
							'</tr>' +
							'<tr  class="clTrPartihead">' +
							'<td style="line-height:20px; width:70px;">DATE</td>' +
							'<td style="width:35px;">ID</td>' +
							'<td style="width:40px;">D NO.</td>' +
							'<td style="width:90px;">FROM</td>' +
							'<td style="width:90px;">TO</td>' +
							'<td style="width:170px;">PARTICULAR</td>' +
							'<td>QTY</td>' +
							'<td>KG</td>' +
							'<td>RATE</td>' +
							'<td>AMOUNT</td>' +
							'</tr>' +
							'</table>' );
							//alert(currentpagerow);
							if ( currentstoprow > totalrowcount ) {
								currentstoprow = totalrowcount;
								var subtot = 0;
								for ( var j = previousrowstop; j < currentstoprow; j++ ) {
									$('#idTblBillFormat'+page).append( '<tr>' +						
									'<td>'+data[j].date+'</td>' +
									'<td>'+data[j].docId+'</td>' +
									'<td>'+data[j].manualdocketnum+'</td>' +
									'<td>'+data[j].from.slice(0,10)+'</td>' +
									'<td>'+data[j].to.slice(0,10)+'</td>' +
									'<td>'+data[j].particular.slice(0,20)+'</td>' +
									'<td>'+data[j].quantity+'</td>' +
									'<td>'+data[j].kg+'</td>' +
									'<td>'+data[j].rate+'</td>' +
									'<td style="text-align:right; padding-right:5px;">'+data[j].tot+'</td>' +
									'</tr>' );
									subtot = subtot * 1 + 1 * data[j].tot;	
								} 		// End For
								$('#idTblBillFormat'+page).append( '<tr style=" font-weight:bold;">' +	
								'<td colspan="8">Page '+(page+1)+' Total</td>' +
								'<td colspan="2" style=" text-align:right; padding-right:5px;">'+subtot+'</td>' +
								'</tr>' );
								subtotalhigh = subtotalhigh * 1 + 1 * subtot;
							}
							else {
								for ( var j = previousrowstop; j < currentstoprow; j++ ) {
									$('#idTblBillFormat'+page).append( '<tr>' +						
									'<td>'+data[i].date+'</td>' +
									'<td>'+data[i].docId+'</td>' +
									'<td>'+data[i].manualdocketnum+'</td>' +
									'<td>'+data[i].from.slice(0,10)+'</td>' +
									'<td>'+data[i].to.slice(0,10)+'</td>' +
									'<td>'+data[i].particular.slice(0,20)+'</td>' +
									'<td>'+data[i].quantity+'</td>' +
									'<td>'+data[i].kg+'</td>' +
									'<td>'+data[i].rate+'</td>' +
									'<td style="text-align:right; padding-right:5px;">'+data[i].tot+'</td>' +
									'</tr>' );
									subtot = subtot * 1 + 1 * data[j].tot;
								} 		// End For	
								$('#idTblBillFormat'+page).append( '<tr style=" font-weight:bold;">' +	
								'<td colspan="8">Page '+(page+1)+' Total</td>' +
								'<td colspan="2" style=" text-align:right; padding-right:5px;">'+subtot+'</td>' +
								'</tr>' );
								subtotalhigh = subtotalhigh * 1 + 1 * subtot;
							}
							
							
							
							
						} // End Else If
					} // End For
				} // End Success
            }); // End Docket List Ajax
					
		var setaxrate = data[i].setaxrate;
		var educhessrate = data[i].educhessrate;
		var heduchessrate = data[i].higheduchessrate;
		
		var setax = subtotalhigh * setaxrate / 100;
		//$('#txIdServcieTax').val(setax);
		
		var educhess = setax * educhessrate / 100;
		//$('#txIdEduChess').val(educhess);
		
		var heduchess = setax * heduchessrate / 100;
		//$('#txIdHighEduChess').val(heduchess);
		
		//var labourcharges = data[i].laborcharges;
//		var waiting  = data[i].waitingcharges;
//		var labourcharges = data[i].othercharges;
//		var labourcharges = data[i].gt;
//		
		//var gt = 1 * subtot + 1 * setax + 1 * educhess + 1 * heduchess + 1 * data[i].laborcharges + 1 * data[i].waitingcharges + 1 * data[i].othercharges;
		
		var gt = Math.round( 1 * subtotalhigh + 1 * setax + 1 * educhess + 1 * heduchess + 1 * data[i].laborcharges + 1 * data[i].waitingcharges + 1 * data[i].othercharges );
		//alert(heduchess);
		
		
		
		$('#idTblBillFormat').append( '<tr style="text-align:left;">' +						
			'<td colspan="5" rowspan="6" class="tbshowbill" style="text-align:left; vertical-align:top; padding-top:5px; padding-left:5px;"><span class="stshow">Service Tax Reg no. :- AGQPR7717PSD001</span><br/> <br/> Notice :- <br/> All Legal will be subject to Pune Jurisdiction. <br/>  Interest will be recovered @ 24% p. a. on overdue of unpaid bills.</td>' +
			'<td rowspan="6" valign="top" style=" text-align:center; padding-left:5px;"><br/><br/><br/><br/><br/>For&nbsp;'+parentname+'</td>' +
			'<td colspan="2"  style="text-align:left; padding-left:5px;">SubTotal</td>' +
			'<td colspan="2"  style="text-align:right; padding-right:5px;">'+subtotalhigh+'</td>' +
			'</tr>' +
			'<tr>' +
			'<td colspan="2"  style="text-align:left; padding-left:5px;">Service Tax</td>' +
			'<td colspan="2"  style="text-align:right; padding-right:5px;">'+setax.toFixed(2)+'</td>' +
			'</tr>' +
			'<tr>' +
			'<td colspan="2"  style="text-align:left; padding-left:5px;">Edu Chess</td>' +
			'<td colspan="2"  style="text-align:right; padding-right:5px;">'+educhess.toFixed(2)+'</td>' +
			'</tr>' +
			'<tr>' +
			'<td colspan="2" style="text-align:left; padding-left:5px;">High Edu Chess</td>' +
			'<td colspan="2" style="text-align:right; padding-right:5px;">'+heduchess.toFixed(2)+'</td>' +
			'</tr>' +
			'<tr>' +
			'<td colspan="2" style="text-align:left; padding-left:5px;">Labour Charges</td>' +
			'<td colspan="2" style="text-align:right; padding-right:5px;">'+data[i].laborcharges+'</td>' +
			'</tr>' +
			'<tr>' +
			'<td colspan="2" style="text-align:left; padding-left:5px;">Waiting Charges</td>' +
			'<td colspan="2" style="text-align:right; padding-right:5px;">'+data[i].waitingcharges+'</td>' +
			'</tr>' +
			'<tr>' +
			'<td rowspan="2" colspan="6" id="idwords" style="text-align:left; padding-left:5px;"><span style=" font-weight:bold;">In Words : -</span> Rupees'+test_skill(gt)+'&nbsp;Only</td>' +
			'<td colspan="2" style="text-align:left; padding-left:5px;">Other Charges</td>' +
			'<td colspan="2" style="text-align:right; padding-right:5px;">'+data[i].othercharges+'</td>' +
			'</tr>' +
			'<tr>' +
			'<td colspan="2" style="text-align:left; font-weight:bold; padding-left:5px;">Grand Total</td>' +
			'<td colspan="2" style="text-align:right; font-weight:bold; padding-right:5px;">'+gt+'</td>' +
			'</tr>' );

			
			if (data[i].pid != 2) {
				$(".tbshowbill").html("Notice :- <br/> All Legal will be subject to Pune Jurisdiction. <br/>  Interest will be recovered @ 24% p. a. on overdue of unpaid bills.");
			}
			
		}		
	}); // End Ajax	
	
	
	
	

}); // End Doc Ready	
