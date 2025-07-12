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
            background-color: yellow; /* Warna Kuning */
        }
        td:nth-child(10) {
            background-color: yellow; /* Warna Kuning */
        }

        /* Warna untuk header Max Stock */
        th:nth-child(11) {
            background-color: #acdf87; /* Warna Hijau */
        }
        td:nth-child(11) {
            background-color: #acdf87; /* Warna Hijau */
        }

        /* Warna untuk header Status */
        td:nth-child(12) {
            background-color: yellow; /* Warna Kuning */
        }

    </style>
    
<main>
    <div class="container-fluid">
        <h1 class="mt-4 mb-4">WARNING STOCK</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="<?= base_url('dashboard'); ?>">Stock Barang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Warning Stock</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <!-- Button to Open the Modal -->
                <a href="<?= base_url('export/export_warning'); ?>" target="_blank" class="btn btn-info">
                    <i class="fa-solid fa-file-arrow-down"></i> Export Data
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-4" role="alert">
                    <b>INFO!</b> Berikut adalah daftar stock barang dalam status <b>"WARNING"</b>.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <?php  $i = 1; foreach ($stock_warning as $barang): ?>
                                <?php if ($barang->stock < $barang->min_stock || $barang->stock == $barang->min_stock): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $barang->namabarang ?></td>
                                    <td><?= $barang->kd ?></td>
                                    <td><?= $barang->spek ?></td>
                                    <td><?= $barang->produsen ?></td>
                                    <td><?= $barang->lokasi ?></td>
                                    <td><?= $barang->customer ?></td>
                                    <td><?= $barang->stock ?></td>
                                    <td><?= $barang->satuan ?></td>
                                    <td><?= $barang->min_stock ?></td>
                                    <td><?= $barang->max_stock ?></td>
                                    <td align="center"><b>WARNING</b></td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>

