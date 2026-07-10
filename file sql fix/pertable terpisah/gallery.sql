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
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `instagram_embed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `category`, `instagram_embed`) VALUES
(3, 'Peringatan Isro Mi\'raj 1445', 'Kegiatan Sekolah', 'https://www.instagram.com/reel/C3SoA3LLKJW/embed'),
(7, 'Kunjungan Hotel dan Table Manner \"Jembuluwuk Hotel & Resort\"', 'Kegiatan Sekolah', 'https://www.instagram.com/reel/DBJAJB9zc4S/embed'),
(37, 'jalan sehat dan makan bergizi', 'Kegiatan Sekolah', 'https://www.instagram.com/reel/DC-y4p2SWvn/embed'),
(38, 'workshop pembelajaran berbasis digital', 'Kegiatan Sekolah', 'https://www.instagram.com/reel/DC1hKA5TgIX/embed'),
(39, 'kunjungan hotel dan table menner', 'Kegiatan Sekolah', 'https://www.instagram.com/reel/DBJAJB9zc4S/embed'),
(40, 'pawai dan bazar', 'Kegiatan Sekolah', 'https://www.instagram.com/reel/DCO07RyKYR9/embed');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
