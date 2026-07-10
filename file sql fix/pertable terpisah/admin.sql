-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2024 pada 18.24
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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `no_telp` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`, `nama`, `no_telp`) VALUES
(1, 'smasenopati', '$2y$10$xSGO7zzw6QcM49yXI9gNJeHh/3JmEIs/um7YVfIsrOmFOeo0wE9.C', 'smasenopati@gmail.com', 'SMA SENOPATI', 0),
(6, 'shssenopati', '$2y$10$MgNlQE0ARc5k5qTdQ/.Uhu8X1xJ7.Oj4G4s5NLdLivPJJcspo4shO', 'seniorhighscool.senopati@gmail.com', 'SMA SENOPATI', 0),
(33, 'smasenopatisidoarjo', '$2y$10$TjYfTIgn.BpSI9p5iLOUwudo9hiV9WmvJnDmx2xVU1WY.qtsF8DM6', 'info@sma.senopati', 'smasenopati', 0),
(34, 'senopatisma', '$2y$10$flGtyxadCBaGV1VXXhFu4ukYoz25D3tvzexYO2ZkWETsvsEwTVjqy', 'smasenopatisidoarjo@gmail.com', 'smasenopati', 0),
(35, 'sayaadmin', '$2y$10$WmcRV81SyDEEpiL8.GoMNu7a.I3rwZDH/ttT476ObAb3vUXLJvBnq', 'admin@gmail.com', 'M. Zaenal As\'ari, A.Md', 123213);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
