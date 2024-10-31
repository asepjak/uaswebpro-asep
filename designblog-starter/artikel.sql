-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 12:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uaswebproasep`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `kategori` enum('teknologi','lifestyle') NOT NULL,
  `author` varchar(255) NOT NULL,
  `tanggal_publikasi` date NOT NULL,
  `images` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `isi`, `kategori`, `author`, `tanggal_publikasi`, `images`, `view`) VALUES
(1, 'Asep', 'keren', 'teknologi', 'Asep keren', '2003-09-28', '../upload/asepkakgem.jpg', 5),
(2, 'Gaya bebas', 'bebas', 'lifestyle', 'Asep Si Anak Sultan PSP', '2025-09-08', '../upload/9adce505-0960-4f82-83e8-00182ddd7f23.jpg', 11),
(3, 'fellix memakan anak kucing', 'robot', 'teknologi', 'fellixsiau', '2003-09-18', '../upload/raven-shogun-freya-mobile-legends-ml-wallpaper-67721_w635.webp', 2),
(4, 'BTS VS EXO', 'Keren', 'lifestyle', 'Jongkok', '2022-01-10', '../upload/Blade_of_Despair.webp', 6),
(5, 'bapeda provinsi', 'theo kena do', 'teknologi', 'raycal', '2003-01-18', '../upload/images.jpeg', 0),
(6, 'jaket', 'raisaa', 'lifestyle', 'noval', '2024-02-28', '../upload/FOTO TD.jpg', 0),
(7, 'asep123', '123', 'lifestyle', 'asep', '2024-08-07', '../upload/images.jpeg', 0),
(8, 'AMING', 'KOPI', 'teknologi', 'AMING', '2024-02-19', '../upload/WIN_20231023_13_17_05_Pro.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
