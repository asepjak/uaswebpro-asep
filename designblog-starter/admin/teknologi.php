<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Tambah Berita Teknologi - Admin Panel" />
    <meta name="author" content="Admin" />
    <title>Tambah Berita Teknologi - Admin Panel</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <?php include '../database/config.php'; // Pastikan file konfigurasi sudah benar 
    ?>

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Admin Panel</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="../index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Back to Homepage
                        </a>
                        <a class="nav-link" href="admin.php">
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
                    <h1 class="mt-4">Tambah Berita Teknologi</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php
                            if (isset($_POST['submit'])) {
                                $judul = $_POST['judul'];
                                $isi = $_POST['isi'];
                                $author = $_POST['author'];
                                $tanggal_publikasi = $_POST['tanggal_publikasi'];
                                $kategori = $_POST['kategori'];
                                $target_dir = "../upload/";
                                $target_file = $target_dir . basename($_FILES["images"]["name"]);
                            
                                // Proses unggah gambar
                                if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
                                    // Masukkan data ke database
                                    $sql = "INSERT INTO artikel (judul, isi, author, tanggal_publikasi, images, kategori) VALUES (?, ?, ?, ?, ?, ?)";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ssssss", $judul, $isi, $author, $tanggal_publikasi, $target_file, $kategori);
                            
                                    if ($stmt->execute()) {
                                        echo "<p class='text-success'>Berita berhasil ditambahkan!</p>";
                                    } else {
                                        echo "<p class='text-danger'>Gagal menambah berita.</p>";
                                    }
                                } else {
                                    echo "<p class='text-danger'>Gagal mengunggah gambar.</p>";
                                }
                            }
                            ?>

                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="isi" class="form-label">Isi</label>
                                    <textarea class="form-control" id="isi" name="isi" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
                                    <input type="date" class="form-control" id="tanggal_publikasi" name="tanggal_publikasi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="images" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="images" name="images" accept="image/*" required>
                                </div>
                                <input type="hidden" name="kategori" value="teknologi">
                                <button type="submit" class="btn btn-primary" name="submit">Tambah Berita</button>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Berita -->
                    <h2 class="mt-4">Daftar Berita Teknologi</h2>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>Author</th>
                                        <th>Tanggal Publikasi</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../database/config.php'; // Menghubungkan dengan database

                                    $sql = "SELECT * FROM artikel WHERE kategori = 'teknologi' ORDER BY id DESC";
                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($b = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$b['id']}</td>
                                                    <td>" . htmlspecialchars($b['judul']) . "</td>
                                                    <td>" . htmlspecialchars(substr($b['isi'], 0, 50)) . "...</td>
                                                    <td>" . htmlspecialchars($b['author']) . "</td>
                                                    <td>{$b['tanggal_publikasi']}</td>
                                                    <td><img src='" . htmlspecialchars($b['images']) . "' alt='Gambar' style='width: 50px;'></td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>Tidak ada berita</td></tr>";
                                    }
                                    $conn->close();
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