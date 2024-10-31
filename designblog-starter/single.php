<?php
include 'database/config.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <h1><?php echo $article['judul']; ?></h1>
                    <p class="text-muted">
                        By <?php echo $article['author']; ?> | 
                        <?php echo date('d M Y', strtotime($article['tanggal_publikasi'])); ?> | 
                        <?php echo $article['kategori']; ?>
                    </p>
                    <img src="<?php echo $article['images']; ?>" class="img-fluid mb-3" alt="<?php echo $article['judul']; ?>">
                    <div>
                        <?php echo $article['isi']; ?>
                    </div>
                </article>
            </div>
            <div class="col-lg-4">
                <!-- Sidebar content -->
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>