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
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nama`, `jabatan`, `gambar`, `facebook`, `twitter`, `instagram`) VALUES
(1, 'Yayuk Kumiyati, SPd', 'Kepala Sekolah', 'Kepala Sekolah Fx.png', '#', '#', '#'),
(2, 'Ary Nurul Amsah, SPd', 'Waka Kurikulum', 'ary.jpg', '#', '#', '#'),
(3, 'Alexander Chandra W, M.Pd', 'Waka Kesiswaan', 'alexander.jpg', '#', '#', '#'),
(4, 'Reynald Bestarianto, S.Pd', 'Waka Humas', 'reynald.jpg', '#', '#', '#'),
(7, 'M. Zaenal As ari, A.Md', 'KepalaTata Usaha', 'zaenal.jpg', '#', '#', '#'),
(8, 'Juremi', 'Tata Usaha', 'juremi.jpg', '#', '#', '#'),
(9, 'Kawa Damas Adi', 'Tata Usaha', 'kawa.jpg', '#', '#', '#'),
(10, 'Erin Dita Putri Imron, SE', 'Tata Usaha', 'erin.jpg', '#', '#', '#'),
(11, 'M. Agus Salim, SPd', 'Guru Pengajar', 'm agus s.jpg', '#', '#', '#');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
