(function() {

	'use strict';

	// basic
	$("#form").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		},
        submitHandler: function(form) {
        	//SHOW LOADING ICON
			$(".loading").removeClass('hidden');

            $.post('execCreateWaybill', $('#form').serialize(),
            	function(data){

            		var IS_JSON = true;
					try
					{
						var obj = $.parseJSON(data);
					}
					catch(err)
					{
						IS_JSON = false;
					} 

            		// var obj = JSON.parse(data);

        			$.post('execSaveLogs',
        				{
        					so_number : $("#sonumber").val(),
        					status : data
        				}, function(output){
        					if(output){
	        					if(obj){
									if(obj.status == "success"){
										$(".loading").addClass('hidden');
										// TESTING PHASE
										$("#sonumber").val('');
										// PROD PHASE
										$("input").val('');
										$("#collectionval").text('');
										$("#packagedetails").html('');

										window.open("shipmentPrintout","_blank");
									} else {
										alert(obj.message);
										$(".loading").addClass('hidden');
									}
			            		} else {
			            			alert("ERROR on fields submitted. Please ask the administrator on this error.");
									$(".loading").addClass('hidden');
			            		}
        					}
        				}
        			);
            		
            	}
            );
        }
	});

	// validation summary
	var $summaryForm = $("#summary-form");
	$summaryForm.validate({
		errorContainer: $summaryForm.find( 'div.validation-message' ),
		errorLabelContainer: $summaryForm.find( 'div.validation-message ul' ),
		wrapper: "li"
	});

	// checkbox, radio and selects
	$("#chk-radios-form, #selects-form").each(function() {
		$(this).validate({
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error');
			}
		});
	});

}).apply( this, [ jQuery ]);