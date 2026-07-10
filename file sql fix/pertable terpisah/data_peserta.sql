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
-- Struktur dari tabel `data_peserta`
--

CREATE TABLE `data_peserta` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `panggilan` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_pendaftaran` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `suku` varchar(50) DEFAULT NULL,
  `kondisi_ekonomi` varchar(20) DEFAULT NULL,
  `kewarganegaraan` enum('WNI','WNA') DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `status_anak` enum('Anak kandung','Anak Angkat','Anak Tiri') DEFAULT NULL,
  `jumlah_saudara_kandung` int(11) DEFAULT NULL,
  `bahasa` varchar(50) DEFAULT NULL,
  `alamat_rumah` text DEFAULT NULL,
  `jarak_ke_sekolah` varchar(20) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `no_ijazah` varchar(100) DEFAULT NULL,
  `tanggal_ijazah` date DEFAULT NULL,
  `no_shun` varchar(100) DEFAULT NULL,
  `tanggal_shun` date DEFAULT NULL,
  `golongan_darah` enum('A','B','AB','O','Belum ada data') DEFAULT NULL,
  `berat_badan` float DEFAULT NULL,
  `tinggi_badan` float DEFAULT NULL,
  `riwayat_penyakit` text DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `status_ayah` enum('Ayah kandung','Ayah angkat','Ayah tiri') DEFAULT NULL,
  `tempat_lahir_ayah` varchar(100) DEFAULT NULL,
  `tanggal_lahir_ayah` date DEFAULT NULL,
  `pendidikan_ayah` enum('SD','SMP','SMA/SLTA','D1','D2','D3','S1','S2','S3') DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) DEFAULT NULL,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `email_ayah` varchar(100) DEFAULT NULL,
  `nama_wali_ayah` varchar(100) DEFAULT NULL,
  `alamat_ayah` text DEFAULT NULL,
  `no_hp_ayah` varchar(20) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `status_ibu` enum('Ibu kandung','Ibu angkat','Ibu tiri') DEFAULT NULL,
  `tempat_lahir_ibu` varchar(100) DEFAULT NULL,
  `tanggal_lahir_ibu` date DEFAULT NULL,
  `pendidikan_ibu` enum('SD','SMP','SMA/SLTA','D1','D2','D3','S1','S2','S3') DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `email_ibu` varchar(100) DEFAULT NULL,
  `nama_wali_ibu` varchar(100) DEFAULT NULL,
  `alamat_ibu` text DEFAULT NULL,
  `no_hp_ibu` varchar(20) DEFAULT NULL,
  `hobby` varchar(50) NOT NULL,
  `prestasi` varchar(100) NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `pernyataan1` tinyint(1) DEFAULT NULL,
  `pernyataan2` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_peserta`
--
ALTER TABLE `data_peserta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_peserta`
--
ALTER TABLE `data_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579830;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
