-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2024 pada 18.30
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
-- Database: `seno_ppdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `promo` text DEFAULT NULL,
  `features` text DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`, `promo`, `features`, `button_text`, `button_link`, `image_path`) VALUES
(5, 'SMA SENOPATI', 'Maju Bersama SMA SENOPATI untuk merahi impian masadepan kalian', 'Daftar sekarang dan dapatkan promonya, cukup dengan membayar 5 juta ', 'Uang Gedung\r\nfree Buku Paket\r\nTerakrediasi b\r\nBahan Seragam\r\nSkill di bidang tambahan\r\nSekolah Favorit', 'daftar sekarang', 'upload_bukti.php', 'img/ppdbfx.png');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `button_text` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `description`, `image_url`, `button_text`) VALUES
(16, 'senior high school', 'ayo kembangkan potensi mu disini', 'uploads/img_6743eb7c8a8091.51194562.jpg', 'Daftar '),
(17, 'ayo berkembang di', 'pendidikan itu untuk masa depan yang cemerlang', 'uploads/img_6743ec608e8c77.83185314.jpg', 'Daftrakan Sekarang'),
(18, 'senior high school', 'benefit nya disini ada ilmu perhotelan lohh', 'uploads/img_6743ecdb627e09.99905619.png', 'Daftar Yuk');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_siswa`
--

INSERT INTO `data_siswa` (`id`, `kelas`, `jumlah`) VALUES
(1, 'ALL', 469),
(2, 'X', 162),
(3, 'XI', 131),
(4, 'XII', 156);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id`, `judul`, `gambar`) VALUES
(10, 'menggambar', 'eks3.jpg'),
(11, 'fotografi', 'eks4.jpg'),
(12, 'Tari', 'eks10.jpg'),
(13, 'Futsal', 'eks2.jpg'),
(14, 'PBB', 'eks7.jpg'),
(15, 'Pramuka', 'eks9.jpg'),
(17, 'PMI', 'eks8.jpg'),
(18, 'Rebana', 'eks1.jpg'),
(19, 'Tenis Meja', 'eks11.jpg');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `judul`, `deskripsi`, `video`) VALUES
(3, 'Upacara Kesaktian Pancasila', 'Pelaksanaan Upacara Kesaktian Pancasila\r\n', 'VIdeo1.mp4');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `delay` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `icon`, `title`, `description`, `delay`) VALUES
(12, 'fa-graduation-cap', 'Terakreditasi', 'BAN-PDM SERTIFIKAT AKREDITAS. No.PA.02697/35/2024', 0.2),
(13, 'fa-flask', 'Laboratorium', 'Biologi, Kimia, Fisika, dan Komputer', 0.3),
(14, 'fa-home', 'Fasilitas Ruang', 'Membuat nyaman untuk belajar', 0.3),
(15, 'fa-book-open', 'perpustakaan', 'Perpustakaan dengan sumber buku yang cukup lengkap', 0.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uploadfile`
--

CREATE TABLE `uploadfile` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_peserta`
--
ALTER TABLE `data_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `info_penting`
--
ALTER TABLE `info_penting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prestasi2`
--
ALTER TABLE `prestasi2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `uploadfile`
--
ALTER TABLE `uploadfile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `data_peserta`
--
ALTER TABLE `data_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579830;

--
-- AUTO_INCREMENT untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `info_penting`
--
ALTER TABLE `info_penting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `prestasi2`
--
ALTER TABLE `prestasi2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `uploadfile`
--
ALTER TABLE `uploadfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
