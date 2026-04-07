<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Beanery</title>
		<meta name="keywords" content="Beanery" />
		<meta name="description" content="Beanery">
		<meta name="author" content="Beanery">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
	    <link rel="apple-touch-icon" sizes="128x128" href="<?= base_url(); ?>assets\images\BEANERY-removebg-preview.png">
    	<link rel="icon" type="image" href="<?= base_url(); ?>assets\images\BEANERY-removebg-preview.png"/>
    	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->

        <script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/codemirror/theme/monokai.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/morris/morris.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/isotope/jquery.isotope.css" />
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
    	<script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
		<script src="<?= base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>

	</head>

	<style type="text/css">

		.ul.nav-main li .nav-children li a:hover{
			color: #0088cc;
		}
	    .btn-circle.btn-sm { 
	        width: 30px; 
	        height: 30px; 
	        padding: 6px 0px; 
	        border-radius: 15px; 
	        font-size: 8px; 
	        text-align: center; 
	    } 
		.swal-container {
			z-index: 9999;
		}
	</style>
	<body>
		<section class="body">

			<!-- php call and functions -->
			<?php
				$usertype = $this->session->userdata('usertype');
				$name = $this->session->userdata('name');
				$email = $this->session->userdata('email');
			?>
			<!-- end -->

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="<?= base_url(); ?>assets\images\BEANERY-removebg-preview.png" height="40" alt="Beanery" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?= base_url(); ?>assets\images\BEANERY-removebg-preview.png" />
							</figure>
							<div class="profile-info" data-lock-name="<?= $name ?>" data-lock-email="<?= $name ?>">
								<span class="name"><?= $name; ?></span>
								<span class="role"><?= $email ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<?php
									if($this->session->userdata('usertype') == "user"){
								?>
									<li class="divider"></li>
									<li>
										<?= anchor('user/editaccount', '<i class="fa fa-pencil"></i> Edit Account',  array('class'=>'mb-xs mt-xs mr-xs')); ?>
									</li>
								<?php
									}
									if($this->session->userdata('usertype') == "cashier"){
										if($this->session->userdata('is_duty') == "0"){
								?>

									<li class="divider"></li>
									<li>
										<a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalPettyCash"><i class="fa fa-clock-o"></i> Clock-in</a>
									</li>
								<?php
										} else {
								?>
									<li class="divider"></li>
									<li>
										<a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalEndSession"><i class="fa fa-clock-o"></i> End Session</a>
									</li>
								<?php
										}
									}
								?>
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?= base_url() ?>index.php/login/logout"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<!-- Modal Change password -->
			<div id="modalChangepass" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Change Password</h2>
					</header>
					<div class="panel-body">
						<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
							<div class="form-group mt-lg">
								<label class="col-sm-3 control-label">Old Password: </label>
								<div class="col-sm-9">
									<input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder="Type your old password" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">New Password: </label>
								<div class="col-sm-9">
									<input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="Type your new password" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Repeat New Password: </label>
								<div class="col-sm-9">
									<input type="password" id="re_newpassword" name="re_newpassword" class="form-control" placeholder="Type your new password again" />
								</div>
							</div>
						</form>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button id="submitbtnchange" class="btn btn-primary">Submit</button>
								<button class="btn btn-default modal-dismiss">Cancel</button>
							</div>
						</div>
					</footer>
				</section>
			</div>
			<!-- End Modal Change password -->

			<!-- Modal Petty cash -->
			<div id="modalPettyCash" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Petty Cash</h2>
					</header>
					<?= form_open($this->uri->segment(1).'/execSubmitPettyCash', array('id' => 'pettycash', 'class' => 'form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Enter amount: </label>
							<div class="col-sm-9">
								<input type="number" id="petty_cash" name="petty_cash" class="form-control" placeholder="Enter Petty cash amount..." />
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="submit" id="submitbtnpettycash" class="btn btn-primary">Submit</button>
								<button class="btn btn-default modal-dismiss">Cancel</button>
							</div>
						</div>
					</footer>
					<?= form_close() ?>
				</section>
			</div>
			<!-- End Modal Petty cash -->

			<?php
				$CI =& get_instance();
				$CI->load->model('Cashier_model');
				
				if($this->session->userdata('usertype') == "cashier"){
					$transdetail = $CI->Cashier_model->getLatestTransactionDetails();
					$orderout = count($CI->Cashier_model->getOrderHeaderOut());

					if($transdetail){

			?>
			<div id="modalEndSession" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Ending Session</h2>
					</header>
					<form name="endingsession" id="endingsession" action="" method="POST">  
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 1: </label>
										<div class="col-sm-5">
											<input type="hidden" id="transaction_id" name="transaction_id" value="<?=  $transdetail->id ?>" />
											<input type="number" id="p1" name="p1" attr-val="1" class="form-control cashentry" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 100: </label>
										<div class="col-sm-5">
											<input type="number" id="p100" name="p100" attr-val="100" class="form-control cashentry" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 5: </label>
										<div class="col-sm-5">
											<input type="number" id="p5" name="p5" attr-val="5" class="form-control cashentry" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 200: </label>
										<div class="col-sm-5">
											<input type="number" id="p200" name="p200" attr-val="200" class="form-control cashentry" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 10: </label>
										<div class="col-sm-5">
											<input type="number" id="p10" name="p10" attr-val="10" class="form-control cashentry" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 500: </label>
										<div class="col-sm-5">
											<input type="number" id="p500" name="p500" attr-val="500" class="form-control cashentry" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 20: </label>
										<div class="col-sm-5">
											<input type="number" id="p20" name="p20" attr-val="20" class="form-control cashentry" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 1000: </label>
										<div class="col-sm-5">
											<input type="number" id="p1000" name="p1000" attr-val="1000" class="form-control cashentry" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">P 50: </label>
										<div class="col-sm-5">
											<input type="number" id="p50" name="p50" attr-val="50" class="form-control cashentry" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-4 control-label">Cashier: </label>
								<div class="col-sm-5">
									<input type="text" readonly id="cashier" name="cashier" value="<?= $this->session->userdata('name') ?>" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Petty Cash: </label>
								<div class="col-sm-5">
									<input type="number" readonly id="petty_cash" name="petty_cash" value="<?= $transdetail->petty_cash ?>" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Cash Count: </label>
								<div class="col-sm-5">
									<input type="number" readonly id="cash_count" name="cash_count" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Transaction Count: </label>
								<div class="col-sm-5">
									<input type="number" readonly id="transaction_count" name="transaction_count" class="form-control" value="<?= $orderout ?>" />
								</div>
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="button" id="submitbtnendsession" class="btn btn-primary">Submit</button>
								<button class="btn btn-default modal-dismiss">Cancel</button>
							</div>
						</div>
					</footer>
					</form>
				</section>
			</div>

			<?php
					}
				}
			?>

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							<?= ucwords($usertype)."'s " ?>Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
					
					<?php
						$this->load->view('sidebar-'.strtolower($this->session->userdata('usertype')));
					?>
				</aside>
				<!-- end: sidebar -->