<!-- <php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Barang Masuk.xls");
?> -->

<html>

<head>
	<title>Daftar Barang Masuk</title>
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
		<h2>Barang Masuk</h2>
		<h4>(Stock App)</h4>
		<div class="row mt-3">
			<div class="col">
				<form method="post" class="form-inline">
					<label for="tglAwal">Tanggal Awal:</label>
					<input type="date" name="tgl_mulaimsk" class="form-control ml-2 mr-3">
					<label for="tglAwal">Tanggal Akhir:</label>
					<input type="date" name="tgl_selesaimsk" class="form-control ml-2 mr-3">
					<select name="customer" class="form-control">
						<option value="">Pilih Customer</option>
						<?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer->titlecs; ?>"><?= $customer->titlecs; ?></option>
                        <?php endforeach; ?>
					</select>
					<button type="submit" name="filter_msk" class="btn btn-primary mt-3">
						<i class="fa-solid fa-sort"></i> Filter Data Masuk
					</button>
				</form>
			</div>
		</div>

		<div class="data-tables datatable-dark">
			<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal Masuk</th>
						<th>Part Name</th>
						<th>Part Number</th>
						<th>Spec Material</th>
						<th>Leader/Subcont</th>
						<th>Lokasi</th>
						<th>Customer</th>
						<th>Jumlah Masuk</th>
						<th>Satuan</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($masuk as $data): ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= date('d-m-Y', strtotime($data->tanggal)); ?></td>
						<td><?= $data->namabarang; ?></td>
						<td><?= $data->kd; ?></td>
						<td><?= $data->spek; ?></td>
						<td><?= $data->produsen; ?></td>
						<td><?= $data->lokasi; ?></td>
						<td><?= $data->customer; ?></td>
						<td><?= number_format($data->qty); ?></td>
						<td><?= $data->satuan; ?></td>
						<td><?= $data->keterangan; ?></td>
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