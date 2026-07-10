<?php include 'koneksi.php';

$message = ''; // Inisialisasi pesan kosong di awal

if (isset($_POST['proses'])) {
    // Cek apakah 'nama_pendaftar' ada di dalam POST
    if (isset($_POST['nama_pendaftar'])) {
        $direktori = "berkas/";
        $file_name = $_FILES['NamaFile']['name'];
        $nama_pendaftar = mysqli_real_escape_string($conn, $_POST['nama_pendaftar']); // Mengambil dan melindungi input nama pendaftar
        
        // Membuat direktori jika belum ada
        if (!file_exists($direktori)) {
            mkdir($direktori, 0777, true);
        }

        // Memindahkan file yang di-upload
        if (move_uploaded_file($_FILES['NamaFile']['tmp_name'], $direktori . $file_name)) {
            // Menyimpan nama pendaftar dan nama file ke dalam tabel uploadfile
            if (mysqli_query($conn, "INSERT INTO uploadfile (nama, file) VALUES ('$nama_pendaftar', '$file_name')")) {
                // Menampilkan pesan berhasil dengan link ke form pendaftaran
                $message = "<span class='success'>File berhasil diupload.</span><br><br><span class='link'> 
                            <a href='Form Pendaftaran.html'>Silahkan mengisi data diri pada form pendaftaran</a></span>";
            } else {
                $message = "<span class='error'>Gagal menyimpan ke database</span>";
            }
        } else {
            $message = "<span class='error'>File gagal diupload</span>";
        }
    } else {
        $message = "<span class='error'>Nama pendaftar tidak diisi</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #e9ecef;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        h1 {
            color: #343a40;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .payment-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            text-align: left;
        }

        .payment-info h2 {
            font-size: 20px;
            color: #343a40;
            margin-bottom: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .info-row span {
            width: 50%;
            color: #495057;
        }

        .info-row strong {
            width: 50%;
            text-align: right;
        }

        .file-input {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border: 2px dashed #007bff;
            border-radius: 5px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .input-text {
            width: 100%; /* Memastikan input mengambil lebar penuh */
            padding: 10px; /* Padding untuk ruang di dalam input */
            border: 2px solid #007bff; /* Warna border biru */
            border-radius: 5px; /* Sudut membulat */
            font-size: 16px; /* Ukuran font */
            color: #495057; /* Warna teks */
            transition: border-color 0.3s ease; /* Transisi halus untuk efek fokus */
            margin-bottom: 20px; /* Spasi bawah untuk pemisahan dengan elemen lain */
        }

        .input-text:focus {
            border-color: #0056b3; /* Warna border saat input fokus */
            outline: none; /* Menghapus outline default */
        }

        .file-input:hover {
            background-color: #e9f2ff;
            border-color: #0056b3;
        }

        .file-input input[type="file"] {
            display: none;
        }

        .file-input .file-name {
            font-size: 1rem;
            margin-left: 10px;
            color: #343a40;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }

        .link {
            margin-top: 40px;
            display: inline-block;
            color: #007bff;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bukti Pembayaran Formulir Pendaftaran</h1>
        <div class="payment-info">
            <h2>Informasi Pembayaran</h2>
            <div class="info-row">
                <p><span>Jumlah yang harus dibayar:</span><strong>Rp100.000</strong></p>
            </div>
            <div class="info-row">
                <p><span>Nomor Rekening:</span><strong> 0831.0096.75</strong> BANK JATIM</p>
            </div>
            <div class="info-row">
                <p><span>Atas Nama:</span><strong>SMA SENOPATI</strong></p>
            </div>
            <div class="info-row">
                <p><span>Catatan:</span> Harap melakukan pembayaran sebelum mengisi formulir pendaftaran.</p>
            </div>
            <div class="info-row">
                <p><span>Catatan:</span> Harap memasukkan nama lengkap.</p>
            </div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
             <input type="text" name="nama_pendaftar" class="input-text" placeholder="Masukkan Nama Pendaftar" required>
            <br><br>
            <input type="file" name="NamaFile" required>
            <br><br>
            <input type="submit" name="proses" value="Upload">
        </form>

        <!-- Menampilkan pesan upload -->
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
