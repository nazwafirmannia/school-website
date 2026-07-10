-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2024 pada 18.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi2`
--

CREATE TABLE `prestasi2` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `tab_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prestasi2`
--

INSERT INTO `prestasi2` (`id`, `title`, `description`, `image_url`, `tab_name`) VALUES
(10, 'Prestasi Lingkungan dan Sosial', '1. Sekolah Adiwiyata - Penghargaan atas kontribusi sekolah dalam pelestarian lingkungan.\r\n2. Program Pengabdian Masyarakat  - Penerima penghargaan dari Pemda atas Kontribusi dalam kegiatan sosial.\r\n3. Lomba Sekolah Sehat - Juara 2 Tingkat Provinsi.', 'uploads/j2.png', 'Prestasi Lingkungan dan Sosial'),
(12, 'Prestasi Eksrakurikuler ', '1. Juara 1 Kompetisi Pramuka - Tingkat regional\r\n2. Juara dalam Lomba Karya Ilmiah Remaja (LKR) - Juara 1 dengan tema Inovasi Lingkungan \r\n2. Juara Taekwondo - Medali emas pada kejuaraan antar SMA se Jawa Timur', 'uploads/j2.jpg', 'Prestasi Ekstrakurikuler lainnya'),
(14, 'Ayo Tingkatkan bakatmu di SMA SENOPATI SIDOARJO', '.', 'uploads/j3.jpg', 'Prestasi Unggul');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `prestasi2`
--
ALTER TABLE `prestasi2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `prestasi2`
--
ALTER TABLE `prestasi2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
