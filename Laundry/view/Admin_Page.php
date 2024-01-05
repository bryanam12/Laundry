<?php
   session_start();

    require_once "../controller/admin.php";
    
    // Periksa jika pengguna tidak login atau bukan admin
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header('location: ../view/Masuk.php');
        exit;
    } 
    
    $username = $_SESSION['username'];
    
    $admin = new Admin();
    
    // Periksa jika pengguna adalah admin
    if ($admin->is_admin($username)) {
        $total_harga    = $admin->get_total_harga();
        $cucian_proses  = $admin->get_status_cucian_proses();
        $cucian_selesai = $admin->get_status_cucian_selesai();
    } else {
        // Pengguna bukan admin, redirect ke index.php atau halaman lainnya
        header('location: index.php');
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AAA Laundry Admin dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/badge.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">AAA Laundry</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="ml-auto">
                        <a href="#" class="ml-3"><?= $_SESSION['username']; ?></a>
                        <a href="../model/masuk.php?aksi=logout" class="ml-3">Log Out</a>
                    </div>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Selamat Datang Admin </h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Pendapatan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= $total_harga?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cucian dalam proses
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $cucian_proses?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Cucian selesai</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cucian_selesai?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow h-100 py-2">

                            <?php
                            $admin = new Admin();
                            $data_cucian = $admin->get_laundry_data();
                            ?>

                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Id Cucian</th>
                                            <th class="d-none d-xl-table-cell">Nama Pelanggan</th>
                                            <th class="d-none d-xl-table-cell">Berat Cucaian (Kg)</th>
                                            <th class="d-none d-xl-table-cell">Total Harga</th>
                                            <th class="d-none d-md-table-cell">Tanggal Mulai</th>
                                            <th class="d-none d-md-table-cell">Status Pembelian</th>
                                            <th class="d-none d-md-table-cell">Status Selesai</th>
                                            <th class="d-none d-md-table-cell">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody id="detail-pembelian-table-body">
                                    <?php foreach ($data_cucian as $cucian) { ?>
                                        <tr>
                                            <td><?= $cucian['id_cucian']; ?></td>
                                            <td class="d-none d-xl-table-cell"><?= $cucian['nama']; ?></td>
                                            <td class="d-none d-xl-table-cell"><?= $cucian['berat']; ?></td>
                                            <td class="d-none d-xl-table-cell"><?= $cucian['harga']; ?></td>
                                            <td class="d-none d-xl-table-cell"><?= $cucian['tanggal_mulai']; ?></td>
                                            <td class="d-none d-md-table-cell">
                                            <span id="statusBadge" class="badge <?= $cucian['status'] === 'siap diambil' ? 'badge-success' : ($cucian['status'] === 'proses' ? 'badge-primary' : ($cucian['status'] === 'hapus' ? 'badge-dark' : 'badge-danger')); ?>">
                                            <?= $cucian['status']; ?>
                                            </span> 

                                            </td>
                                            <td class="d-none d-md-table-cell"><?= $cucian['tanggal_selesai']; ?></td>
                                            <td class="d-none d-md-table-cell">
                                                <a href="../model/Update_Cucian.php?aksi=proses&id=<?= $cucian['id_cucian'];?>" class="btn btn-primary btn-sm" onclick="return confirm('Apakah Anda yakin ingin memproses cucian ini?')">Proses</a>
                                                <a href="../model/Update_Cucian.php?aksi=selesai&id=<?= $cucian['id_cucian'];?>" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan cucian ini?')">Selesai</a>
                                                <a href="../model/Update_Cucian.php?aksi=hapus&id=<?= $cucian['id_cucian'];?>" class="btn btn-sm" style="background-color: black; color: white; font-weight: bold;" onclick="return confirm('Apakah Anda yakin ingin menghapus cucian ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../controller/js/PesanLaundry.js"></script>
</body>

</html>