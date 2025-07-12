	<style>
        a{
            text-decoration:none;
            color:black;
        }
    </style>

<main>
	<div class="container-fluid">
		<h1 class="mt-4 mb-4">BARANG KELUAR</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active"><a href="<?= base_url('dashboard'); ?>">Stock Barang</a></li>
			<li class="breadcrumb-item active" aria-current="page">Barang Keluar</li>
		</ol>
		<div class="card mb-4">
			<div class="card-header">
				<!-- Button to Open the Modal -->
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
					<i class="fa-solid fa-plus"></i> Barang Keluar
				</button>
				<a href="<?= base_url('export/barang_keluar'); ?>" target="_blank" class="btn btn-info">
					<i class="fa-solid fa-file-arrow-down"></i> Export Data
				</a>
				<br>
				<div class="row mt-3">
					<div class="col">
						<!-- Filter Form -->
						<form action="<?= base_url('keluar/barangkeluar') ?>" method="post" class="form-inline mb-3">
							<div class="form-group mx-sm-3">
								<label>Mulai: </label>
								<input type="date" name="tgl_mulaiklr" class="form-control ml-2">
							</div>
							<div class="form-group mx-sm-3">
								<label>Selesai: </label>
								<input type="date" name="tgl_selesaiklr" class="form-control ml-2">
							</div>
							<div class="form-group mx-sm-3">
								<label>Customer: </label>
								<select name="customer" class="form-control ml-2">
									<option value="">Pilih Customer</option>
									<?php foreach($customerList as $cust): ?>
										<option value="<?= $cust['customer'] ?>"><?= $cust['customer'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<button type="submit" name="filter_klr" class="btn btn-primary ml-2"><i class="fa-solid fa-sort"></i> Filter Keluar</button>
						</form>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Kode</th>
								<th>Nama Barang</th>
								<th>Spesifikasi</th>
								<th>Produsen</th>
								<th>Lokasi</th>
								<th>Customer</th>
								<th>Qty</th>
								<th>Satuan</th>
								<th>Penerima</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach($barangkeluar as $data): ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= date('d-m-Y', strtotime($data['tanggal'])) ?></td>
								<td><?= $data['kd'] ?></td>
								<td><?= $data['namabarang'] ?></td>
								<td><?= $data['spek'] ?></td>
								<td><?= $data['produsen'] ?></td>
								<td><?= $data['lokasi'] ?></td>
								<td><?= $data['customer'] ?></td>
								<td><b><?= number_format($data['qty']) ?></b></td>
								<td><i><?= $data['satuan'] ?></i></td>
								<td><?= $data['penerima'] ?></td>
								<td style="text-align: center">
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $data['idkeluar'] ?>">
										<i class="fa-regular fa-pen-to-square"></i> Edit
									</button>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $data['idkeluar'] ?>">
										<i class="fa-solid fa-trash-can"></i> Delete
									</button>
								</td>
							</tr>

							<!-- EDIT Modal -->
							<div class="modal fade" id="edit<?= $data['idkeluar'] ?>">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">

										<!-- Modal Header EDIT -->
										<div class="modal-header">
											<h4 class="modal-title">Form Edit Item Out</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<!-- Modal body EDIT -->
										<form method="post" action="<?= base_url('keluar/updatebarangkeluar') ?>">
											<div class="modal-body">
												<div class="row mb-3">
													<div class="col">
														<label for="">Tanggal keluar</label>
														<input type="text" name="tanggal" value="<?= date('d/m/Y', strtotime($data['tanggal'])) ?>" 
															class="form-control" disabled>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col">
														<label>Part Name</label>
														<input type="text" name="namabarang" value="<?= $data['namabarang'] ?>" 
															class="form-control" disabled>
													</div>
													<div class="col">
														<label>Part Number</label>
														<input type="text" name="kd" value="<?= $data['kd'] ?>" 
															class="form-control" disabled>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col">
														<label>Spec Material</label>
														<input type="text" name="spek" value="<?= $data['spek'] ?>" 
														class="form-control" disabled>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col">
														<label>Leader/Subcont</label>
														<input type="text" name="produsen" value="<?= $data['produsen'] ?>" 
															class="form-control" disabled>
													</div>
													<div class="col">
														<label>Lokasi</label>
														<input type="text" name="lokasi" value="<?= $data['lokasi'] ?>" 
															class="form-control" disabled>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col">
														<label>Jumlah Keluar</label>
														<input type="number" name="qty" value="<?= number_format($data['qty']) ?>" class="form-control" required>
													</div>
													<div class="col">
														<label>Satuan</label>
														<input type="text" name="satuan" value="<?= $data['satuan'] ?>" class="form-control" readonly>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col">
														<label>Penerima</label>
														<input type="text" name="penerima" value="<?= $data['penerima'] ?>" class="form-control"
															required>
													</div>
												</div>

												<!-- type="hidden" u/ Trigger Modal (EDIT) -->
												<input type="hidden" name="idbarang" value="<?= $data['idbarang'] ?>"></input>
												<input type="hidden" name="idk" value="<?= $data['idk'] ?>"></input>
												<button type="submit" class="btn btn-primary btn-block mt-5" name="updatebarangkeluar">
													Update
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- DELETE Modal -->
							<div class="modal fade" id="delete<?= $data['idkeluar'] ?>">
								<div class="modal-dialog">
									<div class="modal-content">

										<!-- Modal Header DELETE -->
										<div class="modal-header">
											<h4 class="modal-title">Delete the Item?</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<!-- Modal body DELETE -->
										<form method="post" action="<?= base_url('keluar/hapusbarangkeluar') ?>">
											<div class="modal-body">
												<h5>Anda Yakin, Ingin Hapus Transaksi Keluar?</h5>
												<br>
													<h5 style="text-align: right" class="mt-2 mb-2"><b><?= date('d/m/Y', strtotime($data['tanggal'])) ?></b></h5>
												<h5><b><?= $data['namabarang'] ?> <i>(<?= $data['kd'] ?>)</i></b></h5>
												
												<br>
												<!-- type="hidden" u/ Trigger Modal (DELETE) -->
												<input type="hidden" name="idbarang" value="<?= $data['idbarang'] ?>"></input>
												<input type="hidden" name="kty" value="<?= $data['qty'] ?>"></input>
												<input type="hidden" name="idk" value="<?= $data['idk'] ?>"></input>
												<button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Form Add Item Outgoing</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" action="<?= base_url('keluar/tambahkeluar') ?>">
                <div class="modal-body">
                    <label for=""><b>Tanggal Keluar</b></label>
                    <input type="date" name="tanggal" class="form-control" required>
                    <br>
                    <label><b>Part Name (Part Number)</b></label>
						<select name="barangnya" id="barangnyaKlr" class="form-control select2" required>
						<option value=""></option>
							<?php foreach ($barang as $b) : ?>
								<option value="<?= $b['idbarang'] ?>"><?= $b['namabarang'] ?> (<?= $b['kd'] ?>)</option>
							<?php endforeach; ?>
						</select>
                    <br>
                    <br>
                    <label><b>Stock Sekarang</b></label>
                    <input type="text" name="stock" id="currentStockKlr" class="form-control" disabled>
                    <br>
                    <label><b>Quantity</b></label>
                    <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                    <br>
                    <label><b>Keterangan</b></label>
                    <input type="text" name="penerima" placeholder="Keterangan" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="tambahbarangkeluar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .select2-container .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px) !important;
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
    }
    
</style>

</main>