    <style>
        a{
            text-decoration:none;
            color:black;
        }
    </style>
    
<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4 mb-4">STOCK BARANG</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">Stock Barang</li>
		</ol>
		<div class="row mt-4">
			<div class="col-xl-3 col-md-6">
				<div class="card bg-danger text-white mb-4">
					<div class="card-body"><i>Danger Stock</i> <span
							class="badge badge-light ml-2"><?= $notif['habis']; ?></span></div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" href="<?= base_url('stock/notif_dgr'); ?>">View Details</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6">
				<div class="card bg-warning text-black mb-4">
					<div class="card-body"><i>Warning Stock</i> <span
							class="badge badge-light ml-2"><?= $notif['mau_habis']; ?></span></div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-black stretched-link" href="<?= base_url('stock/notif_wrng'); ?>">View Details</a>
						<div class="small text-black"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6">
				<div class="card bg-primary text-white mb-4">
					<div class="card-body"><i>Over Stock</i> <span
							class="badge badge-light ml-2"><?= $notif['berlebih']; ?></span></div>
					<div class="card-footer d-flex align-items-center justify-content-between">
						<a class="small text-white stretched-link" href="<?= base_url('stock/notif_over'); ?>">View Details</a>
						<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					</div>
				</div>
			</div>

		</div>

		<div class="card mb-4">
			<div class="card-header d-flex justify-content-start">
				<!-- Button to Open the Modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					<i class="fa-solid fa-plus"></i> Add Item
				</button>

				<!-- Export Data Button -->
				<a href="<?= base_url('export/export_stock'); ?>" target="_blank" class="btn btn-info ml-3">
					<i class="fa-solid fa-file-arrow-down"></i> Export Data
				</a>

				<form method="post" class="form-inline ml-auto">
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
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Image</th>
								<th>Part Name</th>
								<th>Part Number</th>
								<th>Spec Material</th>
								<th>Leader / Subcont</th>
								<th>Customer</th>
								<th>Stock</th>
								<th>Unity</th>
								<th>Location</th>
								<th>Min Stock</th>
								<th>Max Stock</th>
								<th>Status</th>
								<th style="text-align: center">Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; foreach ($stock as $data): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td align="center">
									<img src="<?= $data->gambar ? base_url('uploads/'.$data->gambar) : base_url('assets/No_photo_cleanup.jpg') ?>"
										width="50">
								</td>
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
								<td style="text-align: center">
									<button type="button" class="btn btn-warning mb-1" data-toggle="modal"
										data-target="#edit<?= $data->idbarang ?>">
										<i class="fa-regular fa-pen-to-square"></i> Edit
									</button>
									<button type="button" class="btn btn-danger" data-toggle="modal"
										data-target="#delete<?= $data->idbarang; ?>">
										<i class="fa-solid fa-trash-can"></i> Delete
									</button>
								</td>
							</tr>

							<!-- Modal Edit (Dalam loop) -->
							<div class="modal fade" id="edit<?= $data->idbarang ?>">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Edit Item</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<form method="post" enctype="multipart/form-data"
											action="<?= base_url('stock/update'); ?>">
											<div class="modal-body">
												<!-- Isi Form Edit (Isi dari database) -->
												<div class="row mb-3">
													<div class="col">
														<label><b>Part Name</b></label>
														<input type="text" name="namabarang"
															value="<?= $data->namabarang ?>" class="form-control"
															required>
													</div>
													<div class="col">
														<label><b>Part Number</b></label>
														<input type="text" name="kd" value="<?= $data->kd ?>"
															class="form-control" required>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col">
														<label><b>Spec Material</b></label>
														<input type="text" name="spek" value="<?= $data->spek ?>"
															class="form-control" required>
													</div>
												</div>

												<div class="row mb-3">
                                                    <div class="col">
                                                    	<label><b>Leader/Subcont</b></label>
                                                    	<input type="text" name="produsen" value="<?= $data->produsen ?>" 
                                                            class="form-control" required>
                                                    </div>
													<div class="col">
														<label><b>Customer</b></label>
														<select name="customer" class="form-control" required>
															<option value="">Pilih Customer</option>
															<?php foreach ($customers as $cs): ?>
															<option value="<?= $cs->titlecs ?>"
																<?= $cs->titlecs == $data->customer ? 'selected' : '' ?>>
																<?= $cs->titlecs ?>
															</option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>

                                                <div class="row mb-3">
                                                	<div class="col">
                                                		<label><b>Stock Item</b></label>
                                                		<input  type="number" name="stock" value="<?= $data->stock ?>" class="form-control" required>
                                                	</div>
                                                	<div class="col">
                                                		<label><b>Unity</b></label>
                                                		<select name="satuan"
                                                			class="form-control" required>
                                                			<option value="">Pilih Satuan</option>
                                                			<option value="Pcs" <?= $data->satuan == 'Pcs' ? 'selected' : '' ?>>
                                                				Pcs</option>
                                                			<option value="Unit"
                                                				<?= $data->satuan == 'Unit' ? 'selected' : '' ?>>
                                                                Unit</option>
                                                		</select>
                                                	</div>
                                                </div>

                                                <div class="row mb-3">
                                                	<div class="col">
                                                		<label><b>Location</b></label>
                                                		<input type="text" name="lokasi" value="<?= $data->lokasi ?>" class="form-control"
                                                			required>
                                                	</div>
                                                </div>

                                                <div class="row mb-3">
                                                	<div class="col">
                                                		<label><b>Min Stock</b></label>
                                                		<input type="number" name="min_stock" value="<?= $data->min_stock ?>" class="form-control"
                                                			required>
                                                	</div>
                                                	<div class="col">
                                                		<label><b>Max Stock</b></label>
                                                		<input type="number" name="max_stock" value="<?= $data->max_stock ?>" class="form-control"
                                                			required>
                                                	</div>
                                                </div>

                                                <div class="row mb-3">
                                                	<div class="col">
                                                		<label><b>File Image</b></label>
                                                		<input type="file" name="file" class="form-control"></input>
                                                	</div>
                                                </div>

												<!-- Hidden ID -->
												<input type="hidden" name="idbarang" value="<?= $data->idbarang ?>">

												<button type="submit"
													class="btn btn-primary mt-4 btn-block">Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- End Modal Edit -->

                            <!-- DELETE Modal -->
                            <div class="modal fade" id="delete<?= $data->idbarang ?>">
                            	<div class="modal-dialog">
                            		<div class="modal-content">

                            			<!-- Modal Header DELETE -->
                            			<div class="modal-header">
                            				<h4 class="modal-title">Delete the Item?</h4>
                            				<button type="button" class="close" data-dismiss="modal">&times;</button>
                            			</div>

                            			<!-- Modal body DELETE -->
                            			<form method="post" action="<?= base_url('stock/hapus'); ?>">
                            				<div class="modal-body">
                            					Apakah Anda Yakin Ingin Hapus Item?
                            					<br>
                            					<br>
                                                    <h6><b><?= $data->namabarang ?></b> <i>(<?= $data->kd ?>)</i></h6>
                            					<br>
                            					<!-- type="hidden" u/ Trigger Modal (EDIT) -->
                            					<input type="hidden" name="idbarang" value="<?= $data->idbarang ?>"></input>
                            					<button type="submit" class="btn btn-danger"
                            						name="hapusbarang">Delete</button>
                            				</div>
                            			</form>
                            		</div>
                            	</div>
                            </div>
                            <!-- End Modal Hapus -->

							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
	</script>
	<script src="js/scripts.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/chart-area-demo.js"></script>
	<script src="assets/demo/chart-bar-demo.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/datatables-demo.js"></script>

	<!-- The Modal (TAMBAH BARANG) -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Form Add Item</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form method="post" enctype="multipart/form-data" action="<?= base_url('stock/tambah'); ?>">
					<div class="modal-body">
						<div class="row mb-3">
							<div class="col">
								<label><b>Part Name</b></label>
								<input type="text" name="namabarang" class="form-control" required>
							</div>
							<div class="col">
								<label><b>Part Number</b></label>
								<input type="text" name="kd" class="form-control" required>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col">
								<label><b>Spec Material</b></label>
								<input type="text" name="spek" class="form-control" required>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col">
								<label><b>Leader/Subcont</b></label>
								<input type="text" name="produsen" class="form-control" required>
							</div>
							<div class="col">
								<label><b>Customer</b></label>
								<select name="customer" class="form-control" required>
									<option value="">Pilih Customer</option>
									<?php foreach ($customers as $cs): ?>
									<option value="<?= $cs->titlecs ?>"><?= $cs->titlecs ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col">
								<label><b>Stock Item</b></label>
								<input type="number" name="stock" class="form-control" required>
							</div>
							<div class="col">
								<label><b>Unity</b></label>
								<select name="satuan" class="form-control" required>
									<option value="">Pilih Satuan</option>
									<option value="Pcs">Pcs</option>
									<option value="Unit">Unit</option>
								</select>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col">
								<label><b>Location</b></label>
								<input type="text" name="lokasi" class="form-control" required>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col">
								<label><b>Min Stock</b></label>
								<input type="number" name="min_stock" class="form-control" required>
							</div>
							<div class="col">
								<label><b>Max Stock</b></label>
								<input type="number" name="max_stock" class="form-control" required>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col">
								<label><b>File Image</b></label>
								<input type="file" name="file" class="form-control">
							</div>
						</div>

						<button type="submit" class="btn btn-primary btn-block mt-4">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</main>