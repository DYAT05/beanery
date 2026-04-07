<html>
	<head>
		<title>Ending Session Report</title>
		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/invoice-print.css" />
	</head>
	<body>
        <h4>Cash Inputs</h4>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
            <thead>
                <tr>
                    <th>P1</th>
                    <th>P5</th>
                    <th>P10</th>
                    <th>P20</th>
                    <th>P50</th>
                    <th>P100</th>
                    <th>P200</th>
                    <th>P500</th>
                    <th>P1000</th>
                </tr>
            </thead>
            <tbody>
                <tr class="gradeX">
                    <td><?= number_format($detailscontent->p1); ?></td>
                    <td><?= number_format($detailscontent->p5); ?></td>
                    <td><?= number_format($detailscontent->p10); ?></td>
                    <td><?= number_format($detailscontent->p20); ?></td>
                    <td><?= number_format($detailscontent->p50); ?></td>
                    <td><?= number_format($detailscontent->p100); ?></td>
                    <td><?= number_format($detailscontent->p200); ?></td>
                    <td><?= number_format($detailscontent->p500); ?></td>
                    <td><?= number_format($detailscontent->p1000); ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <h4>Other Details</h4>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
            <thead>
                <tr>
                    <th>Cashier Name</th>
                    <th>Petty Cash</th>
                    <th>Cash Count</th>
                    <th>Transaction Count</th>
                </tr>
            </thead>
            <tbody>
                <tr class="gradeX">
                    <td><?= $detailscontent->cashier_name; ?></td>
                    <td><?= number_format($detailscontent->petty_cash, 2); ?></td>
                    <td><?= number_format($detailscontent->cash_out, 2); ?></td>
                    <td><?= number_format($detailscontent->transaction_count); ?></td>
                </tr>
            </tbody>
        </table>

		<script>
			window.print();
		</script>
	</body>
</html>