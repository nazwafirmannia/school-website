<?php
include 'koneksi.php';

session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: data_siswa.php");
    exit();
}

$siswa = mysqli_real_escape_string($conn, $_GET['id']);

$query = "SELECT * FROM data_peserta WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $siswa);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$peserta = mysqli_fetch_assoc($result);

if (!$peserta) {
    $_SESSION['error'] = "Data peserta tidak ditemukan!";
    header("Location: data_siswa.php");
    exit();
}

if (isset($_POST['update'])) {
    $errors = array();
    
    if (empty($errors)) {
        // Susun query dengan urutan yang sama dengan bind_param
        $update_query = "UPDATE data_peserta SET 
            id = ?, 
            nama = ?, 
            panggilan = ?, 
            jenis_kelamin = ?, 
            nisn = ?, 
            nik = ?, 
            
            tempat_lahir = ?, 
            tanggal_lahir = ?, 
            status_pendaftaran = ?,
            agama = ?, 
            suku = ?, 
            kondisi_ekonomi = ?,
            kewarganegaraan = ?, 
            anak_ke = ?, 
            status_anak = ?,
            jumlah_saudara_kandung = ?, 
            bahasa = ?, 
            alamat_rumah = ?,
            jarak_ke_sekolah = ?, 
            no_hp = ?, 
            email = ?,
            asal_sekolah = ?, 
            no_ijazah = ?, 
            tanggal_ijazah = ?,
            no_shun = ?, 
            tanggal_shun = ?, 
            golongan_darah = ?,
            berat_badan = ?, 
            tinggi_badan = ?,
            riwayat_penyakit = ?,
            hobby = ?,
            prestasi = ?,

            jurusan = ?,
           
            nama_ayah = ?, 
            status_ayah = ?, 
            tempat_lahir_ayah = ?,
            tanggal_lahir_ayah = ?, 
            pendidikan_ayah = ?,
            pekerjaan_ayah = ?, 
            penghasilan_ayah = ?,
            email_ayah = ?, 
            nama_wali_ayah = ?,
            alamat_ayah = ?, 
            no_hp_ayah = ?,

            nama_ibu = ?, 
            status_ibu = ?, 
            tempat_lahir_ibu = ?,
            tanggal_lahir_ibu = ?, 
            pendidikan_ibu = ?,
            pekerjaan_ibu = ?, 
            penghasilan_ibu = ?,
            email_ibu = ?, 
            nama_wali_ibu = ?,
            alamat_ibu = ?, 
            no_hp_ibu = ?
            WHERE id = ?";
            
        // Buat array untuk menyimpan parameter sesuai urutan query
        $params = [
            $_POST['id'],
            $_POST['nama'],
            $_POST['panggilan'],
            $_POST['jenis_kelamin'],
            $_POST['nisn'],
            $_POST['nik'],
            
            $_POST['tempat_lahir'],
            $_POST['tanggal_lahir'],
            $_POST['status_pendaftaran'],
            $_POST['agama'],
            $_POST['suku'],
            $_POST['kondisi_ekonomi'],
            $_POST['kewarganegaraan'],
            $_POST['anak_ke'],
            $_POST['status_anak'],
            $_POST['jumlah_saudara_kandung'],
            $_POST['bahasa'],
            $_POST['alamat_rumah'],
            $_POST['jarak_ke_sekolah'],
            $_POST['no_hp'],
            $_POST['email'],
            $_POST['asal_sekolah'],
            $_POST['no_ijazah'],
            $_POST['tanggal_ijazah'],
            $_POST['no_shun'],
            $_POST['tanggal_shun'],
            $_POST['golongan_darah'],
            $_POST['berat_badan'],
            $_POST['tinggi_badan'],
            $_POST['riwayat_penyakit'],
            
            $_POST['hobby'],
            $_POST['prestasi'],

            $_POST['jurusan'],
            
            $_POST['nama_ayah'],
            $_POST['status_ayah'],
            $_POST['tempat_lahir_ayah'],
            $_POST['tanggal_lahir_ayah'],
            $_POST['pendidikan_ayah'],
            $_POST['pekerjaan_ayah'],
            $_POST['penghasilan_ayah'],
            $_POST['email_ayah'],
            $_POST['nama_wali_ayah'],
            $_POST['alamat_ayah'],
            $_POST['no_hp_ayah'],

            $_POST['nama_ibu'],
            $_POST['status_ibu'],
            $_POST['tempat_lahir_ibu'],
            $_POST['tanggal_lahir_ibu'],
            $_POST['pendidikan_ibu'],
            $_POST['pekerjaan_ibu'],
            $_POST['penghasilan_ibu'],
            $_POST['email_ibu'],
            $_POST['nama_wali_ibu'],
            $_POST['alamat_ibu'],
            $_POST['no_hp_ibu'],
            $siswa
        ];

        $stmt = mysqli_prepare($conn, $update_query);
        
        // Buat string types untuk bind_param
        $types = str_repeat('s', count($params));
        
        // Bind parameters menggunakan array
        mysqli_stmt_bind_param($stmt, $types, ...$params);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Data berhasil diupdate!";
            header("Location: data_siswa.php");
            exit();
        } else {
            $errors[] = "Gagal mengupdate data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Peserta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #4B0082;
            padding: 15px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 15px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .form-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-section h3 {
            color: #4B0082;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #4B0082;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .btn-primary {
            background-color: #4B0082;
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="welcome-text">
            <i class="fas fa-user"></i> 
            Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </div>
    </div>

    <div class="container">
        <h2><i class="fas fa-edit"></i> Edit Data Peserta Didik</h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul style="margin: 0;">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-section">
                <h3><i class="fas fa-user"></i> Data Pribadi Calon Pesrta Didik Baru</h3>
            <div>
                <label>Kode Pendaftaran:</label>
                <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($peserta['id']); ?>" required>
            <div>
                <label for="nama">Nama Lengkap:</label>
                <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($peserta['nama']); ?>" required>
            </div>
                <label for="panggilan">Nama Panggilan:</label>
                <input type="text" name="panggilan" id="panggilan" value="<?php echo htmlspecialchars($peserta['panggilan']); ?>" required>
            </div>
            <div>
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="Laki-laki" <?php if ($peserta['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($peserta['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div>
                <label for="nik">NIK:</label>
                <input type="text" name="nik" id="nik" value="<?php echo htmlspecialchars($peserta['nik']); ?>" required>
            </div>
            <div>
                <label for="nisn">NISN:</label>
                <input type="text" name="nisn" id="nisn" value="<?php echo htmlspecialchars($peserta['nisn']); ?>" required>
            </div>
           


            <div>
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo htmlspecialchars($peserta['tempat_lahir']); ?>" required>
            </div>
            <div>
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo htmlspecialchars($peserta['tanggal_lahir']); ?>" required>
            </div>
            <div>
                <label for="status_pendaftaran">Status Pendaftaran:</label>
                <select name="status_pendaftaran" id="status_pendaftaran" required>
                    <option value="Reguler" <?php if ($peserta['status_pendaftaran'] == 'Reguler') echo 'selected'; ?>>Reguler</option>
                    <option value="Unggul" <?php if ($peserta['status_pendaftaran'] == 'Unggul') echo 'selected'; ?>>Unggul</option>
                </select>
            </div>
            <div>
                <label for="agama">Agama:</label>
                <select name="agama" id="agama" required>
                    <option value="Islam" <?php if ($peserta['agama'] == 'Islam') echo 'selected'; ?>>Islam</option>
                    <option value="Kristen" <?php if ($peserta['agama'] == 'Kristen') echo 'selected'; ?>>Kristen</option>
                    <option value="Katolik" <?php if ($peserta['agama'] == 'Katolik') echo 'selected'; ?>>Katolik</option>
                    <option value="Hindu" <?php if ($peserta['agama'] == 'Hindu') echo 'selected'; ?>>Hindu</option>
                    <option value="Budha" <?php if ($peserta['agama'] == 'Budha') echo 'selected'; ?>>Budha</option>
                    <option value="Lainnya" <?php if ($peserta['agama'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                </select>
            </div>
            <div>
                <label for="suku">Suku:</label>
                <select name="suku" id="suku" required>
                    <option value="Bali" <?php if ($peserta['suku'] == 'Bali') echo 'selected'; ?>>Bali</option>
                    <option value="Jawa" <?php if ($peserta['suku'] == 'Jawa') echo 'selected'; ?>>Jawa</option>
                    <option value="Madura" <?php if ($peserta['suku'] == 'Madura') echo 'selected'; ?>>Madura</option>
                    <option value="Sunda" <?php if ($peserta['suku'] == 'Sunda') echo 'selected'; ?>>Sunda</option>
                    <option value="Batak" <?php if ($peserta['suku'] == 'Batak') echo 'selected'; ?>>Batak</option>
                    <option value="Lainnya" <?php if ($peserta['suku'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                </select>
            </div>
            <div>
                <label for="kondisi_ekonomi">Kondisi Ekonomi:</label>
                <select name="kondisi_ekonomi" id="kondisi_ekonomi" required>
                    <option value="Tidak Mampu" <?php if ($peserta['kondisi_ekonomi'] == 'Tidak Mampu') echo 'selected'; ?>>Tidak Mampu</option>
                    <option value="Cukup Mampu" <?php if ($peserta['kondisi_ekonomi'] == 'Cukup Mampu') echo 'selected'; ?>>Cukup Mampu</option>
                    <option value="Mampu" <?php if ($peserta['kondisi_ekonomi'] == 'Mampu') echo 'selected'; ?>>Mampu</option>
                    <option value="Berlebih" <?php if ($peserta['kondisi_ekonomi'] == 'Berlebih') echo 'selected'; ?>>Berlebih</option>
                </select>
            </div>
            <div>
                <label for="kewarganegaraan">Kewarganegaraan:</label>
                <select name="kewarganegaraan" id="kewarganegaraan" required>
                    <option value="WNI" <?php if ($peserta['kewarganegaraan'] == 'WNI') echo 'selected'; ?>>Warga Negara Indonesia (WNI)</option>
                    <option value="WNA" <?php if ($peserta['kewarganegaraan'] == 'WNA') echo 'selected'; ?>>Warga Negara Asing (WNA)</option>
                </select>
            </div>
            <div>
                <label for="anak_ke">Anak Ke:</label>
                <input type="text" name="anak_ke" id="anak_ke" value="<?php echo htmlspecialchars($peserta['anak_ke']); ?>" required>
            </div>
            <div>
                <label for="status_anak">Status Anak:</label>
                <select name="status_anak" id="status_anak" required>
                    <option value="Anak Kandung" <?php if ($peserta['status_anak'] == 'Anak Kandung') echo 'selected'; ?>>Anak Kandung</option>
                    <option value="Anak Angkat" <?php if ($peserta['status_anak'] == 'Anak Angkat') echo 'selected'; ?>>Anak Angkat</option>
                    <option value="Anak Tiri" <?php if ($peserta['status_anak'] == 'Anak Tiri') echo 'selected'; ?>>Anak Tiri</option>
                </select>
            </div>
            <div>
                <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung:</label>
                <input type="text" name="jumlah_saudara_kandung" id="jumlah_saudara_kandung" value="<?php echo htmlspecialchars($peserta['jumlah_saudara_kandung']); ?>" required>
            </div>
            <div>
                <label for="bahasa">Bahasa:</label>
                <input type="text" name="bahasa" id="bahasa" value="<?php echo htmlspecialchars($peserta['bahasa']); ?>" required>
            </div>
            <div>
                <label for="alamat_rumah">Alamat Rumah:</label>
                <input type="text" name="alamat_rumah" id="alamat_rumah" value="<?php echo htmlspecialchars($peserta['alamat_rumah']); ?>" required>
            </div>
            <div>
                <label for="jarak_ke_sekolah">Jarak ke Sekolah:</label>
                <input type="text" name="jarak_ke_sekolah" id="jarak_ke_sekolah" value="<?php echo htmlspecialchars($peserta['jarak_ke_sekolah']); ?>" required>
            </div>
            <div>
                <label for="no_hp">No HP:</label>
                <input type="text" name="no_hp" id="no_hp" value="<?php echo htmlspecialchars($peserta['no_hp']); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($peserta['email']); ?>" required>
            </div>
            <div>
                <label for="asal_sekolah">Asal Sekolah:</label>
                <input type="text" name="asal_sekolah" id="asal_sekolah" value="<?php echo htmlspecialchars($peserta['asal_sekolah']); ?>" required>
            </div>
            <div>
                <label for="no_ijazah">No Ijazah:</label>
                <input type="text" name="no_ijazah" id="no_ijazah" value="<?php echo htmlspecialchars($peserta['no_ijazah']); ?>" required>
            </div>
            <div>
                <label for="tanggal_ijazah">Tanggal Ijazah:</label>
                <input type="date" name="tanggal_ijazah" id="tanggal_ijazah" value="<?php echo htmlspecialchars($peserta['tanggal_ijazah']); ?>" required>
            </div>
            <div>
                <label for="no_shun">No SHUN:</label>
                <input type="text" name="no_shun" id="no_shun" value="<?php echo htmlspecialchars($peserta['no_shun']); ?>" required>
            </div>
            <div>
                <label for="tanggal_shun">Tanggal SHUN:</label>
                <input type="date" name="tanggal_shun" id="tanggal_shun" value="<?php echo htmlspecialchars($peserta['tanggal_shun']); ?>" required>
            </div>


            <!-- Data Kesehatan-->
            <div class="form-section">
                <h3><i class="fas fa-graduation-cap"></i> Riwayat Kesehatan</h3>
                <!-- Form fields untuk data akademik -->
            </div>
            <div>
                <label for="golongan_darah">Golongan Darah:</label>
                <select name="golongan_darah" id="golongan_darah" required>
                    <option value="A" <?php if ($peserta['golongan_darah'] == 'A') echo 'selected'; ?>>A</option>
                    <option value="B" <?php if ($peserta['golongan_darah'] == 'B') echo 'selected'; ?>>B</option>
                    <option value="AB" <?php if ($peserta['golongan_darah'] == 'AB') echo 'selected'; ?>>AB</option>
                    <option value="O" <?php if ($peserta['golongan_darah'] == 'AB') echo 'selected'; ?>>O</option>
                    <option value="Belum ada data" <?php if ($peserta['golongan_darah'] == 'Belum ada data') echo 'selected'; ?>>Belum ada data</option>
                </select>
            </div>
            <div>
                <label for="berat_badan">berat_badan:</label>
                <input type="text" name="berat_badan" id="berat_badan" value="<?php echo htmlspecialchars($peserta['berat_badan']); ?>" required>
            </div>
            <div>
                <label for="tinggi_badan">tinggi_badan:</label>
                <input type="text" name="tinggi_badan" id="tinggi_badan" value="<?php echo htmlspecialchars($peserta['tinggi_badan']); ?>" required>
            </div>
         <div>
            <label for="riwayat_penyakit">Riwayat Penyakit:</label>
            <input type="text" name="riwayat_penyakit" id="riwayat_penyakit" 
                value="<?php echo isset($peserta['riwayat_penyakit']) ? htmlspecialchars($peserta['riwayat_penyakit'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
                required>
        </div>
            <!-- Data Kesehatan END-->

            <!-- Data Wali ayah -->
            <form action="" method="POST">
            <div class="form-section">
                <h3><i class="fas fa-graduation-cap"></i>Data Ayah Calon Peserta Didik</h3>
                    <div>
                        <label for="nama_ayah">Nama Orang Tua :</label>
                        <input type="text" name="nama_ayah" id="nama_ayah" value="<?php echo isset($peserta['nama_ayah']) ? htmlspecialchars($peserta['nama_ayah']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="status_ayah">Status :</label>
                        <select name="status_ayah" id="status_ayah" required>
                        <option value="Ayah Kandung" <?php if ($peserta['status_ayah'] == 'Ayah Kandung') echo 'selected'; ?>>Ayah Kandung</option>
                        <option value="Ayah Angkat" <?php if ($peserta['status_ayah'] == 'Ayah Angkat') echo 'selected'; ?>>Ayah Angkat</option>
                        <option value="Ayah Tiri" <?php if ($peserta['status_ayah'] == 'Ayah Tiri') echo 'selected'; ?>>Ayah Tiri</option>
                </select>
                </div>
                <div>
                        <label for="tempat_lahir_ayah">Tempat lahir :</label>
                        <input type="text" name="tempat_lahir_ayah" id="tempat_lahir_ayah" value="<?php echo htmlspecialchars($peserta['tempat_lahir_ayah']); ?>" required>
                </div>
                    <div>
                        <label for="tanggal_lahir_ayah">Tanggal Lahir :</label>
                        <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah" value="<?php echo htmlspecialchars($peserta['tanggal_lahir_ayah']); ?>" required>
                </div>
                <div>
                        <label for="pendidikan_ayah">Pendidikan:</label>
                        <select name="pendidikan_ayah" id="pendidikan_ayah" required>
                        <option value="SD" <?php if ($peserta['pendidikan_ayah'] == 'SD') echo 'selected'; ?>>SD</option>
                        <option value="SMP" <?php if ($peserta['pendidikan_ayah'] == 'SMP') echo 'selected'; ?>>SMP</option>
                        <option value="SMA/SLTA" <?php if ($peserta['pendidikan_ayah'] == 'SMA/SLTA') echo 'selected'; ?>>SMA/SLTA</option>
                        <option value="D1" <?php if ($peserta['pendidikan_ayah'] == 'D1') echo 'selected'; ?>>D1</option>
                        <option value="D2" <?php if ($peserta['pendidikan_ayah'] == 'D2') echo 'selected'; ?>>D2</option>
                        <option value="D3" <?php if ($peserta['pendidikan_ayah'] == 'D3') echo 'selected'; ?>>D3</option>
                        <option value="S1" <?php if ($peserta['pendidikan_ayah'] == 'S1') echo 'selected'; ?>>S1</option>
                        <option value="S2" <?php if ($peserta['pendidikan_ayah'] == 'S2') echo 'selected'; ?>>S2</option>
                        <option value="S3" <?php if ($peserta['pendidikan_ayah'] == 'S3') echo 'selected'; ?>>S3</option>
                </select>
                </div>
                    <div>
                        <label for="pekerjaan_ayah">Pekerjaan:</label>
                        <select name="pekerjaan_ayah" id="pekerjaan_ayah" required>
                        <option value="Petani" <?php if ($peserta['pekerjaan_ayah'] == 'Petani') echo 'selected'; ?>>Petani</option>
                        <option value="peternak" <?php if ($peserta['pekerjaan_ayah'] == 'Peternak') echo 'selected'; ?>>Peternak</option>
                        <option value="PNS / TNI / POLRI" <?php if ($peserta['pekerjaan_ayah'] == 'PNS / TNI / POLRI') echo 'selected'; ?>>PNS / TNI/ POLRI</option>
                        <option value="Karyawan Swasta" <?php if ($peserta['pekerjaan_ayah'] == 'Karyawan Swasta') echo 'selected'; ?>>Karyawan Swasta</option>
                        <option value="Pedagang" <?php if ($peserta['pekerjaan_ayah'] == 'Pedagang') echo 'selected'; ?>>Pedagang</option>
                        <option value="Wiraswasta" <?php if ($peserta['pekerjaan_ayah'] == 'Wiraswasta') echo 'selected'; ?>>Wiraswasta</option>
                        <option value="Buruh" <?php if ($peserta['pekerjaan_ayah'] == 'Buruh') echo 'selected'; ?>>Buruh</option>
                        <option value="Pensiunan" <?php if ($peserta['pekerjaan_ayah'] == 'Pensiunan') echo 'selected'; ?>>Pensiunan</option>
                        <option value="Tidak Bekerja" <?php if ($peserta['pekerjaan_ayah'] == 'Tidak Bekerja') echo 'selected'; ?>>Tidak Bekerja</option>
                </select>
                </div>

             <div>
                <label for="penghasilan_ayah">Penghasilan Orangtua :</label>
                <select name="penghasilan_ayah" id="penghasilan_ayah" required>
                    <option value="Kurang dari Rp.499.999" <?php if (isset($peserta['penghasilan_ayah']) && $peserta['penghasilan_ayah'] == 'Kurang dari Rp.499.999') echo 'selected'; ?>>Kurang dari Rp.499.999</option>
                    <option value="Rp.500.000 - Rp.999.999" <?php if (isset($peserta['penghasilan_ayah']) && $peserta['penghasilan_ayah'] == 'Rp.500.000 - Rp.999.999') echo 'selected'; ?>>Rp.500.000 - Rp.999.999</option>
                    <option value="Rp.1.000.000 - Rp.1.999.999" <?php if (isset($peserta['penghasilan_ayah']) && $peserta['penghasilan_ayah'] == 'Rp.1.000.000 - Rp.1.999.999') echo 'selected'; ?>>Rp.1.000.000 - Rp.1.999.999</option>
                    <option value="Rp.2.000.000 - Rp.3.999.999" <?php if (isset($peserta['penghasilan_ayah']) && $peserta['penghasilan_ayah'] == 'Rp.2.000.000 - Rp.3.999.999') echo 'selected'; ?>>Rp.2.000.000 - Rp.3.999.999</option>
                    <option value="Rp.4.000.000 - Rp.9.999.999" <?php if (isset($peserta['penghasilan_ayah']) && $peserta['penghasilan_ayah'] == 'Rp.4.000.000 - Rp.9.999.999') echo 'selected'; ?>>Rp.4.000.000 - Rp.9.999.999</option>
                    <option value="Lebih besar dari Rp.10.000.000" <?php if (isset($peserta['penghasilan_ayah']) && $peserta['penghasilan_ayah'] == 'Lebih besar dari Rp.10.000.000') echo 'selected'; ?>>Lebih besar dari Rp.10.000.000</option>
                </select>
            </div>

                    
                    <div>
                        <label for="email_ayah">Email Orangtua :</label>
                        <input type="text" name="email_ayah" id="email_ayah" value="<?php echo htmlspecialchars($peserta['email_ayah']); ?>" required>
                    </div>
                
                    <div>
                        <label for="nama_wali_ayah">Nama Wali :</label>
                        <input type="text" name="nama_wali_ayah" id="nama_wali_ayah" value="<?php echo htmlspecialchars($peserta['nama_wali_ayah']); ?>" required>
                    </div>
            
                    <div>
                        <label for="alamat_ayah">Alamat Orangtua :</label>
                        <input type="text" name="alamat_ayah" id="alamat_ayah" value="<?php echo htmlspecialchars($peserta['alamat_ayah']); ?>" required>
                    </div>
            
                    <div>
                        <label for="no_hp_ayah">HP Orangtua (untuk SMS gateway) :</label>
                        <input type="text" name="no_hp_ayah" id="no_hp_ayah" value="<?php echo htmlspecialchars($peserta['no_hp_ayah']); ?>" required>
                    </div>

                    <!-- data wali ayah END -->
                    

                    <!-- data wali ibu -->
            <form action="" method="POST">
            <div class="form-section">
                <h3><i class="fas fa-graduation-cap"></i>Data Ibu Peserta Didik</h3>
                    <div>
                        <label for="nama_ibu">Nama Orang Tua :</label>
                        <input type="text" name="nama_ibu" id="nama_ibu" value="<?php echo htmlspecialchars($peserta['nama_ibu']); ?>" required>
                    </div>                
                 
                <div>
                        <label for="status_ibu">Status :</label>
                        <select name="status_ibu" id="status_ibu" required>
                        <option value="Ibu kandung" <?php if ($peserta['status_ibu'] == 'Ibu kandung') echo 'selected'; ?>>Ibu Kandung</option>
                        <option value="Ibu angkat" <?php if ($peserta['status_ibu'] == 'Ibu angkat') echo 'selected'; ?>>Ibu Angkat</option>
                        <option value="Ibu tiri" <?php if ($peserta['status_ibu'] == 'Ibu tiri') echo 'selected'; ?>>Ibu Tiri</option>
                </select>
                </div>
                <div>
                        <label for="tempat_lahir_ibu">Tempat lahir :</label>
                        <input type="text" name="tempat_lahir_ibu" id="tempat_lahir_ibu" value="<?php echo htmlspecialchars($peserta['tempat_lahir_ibu']); ?>" required>
                </div>
                <div>
                        <label for="tanggal_lahir_ibu">Tanggal Lahir :</label>
                        <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" value="<?php echo htmlspecialchars($peserta['tanggal_lahir_ibu']); ?>" required>
                </div>
                <div>
                        <label for="pendidikan_ibu">Pendidikan:</label>
                        <select name="pendidikan_ibu" id="pendidikan_ibu" required>
                        <option value="SD" <?php if ($peserta['pendidikan_ibu'] == 'SD') echo 'selected'; ?>>SD</option>
                        <option value="SMP" <?php if ($peserta['pendidikan_ibu'] == 'SMP') echo 'selected'; ?>>SMP</option>
                        <option value="SMA/SLTA" <?php if ($peserta['pendidikan_ibu'] == 'SMA/SLTA') echo 'selected'; ?>>SMA/SLTA</option>
                        <option value="D1" <?php if ($peserta['pendidikan_ibu'] == 'D1') echo 'selected'; ?>>D1</option>
                        <option value="D2" <?php if ($peserta['pendidikan_ibu'] == 'D2') echo 'selected'; ?>>D2</option>
                        <option value="D3" <?php if ($peserta['pendidikan_ibu'] == 'D3') echo 'selected'; ?>>D3</option>
                        <option value="S1" <?php if ($peserta['pendidikan_ibu'] == 'S1') echo 'selected'; ?>>S1</option>
                        <option value="S2" <?php if ($peserta['pendidikan_ibu'] == 'S2') echo 'selected'; ?>>S2</option>
                        <option value="S3" <?php if ($peserta['pendidikan_ibu'] == 'S3') echo 'selected'; ?>>S3</option>
                </select>
                </div>
                <div>
                        <label for="pekerjaan_ibu">Pekerjaan :</label>
                        <select name="pekerjaan_ibu" id="pekerjaan_ibu" required>
                        <option value="Petani" <?php if ($peserta['pekerjaan_ibu'] == 'Petani') echo 'selected'; ?>>Petani</option>
                        <option value="peternak" <?php if ($peserta['pekerjaan_ibu'] == 'Peternak') echo 'selected'; ?>>Peternak</option>
                        <option value="PNS / TNI / POLRI" <?php if ($peserta['pekerjaan_ibu'] == 'PNS / TNI / POLRI') echo 'selected'; ?>>PNS / TNI/ POLRI</option>
                        <option value="Karyawan Swasta" <?php if ($peserta['pekerjaan_ibu'] == 'Karyawan Swasta') echo 'selected'; ?>>Karyawan Swasta</option>
                        <option value="Pedagang" <?php if ($peserta['pekerjaan_ibu'] == 'Pedagang') echo 'selected'; ?>>Pedagang</option>
                        <option value="Wiraswasta" <?php if ($peserta['pekerjaan_ibu'] == 'Wiraswasta') echo 'selected'; ?>>Wiraswasta</option>
                        <option value="Buruh" <?php if ($peserta['pekerjaan_ibu'] == 'Buruh') echo 'selected'; ?>>Buruh</option>
                        <option value="Pensiunan" <?php if ($peserta['pekerjaan_ibu'] == 'Pensiunan') echo 'selected'; ?>>Pensiunan</option>
                        <option value="Tidak Bekerja" <?php if ($peserta['pekerjaan_ibu'] == 'Tidak Bekerja') echo 'selected'; ?>>Tidak Bekerja</option>
                </select>
                </div>
                
                <div>
    <label for="penghasilan_ibu">Penghasilan Orangtua :</label>
    <select name="penghasilan_ibu" id="penghasilan_ibu" required>
        <option value="Kurang dari Rp.499.999" <?php if (isset($peserta['penghasilan_ibu']) && $peserta['penghasilan_ibu'] == 'Kurang dari Rp.499.999') echo 'selected'; ?>>Kurang dari Rp.499.999</option>
        <option value="Rp.500.000 - Rp.999.999" <?php if (isset($peserta['penghasilan_ibu']) && $peserta['penghasilan_ibu'] == 'Rp.500.000 - Rp.999.999') echo 'selected'; ?>>Rp.500.000 - Rp.999.999</option>
        <option value="Rp.1.000.000 - Rp.1.999.999" <?php if (isset($peserta['penghasilan_ibu']) && $peserta['penghasilan_ibu'] == 'Rp.1.000.000 - Rp.1.999.999') echo 'selected'; ?>>Rp.1.000.000 - Rp.1.999.999</option>
        <option value="Rp.2.000.000 - Rp.3.999.999" <?php if (isset($peserta['penghasilan_ibu']) && $peserta['penghasilan_ibu'] == 'Rp.2.000.000 - Rp.3.999.999') echo 'selected'; ?>>Rp.2.000.000 - Rp.3.999.999</option>
        <option value="Rp.4.000.000 - Rp.9.999.999" <?php if (isset($peserta['penghasilan_ibu']) && $peserta['penghasilan_ibu'] == 'Rp.4.000.000 - Rp.9.999.999') echo 'selected'; ?>>Rp.4.000.000 - Rp.9.999.999</option>
        <option value="Lebih besar dari Rp.10.000.000" <?php if (isset($peserta['penghasilan_ibu']) && $peserta['penghasilan_ibu'] == 'Lebih besar dari Rp.10.000.000') echo 'selected'; ?>>Lebih besar dari Rp.10.000.000</option>
    </select>
</div>

                
                <div>
                        <label for="email_ibu">Email Orangtua :</label>
                        <input type="text" name="email_ibu" id="email_ibu" value="<?php echo htmlspecialchars($peserta['email_ibu']); ?>" required>
                </div>
                
                <div>
                        <label for="nama_wali_ibu">Nama Wali :</label>
                        <input type="text" name="nama_wali_ibu" id="nama_wali_ibu" value="<?php echo htmlspecialchars($peserta['nama_wali_ibu']); ?>" required>
                </div>
                <div>
                        <label for="alamat_ibu">Alamat Orangtua :</label>
                        <input type="text" name="alamat_ibu" id="alamat_ibu" value="<?php echo htmlspecialchars($peserta['alamat_ibu']); ?>" required>
                    </div>
                <div>
                        <label for="no_hp_ibu">HP Orangtua (untuk SMS gateway) :</label>
                        <input type="text" name="no_hp_ibu" id="no_hp_ibu" value="<?php echo htmlspecialchars($peserta['no_hp_ibu']); ?>" required>
                    </div>

            <!-- informasi tambahan -->
            <form action="" method="POST">
            <div class="form-section">
                <h3><i class="fas fa-users"></i> Informasi Tambahan</h3>
                        <div>
                            <label for="hobby">Hobby:</label>
                            <input type="text" name="hobby" id="hobby" value="<?php echo htmlspecialchars($peserta['hobby']); ?>" required>
                    </div>
                    <div>
                            <label for="prestasi">Prestasi yang di capai:</label>
                            <input type="text" name="prestasi" id="prestasi" value="<?php echo htmlspecialchars($peserta['prestasi']); ?>" required>
                </div>
                
                <!-- pilihan peminatan -->
                <form action="" method="POST">
                <div class="form-section">
                <h3><i class="fas fa-users"></i> Pilihan Peminatan</h3>
                    <div>
                            <label for="jurusan">Pilih Jurusan:</label>
                            <select name="jurusan" id="jurusan" required>
                            <option value="umum" <?php if ($peserta['jurusan'] == 'umum') echo 'selected'; ?>>umum</option>
                            <option value="umum+perhotelan" <?php if ($peserta['jurusan'] == 'umum+perhotelan') echo 'selected'; ?>>umum+perhotelan</option>
                </select>
                </div>
              
            <div class="button-group">
                <button type="submit" name="update" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Data
                </button>
                <a href="data_siswa.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <script>
        // Konfirmasi sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengupdate data ini?')) {
                e.preventDefault();
            }
        });

        // Konfirmasi sebelum meninggalkan halaman
        window.onbeforeunload = function() {
            return "Apakah Anda yakin ingin meninggalkan halaman ini? Perubahan yang belum disimpan akan hilang.";
        };

        // Hapus konfirmasi jika form di-submit
        document.querySelector('form').addEventListener('submit', function() {
            window.onbeforeunload = null;
        });
    </script>
</body>
</html>