<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Cashier_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Stock Controller Report</h2>
	</header>

	<!-- start: page -->
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">
                        Restaurant Report Summary
					</h2>
                    <div class="panel-actions">
                        <a class="mb-xs mt-xs mr-xs" href="printRestaurantReportSummary?transdate=<?= $this->input->get('transdate') ?>" target="_blank"><button type="button" class="btn btn-primary">Print Report</button></a>
                    </div>
                </header>
                
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Choose Transaction date: </label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" id="transactiondate" <?= ($this->input->get('transdate')) ? 'value="'.$this->input->get('transdate').'"' : ''; ?> data-plugin-datepicker class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Cashier</th>
                                    <th>Transaction Count</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($transactions AS $transaction){
                                ?>
                                    <tr class="gradeX">
                                        <td><?= $transaction->created_at; ?></td>
                                        <td><?= $transaction->name; ?></td>
                                        <td><?= number_format($transaction->counttransaction); ?></td>
                                        <td><?= number_format($transaction->grandtotalamount, 2); ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
		</div>
  	</section>
</section>

<?php $this->load->view('footer'); ?>

<script>
    $("#transactiondate").change(function(data){
        var getdate = $(this).val();

        window.location.href = "<?= base_url().'index.php/stockcontroller/restaurantReportSummary?transdate=' ?>"+getdate
    })
</script>