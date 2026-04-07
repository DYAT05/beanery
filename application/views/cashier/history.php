<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Cashier_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Transaction History</h2>
	</header>

	<!-- start: page -->
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
            
            <section class="panel">
                <div class="panel-body">

                    <form method="GET" class="mb-lg">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Start Date & Time</label>
                            <input type="datetime-local" name="start_date" class="form-control" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                        </div>

                        <div class="col-md-3">
                            <label>End Date & Time</label>
                            <input type="datetime-local" name="end_date" class="form-control" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                        </div>

                        <div class="col-md-2" style="margin-top:25px;">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>

                        <div class="col-md-2" style="margin-top:25px;">
                        <!-- <a href="<?= base_url('transaction_history') ?>" class="btn btn-default">Reset</a> -->
                        <a href="<?= site_url('cashier/history') ?>" class="btn btn-default">Reset</a>
                        </div>
                    </div>
                </form>

                    
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th><h4><b>Transaction Datetime</b></h4></th>
                                <th><h4><b>Ordered by</b></h4></th>
                                <th><h4><b>Total Amount</b></h4></th>
                                <th class="text-center"><h4><b>Action</b></h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($orders AS $order){
                            ?>
                                <tr>
                                    <td><?= $order->created_at ?></td>
                                    <td><?= $order->name ?></td>
                                    <td><?= number_format($order->total_amount, 2) ?></td>
                                    <td class="text-center"><a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalViewOrderDetail_<?= $order->id ?>"><button type="button" class="btn btn-sm btn-primary">View Transaction</button></a></td>
                                </tr>
                                <div id="modalViewOrderDetail_<?= $order->id ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            <h2 class="panel-title">Order details</h2>
                                        </header>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3"><h4><i>Ordered by:</i></h4></div>
                                                <div class="col-md-9"><h4><i><b><?= $order->name ?></b></i></h4></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><h4><i>Ordered at:</i></h4></div>
                                                <div class="col-md-9"><h4><i><b><?= $order->created_at ?></b></i></h4></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><h4><i>Total Amount:</i></h4></div>
                                                <div class="col-md-9"><h4><i><b><?= number_format($order->total_amount, 2) ?></b></i></h4></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><h4><i>Customer Note:</i></h4></div>
                                                <div class="col-md-9"><h4><i><b><?= $order->notes ?></b></i></h4></div>
                                            </div>
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3"><b>Category</b></div>
                                                    <div class="col-md-3"><b>Order Name</b></div>
                                                    <div class="col-md-3"><b>Qty</b></div>
                                                    <div class="col-md-3"><b>Amount</b></div>
                                                </div>
                                                
                                                <?php
                                                    $details = $CI->General_model->getOrderDetails($order->id);
                                                    $totalamount = 0;

                                                    foreach($details AS $detail){
                                                ?>
                                                    <div class="row">
                                                        <div class="col-md-3"><?= $detail->category_name ?></div>
                                                        <div class="col-md-3"><?= $detail->menu_name ?></div>
                                                        <div class="col-md-3"><?= $detail->quantity ?></div>
                                                        <div class="col-md-3"><?= number_format($detail->amount, 2) ?></div>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <footer class="panel-footer">
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button class="btn btn-default modal-dismiss">Close</button>
                                                </div>
                                            </div>
                                        </footer>
                                    </section>
                                </div>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
		</div>
  	</section>
</section>

<?php $this->load->view('footer'); ?>