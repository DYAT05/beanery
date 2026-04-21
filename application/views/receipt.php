<html>
	<head>
		<title>Transaction Receipt</title>
		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/invoice-print.css" />
	</head>
	<body>
		<div class="invoice">
			<!-- <div class="bill-info">
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6 text-center">
                    	<div class="ib">
							<img src="<?= base_url(); ?>assets/images/sitelogo.png" alt="Beanery" style="min-height: 50px !important; max-height: 50px !important; min-width: 50px !important;" />
						</div>
						<h5><strong>Steyler Beaner</strong></h5>
						<h5 style="white-space: nowrap;"><strong>Divine World College of Calapan</strong></h5>
							<p class="h5 mb-xs text-dark"><strong>Invoice Number: #<?= $headercontent->id ?></strong></p>
					</div>
				</div>
			</div> -->

				<div class="bill-info">
				    <div class="row">
				        <div class="col-md-12 text-center">

				            <img src="<?= base_url(); ?>assets/images/sitelogo.png"
				                 alt="Beanery"
				                 style="display:block; margin:0 auto; max-height:50px;" />

				            <h5><strong>Steyler Beaner</strong></h5>

				            <h5 style="white-space: nowrap;">
				                <strong>Divine World College of Calapan</strong>
				            </h5>

				            <p class="h5 mb-xs text-dark">
				                <strong>Invoice Number: #<?= $headercontent->id ?></strong>
				            </p>

				        </div>
				    </div>
				</div>

            <br>
			<div class="table-responsive">
				<table class="table invoice-items">
					<thead>
						<tr class="h4 text-dark">
							<th id="cell-qty"   class="text-semibold text-center">Quantity</th>
							<th id="cell-desc"   class="text-semibold">Description</th>
							<th id="cell-price"  class="text-center text-semibold">Unit Price</th>
							<th id="cell-total"  class="text-center text-semibold">Total Price</th>
						</tr>
					</thead>
					<tbody>
                        
                        <?php
                            foreach($detailscontent AS $content){
                        ?>
						<tr>
							<td class="text-center"><?= number_format($content->quantity) ?></td>
							<td class="text-semibold text-dark"><?= $content->menu_name ?></td>
							<td class="text-center">₱ <?= number_format($content->price, 2) ?></td>
							<td class="text-center">₱ <?= number_format($content->amount, 2) ?></td>
						</tr>
                        <?php
                            }
                        ?>
					</tbody>
				</table>
			</div>
		
			<div class="invoice-summary">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-8">
						<table class="table h5 text-dark">
							<tbody>
								<tr class="b-top-none h4">
									<td colspan="2">Total Due</td>
									<td class="text-left">₱ <?= number_format($headercontent->total_amount, 2) ?></td>
								</tr>
								<tr>
									<td colspan="2">Cash</td>
									<td class="text-left">₱ <?= number_format($headercontent->cash, 2) ?></td>
								</tr>
								<tr>
									<td colspan="2">Change</td>
									<td class="text-left">₱ <?= number_format($headercontent->change, 2) ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="bill-info">
				<div class="row">
					<div class="col-md-12 text-center">
						<h5>Served by: <strong><?= $this->session->userdata('name') ?></strong></h5>
						<h5>Date: <?= date('Y-m-d h:i A') ?></h5>
					</div>
				</div>
			</div>
		</div>

		<script>
			window.print();
		</script>
	</body>
</html>