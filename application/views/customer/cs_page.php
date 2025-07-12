    <style>
    	.card-img-top {
    		width: 100%;
    		height: 200px;
    		object-fit: contain;
    		/* Gambar terpotong agar sesuai */
    	}

    	.zoomable {
    		transition: transform 0.3s ease;
    		/* Menambahkan transisi pada gambar */
    	}

    	.zoomable:hover {
    		transform: scale(1.2);
    	}

    	a {
    		text-decoration: none;
    		color: black;
    	}
    </style>

    <main>
    	<div class="container-fluid px-4">
    		<h1 class="mt-4 mb-4">CUSTOMER</h1>
    		<ol class="breadcrumb mb-4">
    			<li class="breadcrumb-item active">Customer</li>
    		</ol>

    		<div class="card mb-4">
    			<div class="card-header d-flex justify-content-start">
    				<!-- Button to Open the Modal -->
    				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    					<i class="fa-solid fa-plus"></i> Tambah Customer
    				</button>

    			</div>
    			<div class="card-body">
    				<div class="row">

    					<?php foreach ($customer as $data): ?>
                            
                            <div class="col-md-3 mb-3">
                                <div class="card mx-auto">
                                    <?php if (!empty($data->imagecs)) : ?>
                                        <img src="<?= base_url('assets/img/' . $data->imagecs); ?>"
                                            class="card-img-top zoomable">
                                        <?php else : ?>
                                        <img src="<?= base_url('assets/No_photo_cleanup.png'); ?>"
                                            class="card-img-top zoomable">
                                        <?php endif; ?>
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $data->titlecs; ?></h4>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="fa-solid fa-phone"></i>
                                            <?= $data->telpcs; ?>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#edit<?= $data->idcustomer; ?>">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#delete<?= $data->idcustomer; ?>">
                                            <i class="fa-solid fa-trash-can"></i> Delete
                                        </button>										
                                        <a class="btn btn-primary" href="<?= base_url('customer/detail_barang/' . urlencode($data->titlecs)) ?>" role="button">
											Lihat Barang
										</a>    
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit (Dalam loop) -->
                            <div class="modal fade" id="edit<?= $data->idcustomer ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header EDIT -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Form Edit Customer</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body EDIT -->
                                        <form method="post" enctype="multipart/form-data" action="<?= base_url('customer/updatecs'); ?>">
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                	<div class="col">
                                                		<label>Nama Customer</label>
                                                		<input type="text" name="titlecs" value="<?= $data->titlecs ?>"
                                                			class="form-control" required>
                                                	</div>
                                                	<div class="col">
                                                		<label>No Telp</label>
                                                		<input type="text" name="telpcs" value="<?= $data->telpcs ?>"
                                                			class="form-control" required>
                                                	</div>
                                                </div>
                                                <div class="row mb-3">
                                                	<div class="col">
                                                		<label>File Gambar</label>
                                                		<input type="file" name="file" class="form-control">
                                                	</div>
                                                </div>

                                                <!-- type="hidden" u/ Trigger Modal (EDIT) -->
                                                <input type="hidden" name="idcustomer" value="<?= $data->idcustomer ?>"></input>
                                                <button type="submit" class="btn btn-primary mt-4"
                                                    name="updatecustomer">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Edit -->

                            <!-- DELETE Modal -->
                            <div class="modal fade" id="delete<?= $data->idcustomer ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header DELETE -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Customer tersebut?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body DELETE -->
                                        <form method="post" action="<?= base_url('customer/hapuscs'); ?>">
                                            <div class="modal-body">
                                                Anda Yakin, Ingin Hapus Customer <strong><?= $data->titlecs ?></strong> ?
                                                <br>
                                                <!-- type="hidden" u/ Trigger Modal (EDIT) -->
                                                <input type="hidden" name="idcustomer" value="<?= $data->idcustomer ?>"></input>
                                                <button type="submit" class="btn btn-danger mt-4"
                                                    name="hapuscustomer">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Hapus -->							

    					<?php endforeach; ?>
    				</div>
    			</div>
    		</div>
    	</div>

    	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    		crossorigin="anonymous">
    	</script>
    	<script src="js/scripts.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
    	</script>
    	<script src="assets/demo/chart-area-demo.js"></script>
    	<script src="assets/demo/chart-bar-demo.js"></script>
    	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous">
    	</script>
    	<script src="assets/demo/datatables-demo.js"></script>

    	<!-- Modal (TAMBAH ADMIN) -->
    	<div class="modal fade" id="myModal">
    		<div class="modal-dialog">
    			<div class="modal-content">

    				<!-- Modal Header -->
    				<div class="modal-header">
    					<h4 class="modal-title">Form Tambah Admin</h4>
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>

    				<!-- Modal Body -->
    				<form method="post" enctype="multipart/form-data" action="<?= base_url('customer/tambahcs'); ?>">
    					<div class="modal-body">
    						<div class="row mb-3">
    							<div class="col">
    								<label>Nama Customer</label>
    								<input type="text" name="titlecs" placeholder="Masukan Nama Customer" class="form-control"
    									required>
    							</div>
    							<div class="col">
    								<label>No Telp</label>
    								<input type="text" name="telpcs" placeholder="Masukan No Telphone" class="form-control"
    									required>
    							</div>
    						</div>

    						<div class="row mb-3">
    							<div class="col">
    								<label>File Gambar</label>
    								<input type="file" name="file" class="form-control"></input>
    							</div>
    						</div>

    						<button type="submit" class="btn btn-primary mt-4" name="addnewcustomer">Submit</button>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>

    </main>