<html>
	<head>
		<title>Restaurant Report Summary</title>
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
                        <th>Date</th>
                        <th>Cashier</th>
                        <th>Transaction Count</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($transactions AS $transaction){
                    ?>
                        <tr class="gradeX">
                            <td><?= $transaction->created_at; ?></td>
                            <td><?= $transaction->name; ?></td>
                            <td><?= number_format($transaction->counttransaction); ?></td>
                            <td><?= number_format($transaction->grandtotalamount, 2); ?></td>
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