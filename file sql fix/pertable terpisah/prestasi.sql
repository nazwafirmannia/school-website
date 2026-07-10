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
-- Struktur dari tabel `prestasi`
--

CREATE TABLE `prestasi` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prestasi`
--

INSERT INTO `prestasi` (`id`, `category`, `icon`, `title`, `description`) VALUES
(1, 'AKADEMIK', 'fa fa-trophy', 'akademik', '1. Olimpiade Sains Nasional (OSN) - Juara 1 Bidang Fisika tingkat kabupaten.\r\n2. Lomba Debat Bahasa Inggris - Finalis tingkat provinsi\r\n3. Kompetisi Matematika Nasional - Juara 3 tingkat Nasional'),
(2, 'non-akademik', 'fa fa-futbol', 'non', '1. Juara Paskibra Kabupaten - Juara umum dalam lomba keterampilan baris - berbaris tingkat kabupaten.\r\n2. Tim Basket - Juara 2 di kejuaraan antar SMA se - Sidoarjo.\r\n3. Festival Tari Tradisional - Juara Favorit pada tingkat Provinsi\r\n'),
(3, 'seni dan budaya', 'fa fa-trophy', 'seni dan budaya', '1. Juara 1 Lomba Paduan Suara - Tingkat Kabupaten.\r\n2. Kompetisi Fotografi Siswa - Juara Harapan 1 tingkat Nasional.\r\n3. Lomba Lukis - Juara 1 dalam Festival Seni Pelajar.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
