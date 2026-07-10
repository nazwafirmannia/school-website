<?php
include 'koneksi.php'; // Sertakan file koneksi

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data pendaftaran berdasarkan ID
    $sql = "SELECT * FROM pendaftaran WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak valid.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Cetak Formulir Pendaftaran</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Formulir Pendaftaran</h1>
        <h3>Data Pribadi</h3>
        <p><strong>NISN:</strong> <?php echo $data['nisn']; ?></p>
        <p><strong>NIK:</strong> <?php echo $data['nik']; ?></p>
        <p><strong>Nama:</strong> <?php echo $data['nama']; ?></p>
        <p><strong>Panggilan:</strong> <?php echo $data['panggilan']; ?></p>
        <p><strong>Tempat Lahir:</strong> <?php echo $data['tempat_lahir']; ?></p>
        <p><strong>Tanggal Lahir:</strong> <?php echo $data['tanggal_lahir']; ?></p>
        <p><strong>Status Pendaftaran:</strong> <?php echo $data['status_pendaftaran']; ?></p>
        <p><strong>Jenis Kelamin:</strong> <?php echo $data['jenis_kelamin']; ?></p>
        <p><strong>Agama:</strong> <?php echo $data['agama']; ?></p>
        <p><strong>Suku:</strong> <?php echo $data['suku']; ?></p>
        <p><strong>Kondisi Ekonomi:</strong> <?php echo $data['kondisi_ekonomi']; ?></p>
        <p><strong>Kewarganegaraan:</strong> <?php echo $data['kwn']; ?></p>
        <p><strong>Anak Ke:</strong> <?php echo $data['anakke']; ?></p>
        <p><strong>Status Anak:</strong> <?php echo $data['status_anak']; ?></p>
        <p><strong>Jumlah Saudara Kandung:</strong> <?php echo $data['jumlah_saudara_kandung']; ?></p>
        <p><strong>Bahasa:</strong> <?php echo $data['bahasa']; ?></p>
        <p><strong>Alamat Rumah:</strong> <?php echo $data['alamat_rumah']; ?></p>
        <p><strong>Jarak ke Sekolah:</strong> <?php echo $data['jaraksekolah']; ?></p>
        <p><strong>No HP:</strong> <?php echo $data['no_hp']; ?></p>
        <p><strong>Email:</strong> <?php echo $data['email']; ?></p>
        <p><strong>Asal Sekolah:</strong> <?php echo $data['asalsekolah']; ?></p>
        <p><strong>No Ijazah:</strong> <?php echo $data['no_ijazah']; ?></p>
        <p><strong>Tanggal Ijazah:</strong> <?php echo $data['tanggal_ijazah']; ?></p>
        <p><strong>No SHUN:</strong> <?php echo $data['no_shun']; ?></p>
        <p><strong>Tanggal SHUN:</strong> <?php


echo $data['tanggal_shun']; ?></p>

<h3>Riwayat Kesehatan</h3>
<p><strong>Golongan Darah:</strong> <?php echo $data['goldar']; ?></p>
<p><strong>Berat Badan:</strong> <?php echo $data['berat_badan']; ?> Kg</p>
<p><strong>Tinggi Badan:</strong> <?php echo $data['tinggi_badan']; ?> Cm</p>
<p><strong>Riwayat Penyakit:</strong> <?php echo $data['riwayat_penyakit']; ?></p>

<h3>Data Orang Tua</h3>
<p><strong>Nama Orang Tua:</strong> <?php echo $data['nama_ortu']; ?></p>
<p><strong>Status:</strong> <?php echo $data['status_ortu']; ?></p>
<p><strong>Tempat Lahir:</strong> <?php echo $data['tempat_lahir_ortu']; ?></p>
<p><strong>Tanggal Lahir:</strong> <?php echo $data['tanggal_lahir_ortu']; ?></p>
<p><strong>Pendidikan:</strong> <?php echo $data['pendidikan']; ?></p>
<p><strong>Pekerjaan:</strong> <?php echo $data['pekerjaan']; ?></p>
<p><strong>Penghasilan:</strong> <?php echo $data['penghasilan']; ?></p>
<p><strong>Email:</strong> <?php echo $data['email_ortu']; ?></p>

<h3>Data Wali</h3>
<p><strong>Nama Wali:</strong> <?php echo $data['nama_wali']; ?></p>
<p><strong>Alamat Wali:</strong> <?php echo $data['alamat_orangtua']; ?></p>
<p><strong>No HP Wali:</strong> <?php echo $data['HP_ortu']; ?></p>

<h3>Pilihan Peminatan</h3>
<p><strong>Jurusan Umum:</strong> <?php echo $data['prog1']; ?></p>
<p><strong>Jurusan Tambahan:</strong> <?php echo $data['prog2']; ?></p>
<p><strong>Gelombang:</strong> <?php echo $data['gelombang']; ?></p>

<div class="text-center">
    <button onclick="window.print();" class="btn btn-success">Cetak</button>
</div>
</div>
</body>
</html>