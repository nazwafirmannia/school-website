<?php include "koneksi.php" ; 



// Memeriksa apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form
    $nisn = $_POST['nisn'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    
    
    $panggilan = $_POST['panggilan'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $status_pendaftaran = $_POST['status_pendaftaran'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $suku = $_POST['suku'];
    $kondisi_ekonomi = $_POST['kondisi_ekonomi'];
    $kewarganegaraan = $_POST['kwn'];
    $anak_ke = $_POST['anakke'];
    $status_anak = $_POST['status_anak'];
    $jumlah_saudara_kandung = $_POST['jumlah_saudara_kandung'];
    $bahasa = $_POST['bahasa'];
    $alamat_rumah = $_POST['alamat_rumah'];
    $jarak_ke_sekolah = $_POST['jaraksekolah'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $asal_sekolah = $_POST['asalsekolah'];
    $no_ijazah = $_POST['no_ijazah'];
    $tanggal_ijazah = $_POST['tanggal_ijazah'];
    $no_shun = $_POST['no_shun'];
    $tanggal_shun = $_POST['tanggal_shun'];
    
    $golongan_darah = $_POST['goldar'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $riwayat_penyakit = $_POST['riwayat_penyakit'];

    $nama_ayah = $_POST['nama_ayah'];
    $status_ayah = $_POST['status_ayah'];
    $tempat_lahir_ayah = $_POST['tempat_lahir_ayah'];
    $tanggal_lahir_ayah = $_POST['tanggal_lahir_ayah'];
    $pendidikan_ayah = $_POST['pendidikan_ayah'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $penghasilan_ayah = $_POST['penghasilan_ayah'];
    $email_ayah = $_POST['email_ayah'];
    $nama_wali_ayah= $_POST['nama_wali_ayah'];
    $alamat_ayah = $_POST['alamat_ayah'];
    $no_hp_ayah = $_POST['no_hp_ayah'];
    
    $nama_ibu = $_POST['nama_ibu'];
    $status_ibu = $_POST['status_ibu'];
    $tempat_lahir_ibu = $_POST['tempat_lahir_ibu'];
    $tanggal_lahir_ibu = $_POST['tanggal_lahir_ibu'];
    $pendidikan_ibu = $_POST['pendidikan_ibu'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $penghasilan_ibu = $_POST['penghasilan_ibu'];
    $email_ibu = $_POST['email_ibu'];
    $nama_wali_ibu= $_POST['nama_wali_ibu'];
    $alamat_ibu = $_POST['alamat_ibu'];
    $no_hp_ibu = $_POST['no_hp_ibu'];
    
    $hobby = $_POST['hobby'];
    $prestasi = $_POST['prestasi'];

    $jurusan = $_POST['prog1'];
    
    
    $pernyataan1 = isset($_POST['pernyataan1']) ? 1 : 0;
    $pernyataan2 = isset($_POST['pernyataan2']) ? 1 : 0;

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO data_peserta (nisn, nik, nama, panggilan, tempat_lahir, tanggal_lahir, status_pendaftaran, jenis_kelamin, agama, suku, kondisi_ekonomi, kewarganegaraan, anak_ke, status_anak, jumlah_saudara_kandung, bahasa, alamat_rumah, jarak_ke_sekolah, no_hp, email, asal_sekolah, no_ijazah, tanggal_ijazah, no_shun, tanggal_shun, golongan_darah, berat_badan, tinggi_badan, riwayat_penyakit, nama_ayah, status_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, pendidikan_ayah, pekerjaan_ayah, penghasilan_ayah, email_ayah, nama_wali_ayah, alamat_ayah, no_hp_ayah, nama_ibu, status_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, pendidikan_ibu, pekerjaan_ibu, penghasilan_ibu, email_ibu, nama_wali_ibu, alamat_ibu, no_hp_ibu , hobby, prestasi, jurusan, pernyataan1, pernyataan2)
            VALUES ('$nisn', '$nik', '$nama', '$panggilan', '$tempat_lahir', '$tanggal_lahir', '$status_pendaftaran', '$jenis_kelamin', '$agama', '$suku', '$kondisi_ekonomi', '$kewarganegaraan', '$anak_ke', '$status_anak', '$jumlah_saudara_kandung', '$bahasa', '$alamat_rumah', '$jarak_ke_sekolah', '$no_hp', '$email', '$asal_sekolah', '$no_ijazah', '$tanggal_ijazah', '$no_shun', '$tanggal_shun', '$golongan_darah', '$berat_badan', '$tinggi_badan', '$riwayat_penyakit', '$nama_ayah', '$status_ayah', '$tempat_lahir_ayah', '$tanggal_lahir_ayah', '$pendidikan_ayah', '$pekerjaan_ayah', '$penghasilan_ayah', '$email_ayah', '$nama_wali_ayah', '$alamat_ayah', '$no_hp_ayah','$nama_ibu','$status_ibu','$tempat_lahir_ibu','$tanggal_lahir_ibu','$pendidikan_ibu','$pekerjaan_ibu','$penghasilan_ibu','$email_ibu','$nama_wali_ibu','$alamat_ibu','$no_hp_ibu', '$hobby','$prestasi','$jurusan', '$pernyataan1', '$pernyataan2')";

    // Mengeksekusi query   Data berhasil disimpan
    if (mysqli_query($conn, $sql)) {
        echo "    ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Menutup koneksi
    mysqli_close($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berhasil Disimpan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .message-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.2s ease;
        }
        .message-container h2 {
            color: #28a745;
            font-size: 24px;
            font-weight: bold;
        }
        .message-container p {
            color: #555;
            margin-top: 10px;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .message-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .message-container a:hover {
            background-color: #218838;
        }
        .icon-check {
            font-size: 70px;
            color: #28a745;
            margin-bottom: 20px;
            animation: popUp 0.5s ease-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes popUp {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .floating-circles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: -1;
        }

        .circle {
            position: absolute;
            background-color: rgba(40, 167, 69, 0.1);
            border-radius: 50%;
            animation: floatUp 5s infinite ease-in-out;
        }

        .circle:nth-child(1) {
            width: 150px;
            height: 150px;
            bottom: -50px;
            right: -50px;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 250px;
            height: 250px;
            top: -100px;
            left: -100px;
            animation-delay: 2s;
        }

        .circle:nth-child(3) {
            width: 200px;
            height: 200px;
            top: 40%;
            left: 70%;
            animation-delay: 4s;
        }

        @keyframes floatUp {
            0% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-50px); opacity: 0; }
        }
    </style>
</head>
<body>

<div class="floating-circles">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<div class="message-container">
    <div class="icon-check">✔</div>
    <h2>Data Berhasil Disimpan</h2>
    <p>Terima kasih, data Anda telah berhasil disimpan ke sistem.</p>
    <a href="data_siswa.php">Kembali ke Halaman Utama Admin</a>
</div>

</body>
</html>


