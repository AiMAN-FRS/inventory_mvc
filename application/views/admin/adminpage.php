<style>
        a{
            text-decoration:none;
            color:black;
        }
    </style>
    
<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4 mb-4">ADMIN</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">Admin</li>
		</ol>		

		<div class="card mb-4">
			<div class="card-header d-flex justify-content-start">
				<!-- Button to Open the Modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					<i class="fa-solid fa-plus"></i> Tambah Admin
				</button>				

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Email</th>								
								<th style="text-align: center">Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; foreach ($admin as $data): ?>
							<tr>
								<td><?= $i++; ?></td>								
								<td><?= $data->email; ?></td>																
								
								</td>
								<td style="text-align: center">
									<button type="button" class="btn btn-warning" data-toggle="modal"
										data-target="#edit<?= $data->iduser ?>">
										<i class="fa-regular fa-pen-to-square"></i> Edit
									</button>
									<button type="button" class="btn btn-danger" data-toggle="modal"
										data-target="#delete<?= $data->iduser; ?>">
										<i class="fa-solid fa-trash-can"></i> Delete
									</button>
								</td>
							</tr>

							<!-- Modal Edit (Dalam loop) -->
							<div class="modal fade" id="edit<?= $data->iduser ?>">
								<div class="modal-dialog">
									<div class="modal-content">

										<!-- Modal Header EDIT -->
										<div class="modal-header">
											<h4 class="modal-title">Form Edit Admin</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<!-- Modal body EDIT -->
										<form method="post" action="<?= base_url('admin/updateadmin'); ?>">
											<div class="modal-body">
												<label>Email</label>
												<input type="email" name="email" placeholder="Masukan Email" value="<?= $data->email ?>"
													class="form-control" required>
												<br>
												<label>Password</label>
												<div class="input-group">
													<input type="password" id="inputPasswordEdit<?= $data->iduser ?>" name="password"
														placeholder="Masukan Password Baru" class="form-control" required>
													<div class="input-group-append">
														<span class="input-group-text" id="togglePasswordEdit<?= $data->iduser ?>"
															style="cursor: pointer;">
															<i class="fas fa-eye"></i>
														</span>
													</div>
												</div>												
												
												<!-- type="hidden" u/ Trigger Modal (EDIT) -->
												<input type="hidden" name="iduser" value="<?= $data->iduser ?>"></input>
												<button type="submit" class="btn btn-primary mt-4" name="updateuser">Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- End Modal Edit -->

                            <!-- DELETE Modal --> 
							<div class="modal fade" id="delete<?= $data->iduser ?>">
								<div class="modal-dialog">
									<div class="modal-content">

										<!-- Modal Header DELETE -->
										<div class="modal-header">
											<h4 class="modal-title">Hapus Akun tersebut?</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<!-- Modal body DELETE -->
										<form method="post" action="<?= base_url('admin/hapusadmin'); ?>">
											<div class="modal-body">
												Anda Yakin, Ingin Hapus Admin <strong><?= $data->email ?></strong> ?
												<br>
												<!-- type="hidden" u/ Trigger Modal (EDIT) -->
												<input type="hidden" name="iduser" value="<?= $data->iduser ?>"></input>
												<button type="submit" class="btn btn-danger mt-4" name="hapususer">Hapus</button>
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
				<form method="post" action="<?= base_url('admin/tambahadmin'); ?>">
					<div class="modal-body">
						<label>Email</label>
						<input type="email" name="email" placeholder="Masukan Email" class="form-control" required>
						<br>
						<label>Password</label>
						<div class="input-group">
							<input type="password" id="inputPassword" name="password" placeholder="Masukan Password" class="form-control" required>
							<div class="input-group-append">
								<span class="input-group-text" id="togglePassword" style="cursor: pointer;">
									<i class="fas fa-eye" id="eyeIcon"></i>
								</span>
							</div>
						</div>
						<br>

						<button type="submit" class="btn btn-primary mt-4" name="addnewadmin">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<!-- Show Hide Password Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengambil semua elemen dengan ID 'togglePassword' secara dinamis
        document.querySelectorAll('[id^="togglePassword"]').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const passwordInput = this.closest('.input-group').querySelector('input[type="password"], input[type="text"]');
                const eyeIcon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        });
    });
</script>

</main>