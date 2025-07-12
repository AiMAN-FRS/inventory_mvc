    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; MHS UBSI <?php echo date("Y"); ?></div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div> <!-- close layoutSidenav_content -->
</div> <!-- close layoutSidenav -->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="<?= base_url('js/scripts.js'); ?>"></script>
<script src="<?= base_url('js/datatables-simple-demo.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

<!-- Select2 CSS dan JavaScript -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>

<!-- SELECT2 Punya BARANG MASUK -->
<script>
    // Bikin variabel JS dari PHP array
    var stockData = <?= json_encode($stok_barang); ?>;
    console.log(stockData); // Cek isi stok di console browser

    $(document).ready(function() {
        $('#barangnyaMsk').select2({
            placeholder: "Pilih Part Name (Part Number)",
            allowClear: false,
            width: '100%'
        });
        
        // Saat part dipilih
        $('#barangnyaMsk').on('change', function() {
            var barangId = $(this).val();
            if (barangId && stockData[barangId] !== undefined) {
                $('#currentStockMsk').val(stockData[barangId]);
            } else {
                $('#currentStockMsk').val('');
            }
        });
    });

</script>

<!-- SELECT2 Punya BARANG KELUAR -->
<script>
    // Bikin variabel JS dari PHP array
    var stockData = <?= json_encode($stok_barang); ?>;
    console.log(stockData); // Cek isi stok di console browser

    $(document).ready(function() {
        $('#barangnyaKlr').select2({
            placeholder: "Pilih Part Name (Part Number)",
            allowClear: false,
            width: '100%'
        });
        
        // Saat part dipilih
        $('#barangnyaKlr').on('change', function() {
            var barangId = $(this).val();
            if (barangId && stockData[barangId] !== undefined) {
                $('#currentStockKlr').val(stockData[barangId]);
            } else {
                $('#currentStockKlr').val('');
            }
        });
    });

</script>

</body>
</html>
