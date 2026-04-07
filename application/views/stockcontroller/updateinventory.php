<?php 
	$this->load->view('header'); 
	$CI =& get_instance();
	$CI->load->model('General_model');
	$CI->load->model('Stockcontroller_model');
?>

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Update Inventory Stocks</h2>
	</header>

	<!-- start: page -->
	<section class="panel">
		<div class="col-md-12 col-lg-12 col-xl-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <?php
                        $categories = ['perishable', 'non-perishable', 'sanitation', 'smallwares', 'cookware', 'equipment'];
                    ?>
                    <h2 class="panel-title"><?= (in_array($this->uri->segment(3), $categories)) ? ucwords($this->uri->segment(3)) : 'Unknown'; ?></h2>
                    <div class="panel-actions">
                        <a href="<?php echo base_url(); ?>" class="fa fa-times"></a>
                    </div>
                </header>

                <form class="form-horizontal form-bordered" id="updatestockform" action='<?= base_url().'index.php/'.$this->uri->segment(1) ?>/updateInventoryStock' method="post">
                    <div class="panel-body">
                        <input type="hidden" name="category" id="category" value="" />
                        <input type="hidden" name="item" id="item" value="" />
                        <input type="hidden" name="unit_mode" id="unit_mode" value="" />
                        <input type="hidden" name="minimum_stock" id="minimum_stock" value="" />
                        <input type="hidden" name="inventory_cost" id="inventory_cost" value="" />
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="itemdd">Item</label>
                            <div class="col-md-4">
                                <select class="form-control mb-md" name="item_id" id="itemdd" required>
                                    <option value="">--Choose Item--</option>

                                    <?php
                                        foreach($items AS $item){
                                            echo '<option value="'.$item->id.'">'.$item->item.'</option>';
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="new_purchase">New Purchase</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control" id="new_purchase" value="0" name="new_purchase" required placeholder="Enter New Purchase amount...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="waste">Waste</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control deductstock" id="waste" name="waste" value="0" required placeholder="Enter Waste amount...">
                            </div>
                        </div>
                        <?php
                            if(in_array($this->uri->segment(3), array('perishable', 'non-perishable'))){
                        ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="sold">Sold</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control deductstock" id="sold" value="0" name="sold" required placeholder="Enter Sold amount...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="variance">Variance</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control deductstock" id="variance" name="variance" value="0" placeholder="Enter Variance amount...">
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="beginning_inventory">Beginning Inventory</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" readonly id="beginning_inventory" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="ending_inventory">Ending Inventory</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" readonly id="ending_inventory" name="ending_inventory" value="" required>
                                <input type="hidden" class="form-control" readonly id="old_ending_inventory" name="old_ending_inventory" value="" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer text-center"> 
                        <button type="submit" class="btn btn-success">Update Inventory</button>
                    </div>
                </form>
            </section>
		</div>
  	</section>
</section>

<?php $this->load->view('footer'); ?>

<script>
    $("#itemdd").change(function(){
        var getitemid = $(this).val();

	    $.post('<?= base_url().'index.php/'.$this->uri->segment(1) ?>/getInventoryItemDetail', 
            { getitemid:getitemid }, 
            function(data){
			    var obj = JSON.parse(data);

                $("#category").val(obj.category);
                $("#item").val(obj.item);
                $("#unit_mode").val(obj.unit_mode);
                $("#minimum_stock").val(obj.minimum_stock);
                $("#inventory_cost").val(obj.inventory_cost);
                $("#beginning_inventory").val(obj.ending_inventory);
                $("#ending_inventory").val(obj.ending_inventory);
                $("#old_ending_inventory").val(obj.ending_inventory);
                $(".deductstock").val(0);
                $("#new_purchase").val(0)
            }
        );
    });
    

    $(".deductstock, #new_purchase").on("keyup change", function(data){
            
        var computedinventory = $("#beginning_inventory").val();

        $(".deductstock").each(function(i, obj){
            if($(obj).val()){
                computedinventory = ((parseInt(computedinventory) - parseInt($(obj).val())))
            }
        });

        var totalcomputestock = (parseInt(($("#new_purchase").val() === "" ? 0 : $("#new_purchase").val())) + parseInt(computedinventory))

		$("#ending_inventory").val(totalcomputestock);
    });
    
    $('#updatestockform').submit(function() {
        var r = confirm("Are you sure you want to update this inventory stock?");
        return r;
    });
</script>