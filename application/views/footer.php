
			</div>

		</section>

		<!-- Vendor -->
		<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Specific Page Vendor -->
        <script src="<?= base_url(); ?>assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/select2/select2.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/pnotify/pnotify.custom.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/jquery-validation/jquery.validate.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/flot/jquery.flot.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/raphael/raphael.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/morris/morris.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/gauge/gauge.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/isotope/jquery.isotope.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/ios7-switch/ios7-switch.js"></script>
		
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?= base_url(); ?>assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?= base_url(); ?>assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?= base_url(); ?>assets/javascripts/theme.init.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/forms/examples.wizard.js"></script>

		<!-- Examples -->
		<script src="<?= base_url(); ?>assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/tables/examples.datatables.tabletools.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/ui-elements/examples.modals.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/ui-elements/examples.lightbox.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/ui-elements/examples.notifications.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/fullcalendar/lib/moment.min.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/fullcalendar/fullcalendar.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/pages/examples.mediagallery.js"></script>
		<script src="<?= base_url(); ?>assets/javascripts/forms/examples.advanced.form.js" ></script>
		<!-- <script src="<?= base_url(); ?>assets/javascripts/dashboard/examples.dashboard.js"></script> -->
		<!-- <script src="<?= base_url(); ?>assets/javascripts/ui-elements/examples.charts.js"></script> -->



	</body>
</html>
<script type="text/javascript">
$(function(){
     $("#datatable-default-tools").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'pageLength'
        ]
    });
   })
	$("#submitbtnchange").click(function(){
		$.post('<?= base_url().'index.php/'.$this->uri->segment(1) ?>/execChangePassword',
				{	
					oldpassword : $("#oldpassword").val(),
					newpassword : $("#newpassword").val(),
					re_newpassword : $("#re_newpassword").val()
				},
				function(data){
					console.log(data);
					if(data == "success"){
						alert("Your password has been successfully updated.");

						location.reload();
					} else if(data == "matchissue") {
						alert("New password and repeat new password do not match. Please try again.");
					} else if(data == "oldissue") {
						alert("Your old password you entered is incorrect. Please try again.");
					}
				}
			);
	});

	$(".cashentry").keyup(function(data){
		var transactioncount_total = 0;

		$(".cashentry").each(function(i, obj){
			if($(obj).val()){
				transactioncount_total = parseInt(transactioncount_total) + (parseInt($(obj).val()) * parseInt($(obj).attr('attr-val')))
			}
		});

		$("#cash_count").val(transactioncount_total)
	});
    
    $('#pettycash').submit(function() {
        var r = confirm("Are you sure you want to submit this amount and start your session?");
        return r;
    });
    

    $("#submitbtnendsession").click( function () {    
		if(!confirm("Are you sure you want to submit and end your session?")){
			return false;   
		}

		$.post(
			'<?= base_url().'index.php/'.$this->uri->segment(1).'/execSubmitEndSession' ?>',
			$("#endingsession").serialize(),
			function(data){
				console.log(data)
				window.open('<?= base_url().'index.php/cashier/printEndingSession/' ?>'+data);
				location.reload();
			}
		);
    });
</script>