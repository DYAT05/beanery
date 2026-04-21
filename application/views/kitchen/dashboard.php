<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Cashier_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Kitchen Staff Dashboard</h2>
	</header>

	<!-- start: page -->
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="row">
                <?php 
                    $ordercount = 1;

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
												<!-- <strong class="amount">Order #<?= $ordercount ?></strong> -->
                                                <strong class="amount">Order ID: <?= $order->id ?></strong>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</section>
                    <div id="modalViewOrderDetail_<?= $order->id ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
		                <?= form_open($this->uri->segment(1).'/execOrderPrepared', array('id' => 'orderlist', 'class' => 'form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
                        <section class="panel">
                            <header class="panel-heading">
                                <!-- <h2 class="panel-title">Order #<?= $ordercount ?></h2> -->
                                <h2 class="panel-title">Order ID: <?= $order->id ?></h2>
                            </header>
                            <div class="panel-body">
                                <input type="hidden" name="order_id" value="<?= $order->id ?>" />
                                <h5>Customer note: <b><i><?= $order->notes ?></i></b></h5>
                                <table class="table table-striped mb-none">
                                    <thead>
                                        <tr>
                                            <th><h4><b>Category</b></h4></th>
                                            <th><h4><b>Order Name</b></h4></th>
                                            <th><h4><b>Qty</b></h4></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $details = $CI->General_model->getOrderDetails($order->id);

                                            foreach($details AS $detail){
                                        ?>
                                            <tr class="gradeX">
                                                <td><?= $detail->category_name ?></td>
                                                <td><?= $detail->menu_name ?></td>
                                                <td><?= $detail->quantity ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button id="submitbtnprepared" class="btn btn-success">Ready to Serve</button>
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
                ?>
			</div>
		</div>
  	</section>
</section>

<?php $this->load->view('footer'); ?>