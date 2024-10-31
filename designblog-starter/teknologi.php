<?php
include 'database/config.php';

// Konfigurasi pagination
$limit = 6; // jumlah artikel per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query untuk menghitung total artikel teknologi
$count_query = "SELECT COUNT(*) as total FROM artikel WHERE kategori = 'teknologi'";
$count_result = $conn->query($count_query);
$total_records = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);

// Query untuk mengambil artikel teknologi dengan pagination
$sql = "SELECT * FROM artikel WHERE kategori = 'teknologi' ORDER BY tanggal_publikasi DESC LIMIT $start, $limit";
$result = $conn->query($sql);

// Query untuk artikel trending teknologi
$sql_trending = "SELECT * FROM artikel WHERE kategori = 'teknologi' ORDER BY view DESC LIMIT 5";
$result_trending = $conn->query($sql_trending);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Technology Posts - Web Programming Blog</title>

    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a,
        .pagination strong {
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid #ddd;
            color: black;
            text-decoration: none;
        }

        .pagination a:hover {
            background-color: #f2f2f2;
        }

        .pagination strong {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <!-- header -->
    <header class="w3l-header">
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <span class="fa fa-pencil-square-o"></span> Web Programming Blog
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories <span class="fa fa-angle-down"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item active" href="teknologi.php">Technology posts</a>
                                <a class="dropdown-item @@ls__active" href="lifestyle.php">Lifestyle posts</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item @@admin__active">
                            <a class="nav-link" href="admin/admin.php">Admin</a>
                        </li>
                    </ul>

                    <!-- search-right -->
                    <div class="search-right mt-lg-0 mt-2">
                        <a href="#search" title="search"><span class="fa fa-search" aria-hidden="true"></span></a>
                        <!-- search popup -->
                        <div id="search" class="pop-overlay">
                            <div class="popup">
                                <h3 class="hny-title two">Search here</h3>
                                <form action="#" method="Get" class="search-box">
                                    <input type="search" placeholder="Search for blog posts" name="search"
                                        required="required" autofocus="">
                                    <button type="submit" class="btn">Search</button>
                                </form>
                                <a class="close" href="#close">×</a>
                            </div>
                        </div>
                        <!-- /search popup -->
                    </div>
                    <!--//search-right-->
                </div>

                <!-- toggle switch for light and dark theme -->
                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
    </header>
    <!-- //header -->

    <!-- breadcrumbs -->
    <nav id="breadcrumbs" class="breadcrumbs">
        <div class="container page-wrapper">
            <a href="index.php">Home</a> » <span class="breadcrumb_last" aria-current="page">Technology Posts</span>
        </div>
    </nav>
    <!-- //breadcrumbs -->

    <!-- Technology Posts -->
    <div class="w3l-homeblock1">
        <div class="container pt-lg-5 pt-md-4">
            <div class="row">
                <div class="col-lg-9 most-recent">
                    <h3 class="section-title-left">Technology Posts</h3>
                    <div class="row">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-lg-4 col-md-6 item">
                                    <div class="card">
                                        <div class="card-header p-0 position-relative">
                                            <a href="single.php?id=<?php echo $row['id']; ?>">
                                                <?php if (!empty($row['images'])): ?>
                                                    <img class="card-img-bottom d-block radius-image-full"
                                                        src="admin/<?php echo htmlspecialchars($row['images']); ?>"
                                                        alt="<?php echo htmlspecialchars($row['judul']); ?>"
                                                        style="height: 200px; object-fit: cover;">
                                                <?php else: ?>
                                                    <img class="card-img-bottom d-block radius-image-full"
                                                        src="assets/images/default-image.jpg"
                                                        alt="Default Image"
                                                        style="height: 200px; object-fit: cover;">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="card-body blog-details">
                                            <span class="label-blue">Technology</span>
                                            <a href="single.php?id=<?php echo $row['id']; ?>" class="blog-desc">
                                                <?php echo htmlspecialchars($row['judul']); ?>
                                            </a>
                                            <p><?php echo substr(strip_tags($row['isi']), 0, 100) . '...'; ?></p>
                                            <div class="author align-items-center mt-3 mb-1">
                                                <div class="author-left">
                                                    <span class="meta-item">
                                                        <i class="far fa-user"></i> <?php echo htmlspecialchars($row['author']); ?>
                                                    </span>
                                                </div>
                                                <div class="author-right">
                                                    <span class="meta-item">
                                                        <i class="far fa-calendar-alt"></i>
                                                        <?php echo date('M d, Y', strtotime($row['tanggal_publikasi'])); ?>
                                                    </span>
                                                    <span class="meta-item">
                                                        <i class="fas fa-eye"></i> <?php echo $row['view']; ?> views
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No technology articles available.</p>";
                        }
                        ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <div class="pagination">
                            <?php if ($page > 1): ?>
                                <a href="?page=1">&laquo; First</a>
                                <a href="?page=<?php echo $page - 1; ?>">&lsaquo; Prev</a>
                            <?php endif; ?>

                            <?php
                            $start_page = max(1, $page - 2);
                            $end_page = min($total_pages, $page + 2);

                            for ($i = $start_page; $i <= $end_page; $i++):
                            ?>
                                <?php if ($i == $page): ?>
                                    <strong><?php echo $i; ?></strong>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>">Next &rsaquo;</a>
                                <a href="?page=<?php echo $total_pages; ?>">Last &raquo;</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-3 trending mt-lg-0 mt-5 mb-lg-5">
                    <div class="pos-sticky">
                        <h3 class="section-title-left mb-4">Trending in Technology</h3>
                        <?php
                        if ($result_trending->num_rows > 0) {
                            $counter = 1;
                            while ($trend = $result_trending->fetch_assoc()) {
                        ?>
                                <div class="trending-post mb-4">
                                    <div class="post-content">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="trend-number">
                                                #<?php echo $counter; ?>
                                            </span>
                                            <span class="view-count">
                                                <i class="fas fa-eye"></i> <?php echo $trend['view']; ?> views
                                            </span>
                                        </div>
                                        <h5 class="post-title">
                                            <a href="single.php?id=<?php echo $trend['id']; ?>">
                                                <?php echo htmlspecialchars(substr($trend['judul'], 0, 60)) . (strlen($trend['judul']) > 60 ? '...' : ''); ?>
                                            </a>
                                        </h5>
                                        <div class="post-meta">
                                            <span class="meta-item mr-3">
                                                <i class="far fa-user mr-1"></i>
                                                <?php echo htmlspecialchars($trend['author']); ?>
                                            </span>
                                            <span class="meta-item">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                <?php echo date('M d, Y', strtotime($trend['tanggal_publikasi'])); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php if ($counter < 5): ?>
                                        <hr>
                                    <?php endif; ?>
                                </div>
                        <?php
                                $counter++;
                            }
                        } else {
                            echo "<p>No trending articles available.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //Technology Posts -->

    <!-- footer -->
    <footer class="w3l-footer-16">
        <div class="footer-content py-lg-5 py-4 text-center">
            <div class="container">
                <div class="copy-right">
                    <h6>© 2024 Web Programming Blog . Made with <span class="fa fa-heart" aria-hidden="true"></span> by <i>(your name)</i><br>Designed by
                        <a href="https://w3layouts.com">W3layouts</a>
                    </h6>
                </div>
                <ul class="author-icons mt-4">
                    <li><a class="facebook" href="#url"><span class="fa fa-facebook" aria-hidden="true"></span></a></li>
                    <li><a class="twitter" href="#url"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
                    <li><a class="google" href="#url"><span class="fa fa-google-plus" aria-hidden="true"></span></a></li>
                    <li><a class="linkedin" href="#url"><span class="fa fa-linkedin" aria-hidden="true"></span></a></li>
                    <li><a class="github" href="#url"><span class="fa fa-github" aria-hidden="true"></span></a></li>
                    <li><a class="dribbble" href="#url"><span class="fa fa-dribbble" aria-hidden="true"></span></a></li>
                </ul>
                <button onclick="topFunction()" id="movetop" title="Go to top">
                    <span class="fa fa-angle-up"></span>
                </button>
            </div>
        </div>

        <!-- move top -->
        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("movetop").style.display = "block";
                } else {
                    document.getElementById("movetop").style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
        <!-- //move top -->
    </footer>
    <!-- //footer -->

    <!-- Template JavaScript -->
    <script src="assets/js/theme-change.js"></script>

    <script src="assets/js/jquery-3.3.1.min.js"></script>

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- disable body scroll which navbar is in active -->

    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>