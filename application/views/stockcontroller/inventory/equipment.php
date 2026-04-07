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
			<section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">
                        Updated List of Equipment
					</h2>
                    <div class="panel-actions">
                        <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalAddNewStock"><button type="button" class="btn btn-success">Add New Item</button></a>
                        <a class="mb-xs mt-xs mr-xs" href="<?= $printcategorylink ?>" target="_blank"><button type="button" class="btn btn-primary">Print Report</button></a>
                    </div>
                </header>
                
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Unit/Mode</th>
                                    <th>Minimum Stock</th>
                                    <th>Beginning Inventory</th>
                                    <th>New Purchase</th>
                                    <th>Waste</th>
                                    <th>Ending Inventory</th>
                                    <th>Total Stock</th>
                                    <th>Inventory Cost</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($items AS $item){
                                ?>
                                    <tr class="gradeX">
                                        <td><?= anchor($this->uri->segment(1).'/inventoryLogs/'.$item->id, $item->item); ?></td>
                                        <td><?= $item->unit_mode; ?></td>
                                        <td><?= $item->minimum_stock; ?></td>
                                        <td><?= $item->beginning_inventory; ?></td>
                                        <td><?= $item->new_purchase; ?></td>
                                        <td><?= $item->waste; ?></td>
                                        <td><?= $item->ending_inventory; ?></td>
                                        <td><?= $item->total_stock; ?></td>
                                        <td><?= $item->inventory_cost; ?></td>
                                        <td class="text-center">
                                            <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim" href="#modalEditStock_<?= $item->id ?>"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a>
                                            <?= anchor('stockcontroller/removeItemInventory/'.$item->id.'/'.$this->uri->segment(2), '<button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>', array('onclick' => "return confirm('Are you sure you want to delete this item?')")) ?>
                                        </td>
                                    </tr>

                                    <div id="modalEditStock_<?= $item->id ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
                                        <?= form_open($this->uri->segment(1).'/execUpdateStock', array('id' => 'stocklistedit', 'class' => 'stocklistedit form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
                                        <section class="panel">
                                            <header class="panel-heading">
                                                <h2 class="panel-title">Update Stock Details</h2>
                                            </header>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="col-md-3 text-left" for="item">Item:</label>
                                                            <div class="col-md-9">
                                                                <input type="hidden" name="inventory_id" id="inventory_id" value="<?= $item->id ?>">
                                                                <input type="hidden" name="categorylink" value="<?= $categorylink ?>" />
                                                                <input type="text" class="form-control" required name="item" id="item" value="<?= $item->item ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 text-left" for="unit_mode">Unit/Mode:</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" data-plugin-select id="unit_mode" name="unit_mode" required>
                                                                    <option value="<?= $item->unit_mode ?>" selected><?= $item->unit_mode ?></option>
                                                                    <option value="kg">KILOGRAMS</option>
                                                                    <option value="oz">OUNCES</option>
                                                                    <option value="l">LITERS</option>
                                                                    <option value="ml">MILLILITERS</option>
                                                                    <option value="dz">DOZEN</option>
                                                                    <option value="case">CASE</option>
                                                                    <option value="pc">PIECE</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 text-left" for="beginning_inventory">Beginning Inventory:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" <?= ($item->is_updated == 1) ? 'readonly' : ''; ?> class="form-control updatebeginning" name="beginning_inventory" required id="beginning_inventory" attr-id="<?= $item->id ?>" value="<?= $item->beginning_inventory ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 text-left" for="ending_inventory">Ending Inventory:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" readonly name="ending_inventory" id="update_ending_inventory_<?= $item->id ?>" placeholder="Enter Ending Inventory..." value="<?= $item->ending_inventory ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 text-left" for="total_stock">Total Stock:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" readonly name="total_stock" id="update_total_stock_<?= $item->id ?>" value="<?= $item->total_stock ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 text-left" for="minimum_stock">Minimum Stock:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="minimum_stock" id="minimum_stock" required value="<?= $item->minimum_stock ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 text-left" for="inventory_cost">Inventory Cost:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" required name="inventory_cost" id="inventory_cost"  value="<?= $item->inventory_cost ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <footer class="panel-footer">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button type="submit" id="submitbtnpaid" class="btn btn-success">Edit Inventory Details</button>
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
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="modalAddNewStock" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
                    <?= form_open($this->uri->segment(1).'/execAddNewStock', array('id' => 'stocklist', 'class' => 'form-horizontal form-bordered',  'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">New Stock</h2>
                        </header>
                        <div class="panel-body">
                            <input type="hidden" name="category" value="equipment" />
                            <input type="hidden" name="categorylink" value="<?= $categorylink ?>" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 text-left" for="item">Item:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" required name="item" id="item"  placeholder="Enter Item name...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 text-left" for="unit_mode">Unit/Mode:</label>
                                        <div class="col-md-9">
                                            <select class="form-control" data-plugin-select id="unit_mode" name="unit_mode" required>
                                                <option value="" selected>-SELECT-</option>
                                                <option value="kg">KILOGRAMS</option>
                                                                    <option value="oz">OUNCES</option>
                                                                    <option value="l">LITERS</option>
                                                                    <option value="ml">MILLILITERS</option>
                                                                    <option value="dz">DOZEN</option>
                                                                    <option value="case">CASE</option>
                                                                    <option value="pc">PIECE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 text-left" for="beginning_inventory">Beginning Inventory:</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="beginning_inventory" id="new_beginning_inventory" required  placeholder="Enter Beginning Inventory...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 text-left" for="ending_inventory">Ending Inventory:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" readonly name="ending_inventory" id="new_ending_inventory" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 text-left" for="total_stock">Total Stock:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" readonly required name="total_stock" id="new_total_stock" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 text-left" for="minimum_stock">Minimum Stock:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" required name="minimum_stock" id="minimum_stock"  placeholder="Enter Minimum Stock...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 text-left" for="inventory_cost">Inventory Cost:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" required name="inventory_cost" id="inventory_cost"  placeholder="Enter Inventory Cost...">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" id="submitbtnpaid" class="btn btn-success">Submit</button>
                                    <button class="btn btn-default modal-dismiss">Cancel</button>
                                </div>
                            </div>
                        </footer>
                    </section>
                    <?= form_close() ?>
                </div>
                
            </section>
		</div>
  	</section>
</section>

<?php $this->load->view('footer'); ?>

<script>
    $('#stocklist').submit(function() {
        var r = confirm("Are you sure you want to add this details?");
        return r;
    });

    $('.stocklistedit').submit(function() {
        var r = confirm("Are you sure you want to update details?");
        return r;
    });

    $(".updatebeginning").keyup(function(){
        var getid = $(this).attr('attr-id');

        $("#update_total_stock_"+getid).val($(this).val());
        $("#update_ending_inventory_"+getid).val($(this).val());
    });

    $("#new_beginning_inventory").keyup(function(){
        $("#new_total_stock").val($(this).val());
        $("#new_ending_inventory").val($(this).val());
    });
</script>