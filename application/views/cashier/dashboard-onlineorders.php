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
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="row">
                <?php 
                    $ordercount = 1;
					if($this->session->userdata('is_duty') == "1"){
                        foreach($orders AS $order){

                ?>
				<div class="col-md-4 col-lg-4 col-xl-4">
					<section class="panel panel-featured-left panel-featured-primary">
						<div class="panel-body">
							<div class="widget-summary">
								<a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalViewOrderDetail_<?= $order->id ?>">
									<div class="widget-summary-col widget-summary-col-icon">
										<div class="summary-icon bg-primary">
											<i class="fa fa-cutlery"></i>
										</div>
									</div>
									<div class="widget-summary-col">
										<div class="summary">
											<div class="info">
												<strong class="amount">Order #<?= $ordercount ?></strong>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</section>
                    <div id="modalViewOrderDetail_<?= $order->id ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
		                <?= form_open($this->uri->segment(1).'/execOrderPaid', array('id' => 'orderlist', 'class' => 'form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Order #<?= $ordercount ?></h2>
                            </header>
                            <div class="panel-body">
                                <input type="hidden" name="order_id" value="<?= $order->id ?>" />
                                <div class="row">
                                    <div class="col-md-3"><h4><i>Ordered by:</i></h4></div>
                                    <div class="col-md-9"><h4><i><b><?= $order->name ?></b></i></h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><h4><i>Ordered at:</i></h4></div>
                                    <div class="col-md-9"><h4><i><b><?= $order->created_at ?></b></i></h4></div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-none">
                                        <thead>
                                            <tr>
                                                <th><h4><b>Category</b></h4></th>
                                                <th><h4><b>Order Name</b></h4></th>
                                                <th><h4><b>Qty</b></h4></th>
                                                <th class="text-center"><h4><b>Amount</b></h4></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $details = $CI->General_model->getOrderDetails($order->id);
                                                $totalamount = 0;

                                                foreach($details AS $detail){
                                            ?>
                                                <tr class="gradeX">
                                                    <td><?= $detail->category_name ?></td>
                                                    <td><?= $detail->menu_name ?></td>
                                                    <td><?= $detail->quantity ?></td>
                                                    <td class="text-center"><?= number_format($detail->amount, 2) ?></td>
                                                </tr>
                                            <?php
                                                    $totalamount += $detail->amount;
                                                }
                                            ?>
                                            <tr class="gradeX">
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td class="text-center"><b><?= number_format($totalamount, 2) ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3 text-left" for="notes">Customer Note:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="notes" id="notes" placeholder="Enter customer notes...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 text-left" for="cash">Cash:</label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="name" value="<?= $order->name ?>" />
                                                <input type="number" class="form-control cash" required name="cash" id="cash" atr-orderid="<?= $order->id ?>" placeholder="Cash Received...">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 text-left" for="totaldue_<?= $order->id ?>">Total Due:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" readonly required name="totaldue" id="totaldue_<?= $order->id ?>" value="<?= $totalamount?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 text-left" for="change_<?= $order->id ?>">Change:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control"  readonly required name="change" id="change_<?= $order->id ?>" placeholder="Enter change amount...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" id="submitbtnpaid" class="btn btn-success">Process Order</button>
                                        <button class="btn btn-default modal-dismiss">Cancel</button>
                                    </div>
                                </div>
                            </footer>
                        </section>
                        <?= form_close() ?>
                    </div>
				</div>
                <?php
                            $ordercount++;
                        }
                    }
                ?>
			</div>
		</div>
  	</section>
</section>

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