<?php
include '../database/config.php'; // Koneksi ke database

// Mendapatkan ID artikel dari URL
$id = $_GET['id'];

// Menambahkan jumlah view pada artikel dengan ID tertentu
$sql_update = "UPDATE artikel SET view = view + 1 WHERE id = ?";
$stmt = $conn->prepare($sql_update);
$stmt->bind_param("i", $id);
$stmt->execute();

// Mengambil data artikel
$sql_select = "SELECT * FROM artikel WHERE id = ?";
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['judul']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($article): ?>
            <h1><?php echo htmlspecialchars($article['judul']); ?></h1>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($article['author']); ?></p>
            <p><strong>Published on:</strong> <?php echo htmlspecialchars($article['tanggal_publikasi']); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($article['kategori']); ?></p>
            <img src="<?php echo htmlspecialchars($article['images']); ?>" alt="Image" style="width: 100%; max-width: 300px;">
            <p><?php echo htmlspecialchars($article['isi']); ?></p>
            <p><strong>Views:</strong> <?php echo htmlspecialchars($article['view']); ?></p>
            <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
        <?php else: ?>
            <p class="text-danger">Article not found.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
