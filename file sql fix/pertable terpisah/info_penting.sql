-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2024 pada 18.25
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
-- Struktur dari tabel `info_penting`
--

CREATE TABLE `info_penting` (
  `id` int(11) NOT NULL,
  `judul_section` varchar(255) NOT NULL,
  `judul_info` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `warna_icon` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `info_penting`
--

INSERT INTO `info_penting` (`id`, `judul_section`, `judul_info`, `deskripsi`, `icon_class`, `warna_icon`, `gambar`) VALUES
(8, 'Menuju masadepan emas bersama SMA SENOPATI SIDOARJO', 'Promo Menarik di bulan november sampai ja', 'Nikmati penawaran khusus pendaftaran lebih awal dan dapatkan berbagai keuntungan serta potongan biaya sekolah untuk calon siswa baru.', 'fa-laptop', 'dark', 'PPDB ORI.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `info_penting`
--
ALTER TABLE `info_penting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `info_penting`
--
ALTER TABLE `info_penting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
