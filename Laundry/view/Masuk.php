<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>AAA Laundry </title>
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
    </head>
    <body class="d-flex flex-column">
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
                            <li class="nav-item"><a class="nav-link" href="Cucianku.php">Cucianku</a></li>
                            <?php
                            session_start();

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
            <!-- Page content-->
            <section class="py-5">
                <div class="container px-5">
                    <!-- Contact form-->
                    <div class="bg-light rounded-4 pb-5 px-4 px-md-5">
                        <div class="row pt-5 justify-content-center text-center">
                            <div class="col-lg-5 col-xl-5 p-4 bg-white rounded shadow-sm">
                                <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3">
                                    <i class="bi bi-person-badge-fill"></i>
                                </div>
                                <h1 class="fw-bolder mt-3 mb-5">Masuk</h1>
                                <form id="contactForm" method="post" action="../model/masuk.php?aksi=masuk">
                                    <!-- Username input-->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="Username" name="Username" placeholder="Masukkan Username" required>
                                        <label for="Username" class="form-label">Username</label>
                                        <div class="invalid-feedback" data-sb-feedback="name:required">Username tidak boleh kosong</div>
                                    </div>
                                    <!-- Password input-->
                                    <div class="form-floating mb-2">
                                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Masukkan Password" required>
                                        <label for="Password" class="form-label">Password</label>
                                        <div class="invalid-feedback" data-sb-feedback="name:required">Password tidak boleh kosong</div>
                                    </div>

                                    <div class="form-floating text-end">
                                        <a href="#">Lupa Password?</a>
                                    </div>
                                
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg bg-gradient mt-3" id="submitButton" type="submit">Masuk</button>
                                    </div>
                                    <div class="d-grid">
                                        <a href="Daftar.php" class="btn btn-outline-dark btn-lg bg-gradient mt-3" id="submitButton" type="submit">Daftar Sekarang</a>
                                    </div>
                                </form>
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
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
