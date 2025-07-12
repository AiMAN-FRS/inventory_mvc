<!-- <php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Barang Masuk.xls");
?> -->

<html>

<head>
	<title>Daftar Stock Barang</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
	</script>
	<script src="https://kit.fontawesome.com/b79720072c.js" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container">
		<h2>Stock Barang</h2>
		<h4>(Stock App)</h4>
		<div class="row mt-3">
			<div class="col">
				<form method="post" class="form-inline">
					<select name="customer" class="form-control">
						<option value="">Pilih Customer</option>
						<?php foreach ($customers as $customer): ?>
						<option value="<?= $customer->titlecs; ?>"><?= $customer->titlecs; ?></option>
						<?php endforeach; ?>
					</select>
					<button type="submit" name="filter_dtbrg" class="btn btn-primary ml-3">
						<i class="fa-solid fa-sort"></i> Filter Data
					</button>
				</form>
			</div>
		</div>

		<div class="data-tables datatable-dark">
			<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>						
						<th>Part Name</th>
						<th>Part Number</th>
						<th>Spec Material</th>
						<th>Leader/Subcont</th>
						<th>Customer</th>
						<th>Stock</th>
						<th>Unity</th>
						<th>Location</th>
						<th>Min Stock</th>
						<th>Max Stock</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($stock as $data): ?>
						<tr>
							<td><?= $i++; ?></td>							
							<td><?= $data->namabarang; ?></td>
							<td><?= $data->kd; ?></td>
							<td><?= $data->spek; ?></td>
							<td><?= $data->produsen; ?></td>
							<td><?= $data->customer; ?></td>
							<td><b><?= number_format($data->stock); ?></b></td>
							<td><i><?= $data->satuan; ?></i></td>
							<td><?= $data->lokasi; ?></td>
							<td><i><?= number_format($data->min_stock); ?></i></td>
							<td><i><?= number_format($data->max_stock); ?></i></td>
							<td align="center">
								<?php
									if ($data->stock < $data->min_stock / 2) {
										$status = '<button type="button" class="btn btn-danger">DANGER</button>';
									} elseif ($data->stock < $data->min_stock) {
										$status = '<button type="button" class="btn btn-warning">WARNING</button>';
									} elseif ($data->stock > $data->max_stock) {
										$status = '<button type="button" class="btn btn-primary">OVER</button>';
									} else {
										$status = '<button type="button" class="btn btn-success">AMAN</button>';
									}
									echo $status;
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

	<script>
		$(document).ready(function () {
			$('#dataTable2').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	</script>

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


</body>

</html>