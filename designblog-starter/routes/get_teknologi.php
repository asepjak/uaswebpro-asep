<?php
// Koneksi database
include '../database/config.php'; // Pastikan jalur ini benar

// Fungsi untuk mendapatkan artikel teknologi
function getTechnologyArticles($limit = 10, $offset = 0) {
    global $conn; // Menggunakan koneksi global
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM artikel WHERE kategori = 'teknologi' ORDER BY tanggal_publikasi DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    return $stmt->get_result();
}

// Fungsi untuk mendapatkan artikel trending
function getTrendingArticles($limit = 4) {
    global $conn; // Menggunakan koneksi global
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM artikel WHERE kategori = 'teknologi' ORDER BY views DESC LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    return $stmt->get_result();
}

// Mendapatkan artikel untuk halaman utama
$mainArticles = getTechnologyArticles();
$trendingArticles = getTrendingArticles();
