<!-- <php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Barang Masuk.xls");
?> -->

<html>

<head>
	<title>Daftar Stock Barang (Over)</title>
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

	<!--CSS table -->
    <style>
        a{
            text-decoration:none;
            color:black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* Warna untuk header Min Stock */
        th:nth-child(10) {
            background-color: yellow !important; /* Warna Kuning */
        }
        td:nth-child(10) {
            background-color: yellow !important; /* Warna Kuning */
        }

        /* Warna untuk header Max Stock */
        th:nth-child(11) {
            background-color: #acdf87 !important; /* Warna Hijau */
        }
        td:nth-child(11) {
            background-color: #acdf87 !important; /* Warna Hijau */
        }

        /* Warna untuk header Status */
        td:nth-child(12) {
            background-color:  #90e0ef !important; /* Warna Biru */
        }
    </style>

</head>

<body>
	<div class="container">
		<h2>Stock Barang (Over Stock)</h2>
		<h4>(Stock App)</h4>

		<div class="data-tables datatable-dark">
			<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
				<thead>
					<tr>
                        <th>No</th>
                        <th>Part Name</th>
                        <th>Part Number</th>
                        <th>Spec Material</th>
                        <th>Leader/Subcont</th>
                        <th>Lokasi</th>
                        <th>Customer</th>
                        <th>Stock</th>
                        <th>Satuan</th>
                        <th>Min Stock</th>
                        <th>Max Stock</th>
                        <th>Status</th>
                    </tr>
				</thead>
				<tbody>
					<?php $i=1; foreach($stock_over as $data): ?>
						<?php if ($data->stock > $data->max_stock): ?>
                            <tr>
                            	<td><?= $i++; ?></td>
                            	<td><?= $data->namabarang ?></td>
                            	<td><?= $data->kd ?></td>
                            	<td><?= $data->spek ?></td>
                            	<td><?= $data->produsen ?></td>
                            	<td><?= $data->lokasi ?></td>
                            	<td><?= $data->customer ?></td>
                            	<td><?= $data->stock ?></td>
                            	<td><?= $data->satuan ?></td>
                            	<td><?= $data->min_stock ?></td>
                            	<td><?= $data->max_stock ?></td>
                            	<td align="center"><b>OVER</b></td>
                            </tr>
                        <?php endif; ?>
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