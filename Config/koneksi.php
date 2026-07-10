<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pendaftaran";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$status = $_POST['status'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$agama = $_POST['agama'];
$kewarganegaraan = $_POST['kewarganegaraan'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$nama_ibu_kandung = $_POST['nama_ibu_kandung'];

$alamat_rumah = $_POST['alamat_rumah'];
$kode_pos = $_POST['kode_pos'];
$kecamatan = $_POST['kecamatan'];
$kabupaten = $_POST['kabupaten'];
$provinsi = $_POST['provinsi'];

$asal_sekolah = $_POST['asal_sekolah'];
$tahun_lulus = $_POST['tahun_lulus'];
$nilai_raport = $_POST['nilai_raport'];
$alamat_sekolah = $_POST['alamat_sekolah'];
$akreditasi_sekolah = $_POST['akreditasi_sekolah'];

$prog1 = $_POST['prog1'];
$prog2 = $_POST['prog2'];
$prog3 = $_POST['prog3'];

$pernyataan1 = $_POST['pernyataan1'];
$pernyataan2 = $_POST['pernyataan2'];

// Insert data into database
$sql = "INSERT INTO data_diri (nama, nik, tempat_lahir, tanggal_lahir, status, jenis_kelamin, agama, kewarganegaraan, email, no_hp, nama_ibu_kandung)
VALUES ('$nama', '$nik', '$tempat_lahir', '$tanggal_lahir', '$status', '$jenis_kelamin', '$agama', '$kewarganegaraan', '$email', '$no_hp', '$nama_ibu_kandung')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;

    $sql = "INSERT INTO data_alamat_domisili (alamat_rumah, kode_pos, kecamatan, kabupaten, provinsi)
VALUES ('$alamat_rumah', '$kode_pos', '$kecamatan', '$kabupaten', '$provinsi')";
    $conn->query($sql);

    $sql = "INSERT INTO data_pendidikan_terakhir (asal_sekolah, tahun_lulus, nilai_raport, alamat_sekolah, akreditasi_sekolah)
VALUES ('$asal_sekolah', '$tahun_lulus', '$nilai_raport', '$alamat_sekolah', '$akreditasi_sekolah')";
    $conn->query($sql);

    $sql = "INSERT INTO pilihan_program_studi (prog1, prog2, prog3)
VALUES ('$prog1', '$prog2', '$prog3')";
    $conn->query($sql);

    $sql = "INSERT INTO pernyataan (pernyataan1, pernyataan2)
VALUES ('$pernyataan1', '$pernyataan2')";
    $conn->query($sql);

    $sql = "INSERT INTO pendaftaran (id_data_diri, id_data_alamat_domisili, id_data_pendidikan_terakhir, id_pilihan_program_studi, id_pernyataan)
VALUES ('$last_id', '$last_id', '$last_id', '$last_id', '$last_id')";
    $conn->query($sql);

    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>