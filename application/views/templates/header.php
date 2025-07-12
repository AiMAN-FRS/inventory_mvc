<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock App</title>
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/3139263.png'); ?>" rel="icon" type="image/gif" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>    
    <script src="https://kit.fontawesome.com/b79720072c.js" crossorigin="anonymous"></script>

    <!-- Init DataTables -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- <a class="navbar-brand" href="#">Stock App</a> -->
    <a class="navbar-brand" href="<?= base_url('dashboard'); ?>">
        <img src="<?= base_url('assets/Stock_App-BRANDD__removebg-preview.png'); ?>" alt="logo" width="100%">
    </a>
    <button class="btn btn-link btn-sm" id="sidebarToggle"><i class="fas fa-bars"></i></button>
</nav>
