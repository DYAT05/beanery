<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Cashier_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Cashier POS</h2>
	</header>

	<!-- start: page -->
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="row">
                <div class="col-md-8">
                    <div class="tabs">
                        <ul class="nav nav-tabs">
                            <?php
                                $firsttab = 1;
                                foreach($categories AS $category){
                            ?>
                                <li class="<?= ($firsttab == 1) ? 'active' : '' ?>">
                                    <a href="#<?= $category->id ?>" data-toggle="tab"><?= $category->category_name ?></a>
                                </li>
                            <?php
                                    $firsttab++;
                                }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                                $firsttabcontent = 1;
                                foreach($categories AS $category){
                            ?>
                                <div id="<?= $category->id ?>" class="tab-pane <?= ($firsttabcontent == 1) ? 'active' : '' ?>">
                                    <div class="row">
                                    <?php
                                        $items = $CI->General_model->getMenuPerCategory($category->id);

                                        foreach($items AS $item){
                                    ?>
                                            <div class="col-md-4 col-lg-4 col-xl-4">
                                                <section class="panel panel-featured-left panel-featured-primary">
                                                    <div class="panel-body">
                                                        <div class="widget-summary">
								                            <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalPosCart_<?= $item->id ?>">

                                                                <div class="widget-summary-col widget-summary-col-icon">
                                                                    <div class="summary-icon bg-primary">
                                                                        <i class="fa fa-cutlery"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="widget-summary-col">
                                                                    <div class="summary">
                                                                        <div class="info">
                                                                            <strong class="amount"><?= $item->menu_name ?></strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div id="modalPosCart_<?= $item->id ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
                                                <?= form_open($this->uri->segment(1).'/execPosAddToCart', array('id' => 'orderlist', 'class' => 'form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        <h2 class="panel-title"><?= $item->menu_name ?> @ P<?= number_format($item->price, 2) ?></h2>
                                                    </header>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label" for="email">Enter Quantity:</label>
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="menu_id" value="<?= $item->id ?>" />
                                                                <input type="hidden" name="category_id" value="<?= $item->category_id ?>" />
                                                                <input type="hidden" name="price" value="<?= $item->price ?>" />
                                                                <input type="number" class="form-control" required name="quantity" id="quantity" placeholder="Enter Quantity...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <footer class="panel-footer">
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button id="submitbtnpaid" class="btn btn-success">Add to List</button>
                                                                <button class="btn btn-default modal-dismiss">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </footer>
                                                </section>
                                                <?= form_close() ?>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            <?php
                                    $firsttabcontent++;
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel-body">
                        <?php
                            $grandtotalamount = 0;

                            if($this->session->userdata('is_duty') == "1"){

                                foreach($poscart AS $item){
                                    $totalamount =  $item->quantity * $item->price;
                                    $grandtotalamount += $totalamount;
                        ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <text><b><?= $item->menu_name ?></b></text>
                                            </div>
                                            <div class="col-md-3">
                                                <text>P<b><?= number_format($totalamount, 2) ?></b></text>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <text>x<b><?= $item->quantity ?></b> @ P<b><?= number_format($item->price, 2) ?></b></text>
                                            </div>
                                            <div class="col-md-3">
                                                <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalPosCartEdit_<?= $item->id ?>">
                                                    <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                                                </a>

                                                <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalPosCartRemove_<?= $item->id ?>">
                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="modalPosCartEdit_<?= $item->id ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
                                    <?= form_open($this->uri->segment(1).'/execPosUpdateItemInCart', array('id' => 'orderlist', 'class' => 'form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
                                    <section class="panel">
                                        <header class="panel-heading">
                                            <h2 class="panel-title"><?= $item->menu_name ?> @ P<?= number_format($item->price, 2) ?></h2>
                                        </header>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="quantity">Enter Quantity:</label>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="poscart_id" value="<?= $item->id ?>" />
                                                    <input type="number" class="form-control" required name="quantity" id="quantity" value="<?= $item->quantity ?>" placeholder="Enter Quantity...">
                                                </div>
                                            </div>
                                        </div>
                                        <footer class="panel-footer">
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button id="submitbtnpaid" class="btn btn-success">Update Item</button>
                                                    <button class="btn btn-default modal-dismiss">Cancel</button>
                                                </div>
                                            </div>
                                        </footer>
                                    </section>
                                    <?= form_close() ?>
                                </div>
                                <div id="modalPosCartRemove_<?= $item->id ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
                                    <?= form_open($this->uri->segment(1).'/execPosRemoveItemInCart', array('id' => 'orderlist', 'class' => 'form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
                                    <section class="panel">
                                        <header class="panel-heading">
                                            <h2 class="panel-title"><?= $item->menu_name ?> @ P<?= number_format($item->price, 2) ?></h2>
                                        </header>
                                        <div class="panel-body text-center">
                                            <h4>Are you sure you want to remove this Item from List?</h4>
                                            <input type="hidden" name="poscart_id" value="<?= $item->id ?>" />
                                        </div>
                                        <footer class="panel-footer">
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button id="submitbtnpaid" class="btn btn-danger">Remove Item</button>
                                                    <button class="btn btn-default modal-dismiss">Cancel</button>
                                                </div>
                                            </div>
                                        </footer>
                                    </section>
                                    <?= form_close() ?>
                                </div>
                                <hr>

                                
                        <?php
                                }
                            }
                        ?>
                        
                                        
                        <div class="row">
                            <div class="col-md-9">
                                <text>Total Price: </text>
                            </div>
                            <div class="col-md-3">
                                <text>P<b><?= number_format($grandtotalamount, 2) ?></b></text>
                            </div>
                        </div>
                        <hr>
                        <form name="cashierform" id="cashierform" action="" method="POST">  
                            <div class="form-group">
                                <label class="col-md-4 text-left" for="customer_name">Customer Name:</label>
                                <div class="col-md-8">
                                    <input type="hidden" required name="total_amount" id="total_amount" value="<?= $grandtotalamount ?>">
                                    <input type="text" class="form-control" required name="customer_name" id="customer_name" placeholder="Enter Name here...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 text-left" for="customer_note">Customer Notes:</label>
                                <div class="col-md-8">
                                    <!-- <input type="text" class="form-control" required name="customer_note" id="customer_note" placeholder="Enter Notes here..."> -->


                                    <!-- DYAT -->
                                    <input type="text" class="form-control" name="customer_note" id="customer_note" value="none" placeholder="Enter Notes here...">
                                    <!-- DYAT -->
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-4 text-left" for="cash">Cash:</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" required name="cash" id="cash" placeholder="Cash Received...">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-4 text-left" for="totaldue">Total Due:</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" readonly required name="totaldue" id="totaldue" value="<?= $grandtotalamount?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-4 text-left" for="change">Change:</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" readonly required name="change" id="change" placeholder="Enter change amount...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 text-right">
                                <button type="submit" id="submitbtnpayment" class="btn btn-success disabled">Proceed to Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
		    </div>
		</div>
  	</section>
</section>

<?php $this->load->view('footer'); ?>

<script>
    $("#cash").keyup(function(){
        var getcash = $(this).val();
        var gettotaldue = $('#totaldue').val();
        var getchange = parseFloat(getcash) - parseFloat(gettotaldue);

        $("#change").val(getchange)

        if($("#change").val() != "" && $("#change").val() >= 0 && $('#totaldue').val() > 0){
            $("#submitbtnpayment").removeClass("disabled");
        } else {
            $("#submitbtnpayment").addClass("disabled");
        }
    });

    $("#cashierform").submit( function () {
		if(!confirm("Are you sure you want to submit these item(s)?")){
			return false;   
		}
   
        $.post(
            'execPosProceedToPayment',
            $(this).serialize(),
            function(data){
                window.open('<?= base_url().'index.php/cashier/printTransactionReceipt/' ?>'+data);
                location.reload();
            }
        );
        return false;   
    });
</script>