var newaddress= null;
var formis = null;
var clickedWas = null;
jQuery().ready(function (){

	    $('.btn').click(function() {
	          clickedWas = $(this).attr('name');
	    });
	 $('.form-stacked facility1').submit(function() {
		    if (clickedWas === "save_continue") {
		    	$('#submitButtons').hide();
		    	var res = checkAddress('facility1');
		    	return(res);
		    } else {
		    	return(true);
		    }
	  });
	 $('.form-stacked facility2').submit(function() {
		    if (clickedWas === "save_continue") {
		    	$('#submitButtons').hide();
		    	var res = checkAddress('facility2');
		    	return(res);
		    } else {
		    	return(true);
		    }


	  });
	 $("#dup-dialog").dialog({
			modal: true,
			autoOpen:false,
			height: 200,
			width: 300,
			buttons: {
				"Continue": function () {
					$(this).dialog("close");
					var form$ = $('#'+formis);
					useNewAddress();
					$('#js_processed').val(1);
					form$.append("<input type='hidden' name='jsSubmit' value='1'/>");
					form$.submit();
				},
				"Change address": function () {
					$(this).dialog("close");
				},
				"Exit": function () {
					window.location = "/app/applications/intro/"
				},

			}
		});
	 $("#dup-dialog1").dialog({
			modal: true,
			autoOpen:false,
			height: 200,
			width: 300,
			buttons: {
				"Change address": function () {
					$(this).dialog("close");
				},
				"Exit": function () {
					window.location = "/app/applications/intro/"
				},

			}
		});
	 $("#change-dialog").dialog({
			modal: true,
			autoOpen:false,
			height: 220,
			width: 400,
			buttons: {
				"Continue": function () {
					$(this).dialog("close");
					var form$ = $('#'+formis);
					useNewAddress();
					if (formis=="facility2") {
						$('#js_processed').val(1);
					}
					form$.append("<input type='hidden' name='jsSubmit' value='1'/>");
					form$.submit();
				},
				"Change address": function () {
					$(this).dialog("close");
				}
			}
		});
	 $("#zero-dialog").dialog({
			modal: true,
			autoOpen:false,
			height: 200,
			width: 300,
			buttons: {
				"Change address": function () {
					$(this).dialog("close");
				}
			}
		});
});

function useNewAddress() {
	var loc = null;
	if (newaddress.length==1) {
		loc = newaddress.shift();
	} else {
		loc = newaddress;
	}

	$('#street').val(loc.street);
	$('#apartment_suite').val(loc.apartment_suite);
	$('#city').val(loc.city);
	$('#county').val(loc.county);
	$('#zip').val(loc.zip);
	$('#state').val(loc.state);

}

function checkAddress (formid) {
	var street = $('#street').val();
	var apartment_suite = $('#apartment_suite').val();
	var city = $('#city').val();
	var county = $('#county').val();
	var zip = $('#zip').val();
	var state = $('#state option:selected').val();
	var facilities_id = $('#facilities_id').val();
	var validate_errors = false;
	var jsp = $('#js_processed').val();
	var res=false;
	formis = formid;

	if (jsp==="1") {
		return(true);
	}
	$('#js_processed').val(0); // Not processed if here
	if (street ==="") {
		validate_errors =true;
	}
	if (city ==="") {
		validate_errors =true;
	}
	if (county === "") {
		validate_errors =true;
	}
	if (zip==="") {
		validate_errors =true;
	}
	if (state ==="") {
		validate_errors =true;
	}

	if (!validate_errors) {
		$.ajax({
			type:'POST',
			async: false,
			url:"/app/facility/checkAddress",
			dataType:"json",
			data:{formid:formid, street:street, apartment_suite:apartment_suite, city:city, state:state, zip:zip, county:county, facilities_id: facilities_id}})
			.done( function(response,  status, jqXHR){
			//	alert(status);
				if(response.status != 'ok') {
					newaddress = response.newaddress;
					if (response.response == 'Address Change' || response.response == 'Incomplete Address') {
						//$("#change-table").html("Corrected address is: "+JSON.stringify(response.newaddress));
						var print_string = JSON.stringify(response.newaddress.street)+", Apartment/Suite "+JSON.stringify(response.newaddress.apartment_suite)+", "+JSON.stringify(response.newaddress.city)+", County of "+JSON.stringify(response.newaddress.county)+", "+JSON.stringify(response.newaddress.state)+" "+JSON.stringify(response.newaddress.zip);
						print_string = print_string.replace(/\"/g, "");
						//$("#change-table").html("Corrected address is: \n"+JSON.stringify(response.newaddress.street)+", Apartment/Suite "+JSON.stringify(response.newaddress.apartment_suite)+", "+JSON.stringify(response.newaddress.city)+", County of "+JSON.stringify(response.newaddress.county)+", "+JSON.stringify(response.newaddress.state)+" "+JSON.stringify(response.newaddress.zip));
						$("#change-table").html(print_string);
						$("#change-dialog").dialog("open");
					} else if (response.response == 'Duplicate Address') {
						var dups = response.newaddress;
						if (dups.length == 1) {
							var op = "";
							$.each(dups, function() {
								op = this.facility_name+'('+this.registry_id_number+')('+this.facilities_id+')';
							});
							$("#dup-table").html("Duplicate address is: "+op);
							$("#dup-dialog").dialog("open");
						} else {
							var op = "";
							$.each(dups, function() {
								op += "";
								op +='<br /><a href="/app/facility/facility_1/'+this.facilities_id+'/application"> Click here to use '+this.facility_name+'('+this.registry_id_number+')('+this.facilities_id+')</a>';
							});
							$("#dup-table1").html("Duplicate address chose from: "+op);
							$("#dup-dialog1").dialog("open");
						}


					}	else if (response.response == 'ZERO_RESULTS') {
						$("#zero-table").html("Google Doesn't understand that address: "+JSON.stringify(response.address));
						$("#zero-dialog").dialog("open");
					}

				} else {
					var form$ = $("#"+formid);
					form$.append("<input type='hidden' name='jsSubmit' value='1'/>");
					$('#js_processed').val(1);
					res = true;

				} })
			.fail ( function (xhr, status, errorThrown) {
				alert("Communication failure");
			});

	} else {
		res=true; // Process even with bad data
	}
	return(res);
}