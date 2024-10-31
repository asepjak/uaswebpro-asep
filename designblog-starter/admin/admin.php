<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin Panel</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Admin Panel</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="../index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Back to Homepage
                        </a>
                        
                        <a class="nav-link" href="admin.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        
                        <div class="sb-sidenav-menu-heading">Kategori</div>
                        <a class="nav-link" href="teknologi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-laptop"></i></div>
                            Teknologi
                        </a>
                        <a class="nav-link" href="lifestyle.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sun"></i></div>
                            Lifestyle
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Publikasi</th>
                                        <th>Gambar</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../database/config.php'; // Menghubungkan dengan database

                                    // Mengambil data terbaru dari tabel artikel
                                    $sql = "SELECT * FROM artikel ORDER BY id DESC";
                                    $result = $conn->query($sql);

                                    // Menampilkan data di tabel
                                    if ($result->num_rows > 0) {
                                        while ($b = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$b['id']}</td>
                                                    <td>{$b['judul']}</td>
                                                    <td>" . substr($b['isi'], 0, 50) . "...</td>
                                                    <td>{$b['kategori']}</td>
                                                    <td>{$b['tanggal_publikasi']}</td>
                                                    <td><img src='{$b['images']}' alt='Gambar' style='width: 50px;'></td>
                                                    <td>{$b['view']}</td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>Tidak ada berita</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
