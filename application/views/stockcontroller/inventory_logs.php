<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Cashier_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Stock Controller Inventory Logs</h2>
	</header>

	<!-- start: page -->
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Changes for <?= $itemname ?></h2>
                    <div class="panel-actions">
                        <a  href="javascript:history.back()"><button type="button" class="btn btn-default">Return to List</button></a>
                    </div>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Item</th>
                                    <th>Unit/Mode</th>
                                    <th>Minimum Stock</th>
                                    <th>Beginning Inventory</th>
                                    <th>New Purchase</th>
                                    <th>Sold</th>
                                    <th>Waste</th>
                                    <th>Variance</th>
                                    <th>Ending Inventory</th>
                                    <th>Total Stock</th>
                                    <th>Inventory Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($itemlogs AS $item){
                                ?>
                                    <tr class="gradeX">
                                        <td><?= $item->created_at; ?></td>
                                        <td><?= $item->item; ?></td>
                                        <td><?= $item->unit_mode; ?></td>
                                        <td><?= $item->minimum_stock; ?></td>
                                        <td><?= $item->beginning_inventory; ?></td>
                                        <td><?= $item->new_purchase; ?></td>
                                        <td><?= $item->sold; ?></td>
                                        <td><?= $item->waste; ?></td>
                                        <td><?= $item->variance; ?></td>
                                        <td><?= $item->ending_inventory; ?></td>
                                        <td><?= $item->total_stock; ?></td>
                                        <td><?= $item->inventory_cost; ?></td>
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