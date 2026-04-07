/* Add here all your JS customizations */

//CREATE WAYBILL
$("#addpkgdetails").click(function(){
	var pkgcount = $("#no_of_packages").val();

	$.post('addPackageDetails',
		{ pkgcount : pkgcount }, 
		function(data){
			$("#packagedetails").html(data);
		}
	);
});


$("#packagedetails").on('change', '.ptype', function(){
	var packageno = $(this).attr('alt-pid');
	var ptypeval = $(this).val();

	$.post('viewPackageTypeContent',{ ptypeval:ptypeval }, function(data){
		if(data){
			var obj = JSON.parse(data);

			$("#p_length_"+packageno).val(obj.std_length);
			$("#p_width_"+packageno).val(obj.std_width);
			$("#p_height_"+packageno).val(obj.std_height);

			var computedvalue = (parseFloat(obj.std_length) * parseFloat(obj.std_width) * parseFloat(obj.std_height)) / 3500;

			$("#computed_val_"+packageno).val(computedvalue.toFixed(2));

			var totalcomputedval = 0;

			$('.compval').each(function(){
			    totalcomputedval += parseFloat(this.value);
			});

			$("#ship_computed_value").val(totalcomputedval.toFixed(2));
		}
	});
});

$("#packagedetails").on('change', 'input', function(){
	if(!$(this).hasClass('pweight')){
		var packageno = $(this).attr('alt-pid');

		var thislength = $("#p_length_"+packageno).val();
		var thiswidth = $("#p_width_"+packageno).val();
		var thisheight = $("#p_height_"+packageno).val();

		var computedvalue = (parseFloat(thislength) * parseFloat(thiswidth) * parseFloat(thisheight)) / 3500;

		$("#computed_val_"+packageno).val(computedvalue.toFixed(2));

		var totalcomputedval = 0;

		$('.compval').each(function(){
		    totalcomputedval += parseFloat(this.value);
		});

		$("#ship_computed_value").val(totalcomputedval.toFixed(2));
	} else {
		var totalactualweight = 0;

		$('.pweight').each(function(){
		    totalactualweight += parseFloat(this.value);
		});

		$("#ship_weight").val(totalactualweight.toFixed(2));
	}


});

$("#no_of_packages").change(function(){
	var pkgcount = $(this).val();

	$.post('addPackageDetails',
		{ pkgcount : pkgcount }, 
		function(data){
			$("#packagedetails").html(data);
		}
	);
});

$(".showcondetails").click(function(){
	var sonumber = $("#sonumber").val();
	var dbref = $(this).attr('loc-attr');

	$.post('consigneeDetails',
		{ 
			sonumber : sonumber,
			dbref : dbref
		},
		function(data){
			if(data == "error"){
				alert("Please enter a valid SO Number.");
			} else {
				var obj = JSON.parse(data);

				//DECLARATION of value from database to fields
				$("#companyname").val(obj.company_name);
				$("#street").val(obj.sa_street);
				$("#brgy").val(obj.sa_brgy);
				$("#city").val(obj.sa_city);
				$("#province").val(obj.sa_province);
				$("#zipcode").val(obj.sa_zipcode);
				$("#dr_no").val(obj.dr_no);
				$("#terms").val(obj.terms);
				if(obj.terms == "CHOD"){
					// BK-133504-000011
					if(!$(".ios-switch").hasClass('on')){
						$('#switchcollection').prev('.ios-switch').trigger('click');
					}
				} else {
					if($(".ios-switch").hasClass('on')){
						alert("d2")
						$('#switchcollection').prev('.ios-switch').trigger('click');
					}
				}
				var netval = obj.so_net;
				// $("#collectionval").val(Number(netval).toLocaleString('en'));
				$("#collectionval").val(netval);
			}
		}
	);
});

$("#switchcollection").change(function(){
	var thisval = $('#switchcollection').is(':checked');

	if(thisval){
		$("#collectionval").removeClass('hidden');
	} else {
		$("#collectionval").addClass('hidden');
	}
});

// VIEW/ SHOW Printout WAYBILL
$("#printbtn").click(function(){
	var sonumberwaybill = $("#sonumberwaybill").val();

	$.post('viewSODetails',
		{ entry:sonumberwaybill }, function(data){
			console.log(data)
			if(data == "missing"){
				alert("Waybill not yet created for this SO Number.");
			} else if(data == "othercourier"){
				alert("Waybill is created by other Courier.");
			} else {
				$("#sonumberwaybill").val('');
				var obj = JSON.parse(data);

				window.open("Uploads/Attachments/"+obj.so+"/waybill/"+obj.sowb+".pdf","_blank");
			}
		});
})