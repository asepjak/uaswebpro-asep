<?php
include 'database/config.php';

// Handling article view and retrieval
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute statement for updating view count
    $update_view = "UPDATE artikel SET view = view + 1 WHERE id = ?";
    $stmt_view = $conn->prepare($update_view);
    if (!$stmt_view) {
        die("Database query failed: " . $conn->error);
    }
    $stmt_view->bind_param("i", $id);
    $stmt_view->execute();

    // Get article details
    $sql = "SELECT * FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Database query failed: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

// Get related articles
$kategori = $article['kategori'];
$current_id = $article['id'];
$sql_related = "SELECT * FROM artikel WHERE kategori = ? AND id != ? ORDER BY tanggal_publikasi DESC LIMIT 3";
$stmt_related = $conn->prepare($sql_related);
if (!$stmt_related) {
    die("Database query failed: " . $conn->error);
}
$stmt_related->bind_param("si", $kategori, $current_id);
$stmt_related->execute();
$related_articles = $stmt_related->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['judul']); ?> - Web Programming Blog</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            /* Use a clean, sans-serif font */
            background-color: #f4f4f4;
            /* Light gray background for contrast */
            color: #333;
            /* Dark text color for readability */
        }

        .container {
            margin-top: 50px;
            /* Space from the top */
        }

        .article-header {
            position: relative;
            margin-bottom: 2rem;
            padding: 20px;
            /* Add padding for spacing */
            background-color: #fff;
            /* White background for the article header */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Soft shadow for depth */
        }

        .article-meta {
            background: rgba(255, 255, 255, 0.9);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.6;
            /* Adjust line height for readability */
            margin-bottom: 2rem;
            /* Space below content */
        }

        .article-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .related-article {
            transition: transform 0.3s ease;
            background-color: #fff;
            /* White background for related articles */
            border-radius: 5px;
            /* Rounded corners */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        .related-article:hover {
            transform: translateY(-5px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
            /* Shadow effect on hover */
        }

        .share-buttons {
            margin: 2rem 0;
        }

        .share-buttons h5 {
            margin-bottom: 1rem;
            /* Space below share text */
        }

        .share-buttons a {
            margin-right: 1rem;
            color: #007bff;
            /* Link color */
            font-size: 1.5rem;
            /* Size for icons */
            transition: color 0.3s, transform 0.3s;
            /* Smooth transition */
        }

        .share-buttons a:hover {
            color: #0056b3;
            /* Darker shade on hover */
            transform: scale(1.1);
            /* Slightly enlarge on hover */
        }

        .sidebar-box {
            background: #fff;
            /* White background for sidebar */
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Soft shadow for depth */
        }

        .sidebar-box h4 {
            font-size: 1.5rem;
            /* Larger font for headings */
            margin-bottom: 1rem;
            color: #333;
            /* Darker text for contrast */
        }

        .recent-articles,
        .trending-articles {
            padding: 0.5rem 0;
        }

        .recent-article,
        .trending-article {
            margin-bottom: 0.5rem;
            /* Space between articles */
        }

        .recent-article a,
        .trending-article a {
            color: #007bff;
            /* Link color */
            text-decoration: none;
            /* Remove underline */
            transition: color 0.3s;
            /* Smooth color transition */
        }

        .recent-article a:hover,
        .trending-article a:hover {
            color: #0056b3;
            /* Darker shade on hover */
            text-decoration: underline;
            /* Underline on hover */
        }

        .recent-article small,
        .trending-article small {
            display: block;
            /* Ensure date appears on a new line */
            font-size: 0.9rem;
            /* Smaller font for dates */
            color: #6c757d;
            /* Muted text color for dates */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <div class="article-header">
                        <h1 class="mb-4"><?php echo htmlspecialchars($article['judul']); ?></h1>

                        <div class="article-meta">
                            <div class="d-flex align-items-center mb-3">
                                <!-- Author image removed -->
                                <div>
                                    <strong><?php echo htmlspecialchars($article['author']); ?></strong>
                                    <div class="text-muted">
                                        <small>
                                            <i class="far fa-calendar-alt"></i>
                                            <?php echo date('d M Y', strtotime($article['tanggal_publikasi'])); ?> |
                                            <i class="fas fa-folder"></i>
                                            <?php echo htmlspecialchars($article['kategori']); ?> |
                                            <i class="fas fa-eye"></i>
                                            <?php echo htmlspecialchars($article['view']); ?> views
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php if (!empty($article['images'])): ?>
                            <img src="admin/<?php echo htmlspecialchars($article['images']); ?>"
                                class="article-image"
                                alt="<?php echo htmlspecialchars($article['judul']); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="article-content">
                        <?php echo $article['isi']; ?>
                    </div>

                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <h5>Share this article:</h5>
                        <a href="https://facebook.com/share.php?u=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" target="_blank">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" target="_blank">
                            <i class="fab fa-twitter fa-2x"></i>
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" target="_blank">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-box">
                    <h4>Related Articles</h4>
                    <?php while ($related = $related_articles->fetch_assoc()): ?>
                        <div class="card mb-3 related-article">
                            <div class="row no-gutters">
                                <div class="col-4">
                                    <?php if (!empty($related['images'])): ?>
                                        <img src="admin/<?php echo htmlspecialchars($related['images']); ?>"
                                            class="card-img"
                                            alt="<?php echo htmlspecialchars($related['judul']); ?>"
                                            style="height: 100%; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a href="single.php?id=<?php echo $related['id']; ?>" class="text-dark">
                                                <?php echo htmlspecialchars(substr($related['judul'], 0, 50)) . '...'; ?>
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            <?php echo date('d M Y', strtotime($related['tanggal_publikasi'])); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>