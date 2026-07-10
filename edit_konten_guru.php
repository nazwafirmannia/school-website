<?php include "koneksi.php" ; 
// Validasi koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validasi parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID tidak ditemukan. Silakan kembali ke halaman sebelumnya.");
}

// Ambil data guru
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM guru WHERE id = $id");
if ($result->num_rows == 0) {
    die("Error: Data guru tidak ditemukan.");
}
$guru = $result->fetch_assoc();

// Update data guru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];

    // Upload gambar jika ada
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar)) {
            die("Error: Gambar gagal diupload.");
        }
    } else {
        $gambar = $guru['gambar'];
    }

    $sql = "UPDATE guru SET 
                nama='$nama', 
                jabatan='$jabatan', 
                gambar='$gambar', 
                facebook='$facebook', 
                twitter='$twitter', 
                instagram='$instagram' 
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: konten_guru.php?success=update");
        exit();
    } else {
        die("Error: " . $conn->error);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #4CAF50;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"], 
        input[type="file"], 
        input[type="number"], 
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus, 
        input[type="number"]:focus, 
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            padding: 10px 20px;
            background: #4CAF50;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            button {
                font-size: 14px;
            }

            input[type="text"], 
            input[type="number"], 
            textarea {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>Edit Guru</h1>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?php echo $guru['nama']; ?>" required>

            <label for="jabatan">Jabatan:</label>
            <input type="text" name="jabatan            <label for="jabatan">Jabatan:</label>
            <input type="text" name="jabatan" id="jabatan" value="<?php echo $guru['jabatan']; ?>" required>

            <label for="gambar">Gambar:</label>
            <input type="file" name="gambar" id="gambar">
            <img src="uploads/<?php echo $guru['gambar']; ?>" alt="Gambar Guru" width="100">

            <label for="facebook">Facebook:</label>
            <input type="text" name="facebook" id="facebook" value="<?php echo $guru['facebook']; ?>">

            <label for="twitter">Twitter:</label>
            <input type="text" name="twitter" id="twitter" value="<?php echo $guru['twitter']; ?>">

            <label for="instagram">Instagram:</label>
            <input type="text" name="instagram" id="instagram" value="<?php echo $guru['instagram']; ?>">

            <button type="submit">Update Guru</button>
        </form>

        <a href="konten_guru.php">Back to Guru List</a>
    </div>
</body>
</html>