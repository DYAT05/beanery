<html>
	<head>
		<title>List of Non-Perishable</title>
		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/invoice-print.css" />
	</head>
	<body>
    <table class="table table-bordered table-striped mb-none" id="datatable-default">
        <thead>
            <tr>
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
                foreach($items AS $item){
            ?>
                <tr class="gradeX">
                    <td><?= $item->item ?></td>
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

		<script>
			window.print();
		</script>
	</body>
</html>