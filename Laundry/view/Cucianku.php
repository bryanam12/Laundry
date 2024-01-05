<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header('location: ../view/Masuk.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail Cucian</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/badge.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100 bg-light">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">AAA Laundry</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="Pesan_Cucian.php">Pesan Cucian</a></li>
                            <li class="nav-item"><a class="nav-link active text-primary" href="#">Cucianku</a></li>
                            <?php
                            if(isset($_SESSION['username'])) {
                                // Jika pengguna sudah login
                                $username = $_SESSION['username'];
                                echo '<li class="nav-item btn me-3" style="border: 1px solid #1e30f3;"><i class="bi bi-person-badge-fill"></i><a class="text-primary fw-bolder me-3" href="Admin_Page.php" style="text-decoration: none;">' . $username . '</a></li>';

                                echo '<li class="nav-item"><a class="btn text-primary fw-bolder" href="../model/masuk.php?aksi=logout" style="border: 1px solid #1e30f3;">Log out</a></li>';
                            } else {
                                // Jika pengguna belum login
                                echo '<li class="nav-item"><a class="btn btn-primary text-white me-3" href="Daftar.php">Daftar</a></li>';
                                echo '<li class="nav-item"><a class="btn btn-dark text-white" href="Masuk.php">Masuk</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Projects Section-->
            <section class="py-5">
                <div class="container px-5 mb-5">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Status Cucianku</span></h1>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-12 col-xl-12 col-xxl-12">
                            <!-- Project Card 1-->
                            <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                                <div class="card-body p-5">
                                    <div class="d-flex align-items-center">
                                    <?php
                                        include "../controller/pelanggan.php";
                                        $pelanggan = new Pelanggan();
                                        $data_cucian = $pelanggan->get_laundry_data($_SESSION['id_pelanggan']);
                                    ?>

                                    <?php if (empty($data_cucian)): ?>
                                        <p>Tidak ada pesanan cucian yang tersedia.</p>
                                        <?php else: ?>
                                        <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th>Id Cucian</th>
                                                <th class="d-none d-xl-table-cell">Nama Pelanggan</th>
                                                <th class="d-none d-xl-table-cell">Berat Cucian (Kg)</th>
                                                <th class="d-none d-xl-table-cell">Total Harga</th>
                                                <th class="d-none d-md-table-cell">Tanggal Mulai</th>
                                                <th class="d-none d-md-table-cell">Status Selesai</th>
                                                <th class="d-none d-md-table-cell">Status Cucian</th>
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
                                                <td class="d-none d-md-table-cell"><?= $cucian['tanggal_selesai']; ?></td>
                                                <td class="d-none d-md-table-cell">
                                                <span id="statusBadge" class="badge <?= $cucian['status'] === 'siap diambil' ? 'badge-success' : ($cucian['status'] === 'proses' ? 'badge-primary' : 'badge-danger'); ?>">
                                                <?= $cucian['status']; ?>
                                            </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                        </tbody>
                                        </table>
                                    <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Your Website 2023</div></div>
                    <div class="col-auto">
                        <a class="small" href="#!">Privacy</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Terms</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
