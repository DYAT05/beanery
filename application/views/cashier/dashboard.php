<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Cashier_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Cashier Dashboard</h2>
	</header>

	<!-- start: page -->
	
<?php $this->load->view('footer'); ?>

<script>
    $(".cash").keyup(function(){
        var getorderid = $(this).attr('atr-orderid');
        var getcash = $(this).val();
        var gettotaldue = $('#totaldue_'+getorderid).val();
        var getchange = parseFloat(getcash) - parseFloat(gettotaldue);

        $("#change_"+getorderid).val(getchange)
    });
</script>