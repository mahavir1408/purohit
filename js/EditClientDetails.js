$(document).ready(function () {
							
	var qs = $.url().param('cid');
	
	$.ajax({
	type:"GET",
	url: "Get_ClientDetails.php?cid="+qs,
	datatype: "json",
	data: "{}",
	contentType: "application/json; charset=utf-8",
	success: function(data,textStatus,xhr) {
		data = JSON.parse(xhr.responseText);
		   // do something with data
		   	var i = 0;
			var snamesplit = data[i].sname;
			var snamesplit = snamesplit.split(" - ");
				   $('#hfIdSname').val(data[i].sname);	
                   $('#idTxPaybyCid').val(data[i].cid);	
				   $('#idTxPayby').val(data[i].name);
				   $('#hfClientName').val(data[i].name);
				   $('#idTxShortName').val(snamesplit[0]);
				   $('#idTxLocation').val(snamesplit[1]);
				   $('#idTxState').val(data[i].state);
				   $('#idTxCity').val(data[i].city);
				   $('#idTxPaybyPin').val(data[i].pin);
				   $('#idTxPaybyAl1').val(data[i].al1);
				   $('#idTxPaybyAl2').val(data[i].al2);
				   $('#idTxPaybyCell').val(data[i].contact);
				   $('#idTxPaybyEmail').val(data[i].emailid);
				   $('#idTxMonthlyRate').val(data[i].monthlyrate);
				   $('#idTxTillKg').val(data[i].tillkg);
				   $('#idTxTillKgRate').val(data[i].tillkgrate);
				   $('#idTxAboveTillKgRae').val(data[i].kgRateabovetillkg);
			
		}
    }); // End Ajax
	
	
	
});