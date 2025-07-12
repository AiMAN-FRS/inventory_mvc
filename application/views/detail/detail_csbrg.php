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
    		<h1 class="mt-4 mb-4">DAFTAR BARANG</h1>
    		<ol class="breadcrumb mb-4">
    			<li class="breadcrumb-item active">Detail Barang</li>
    		</ol>

    		<div class="card mb-4">
    			<div class="card-header d-flex justify-content-start">
                    <h3 class="mt-2"><?= $customer; ?></h3>
    			</div>
    			<div class="card-body">
    				<div class="row">

    					<?php foreach ($barang as $data): ?>
                            
                            <div class="col-md-3 mb-3">
                                <div class="card mx-auto">
                                    <?php if (!empty($data->gambar)) : ?>
                                        <img src="<?= base_url('uploads/' . $data->gambar); ?>"
                                            class="card-img-top zoomable">
                                        <?php else : ?>
                                        <img src="<?= base_url('assets/No_photo_cleanup.jpg'); ?>"
                                            class="card-img-top zoomable">
                                        <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $data->namabarang; ?></h5>
                                        <h6 class="card-title"><?= $data->kd; ?></h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <b>Spesifikasi :</b> <?= $data->spek; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Leader/Subcont :</b> <?= $data->produsen; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Lokasi :</b> <?= $data->lokasi; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Customer :</b> <?= $data->customer; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Stock :</b> <?= $data->stock; ?> <?= $data->satuan; ?>
                                        </li>
                                        <li class="list-group-item">
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
                                        </li>

                                    </ul>
                                    
                                </div>
                            </div>                                                        							

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

    </main>