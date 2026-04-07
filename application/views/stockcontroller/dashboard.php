<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Cashier_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Stock Controller Dashboard</h2>
	</header>

	<!-- start: page -->
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="row">	
				
				<?php
					foreach($lowstocks AS $stock){
				?>
					<div class="col-md-12 col-lg-12 col-xl-12">
						<div class="alert alert-danger">
							<strong><?= $stock->item ?></strong> of category <strong><?= $stock->category ?></strong> is now below minimum stocks.
						</div>			
					</div>
				<?php
					}
				?>		
				<div class="col-md-12 col-lg-3 col-xl-3">
					<section class="panel panel-featured-left panel-featured-primary">
						<div class="panel-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-primary">
										<i class="fa fa-dollar"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Current Total Sales</h4>
										<div class="info">
											<strong class="amount"><?= $currenttotalsales ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase"></a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-12 col-lg-3 col-xl-3">
					<section class="panel panel-featured-left panel-featured-primary">
						<div class="panel-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-primary">
										<i class="fa fa-dollar"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Overall Total Sales</h4>
										<div class="info">
											<strong class="amount"><?= $totalsales ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase"></a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-12 col-lg-3 col-xl-3">
					<section class="panel panel-featured-left panel-featured-primary">
						<div class="panel-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-primary">
										<i class="fa fa-money"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Transaction Count</h4>
										<div class="info">
											<strong class="amount"><?= $totaltransactions ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase"></a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-12 col-lg-3 col-xl-3">
					<section class="panel panel-featured-left panel-featured-primary">
						<div class="panel-body">
							<div class="widget-summary">
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Top 5 Selling Products</h4>
										<?php
											if($topitems){
												$topcount = 1;
												foreach($topitems AS $item){
										?>
													<div class="info">
														<strong class="amount"># <?= $topcount.' - '.$item->menu_name.' (<i>'.$item->category_name.'</i>)' ?></strong>
													</div>
										<?php
													$topcount++;
												}
											} else {
										?>
												<div class="info">
													<strong class="amount">Not yet available</strong>
												</div>
										<?php
											}
										?>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase"></a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
  	</section>
</section>

<?php $this->load->view('footer'); ?>