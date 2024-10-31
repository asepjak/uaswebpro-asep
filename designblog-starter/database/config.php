<?php
$host = 'localhost';  // Nama host atau server
$user = 'root';       // Nama pengguna database
$pass = '';           // Kata sandi pengguna database
$dbname = 'uaswebproasep'; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
