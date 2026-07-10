<?php include 'koneksi.php';
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah Guru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $jabatan = $conn->real_escape_string($_POST['jabatan']);
    $facebook = $conn->real_escape_string($_POST['facebook']);
    $twitter = $conn->real_escape_string($_POST['twitter']);
    $instagram = $conn->real_escape_string($_POST['instagram']);

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    // Cek dan upload file
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO guru (nama, jabatan, gambar, facebook, twitter, instagram) 
                VALUES ('$nama', '$jabatan', '$gambar', '$facebook', '$twitter', '$instagram')";
        $conn->query($sql);
    }
}

// Edit Guru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $jabatan = $conn->real_escape_string($_POST['jabatan']);
    $facebook = $conn->real_escape_string($_POST['facebook']);
    $twitter = $conn->real_escape_string($_POST['twitter']);
    $instagram = $conn->real_escape_string($_POST['instagram']);

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $sql = "UPDATE guru SET 
                    nama='$nama', 
                    jabatan='$jabatan', 
                    gambar='$gambar', 
                    facebook='$facebook', 
                    twitter='$twitter', 
                    instagram='$instagram' 
                    WHERE id=$id";
            $conn->query($sql);
        }
    } else {
        $sql = "UPDATE guru SET 
                nama='$nama', 
                jabatan='$jabatan', 
                facebook='$facebook', 
                twitter='$twitter', 
                instagram='$instagram' 
                WHERE id=$id";
        $conn->query($sql);
    }
}

// Hapus Guru
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM guru WHERE id=$id";
    $conn->query($sql);
}

// Mengambil data guru
$result = $conn->query("SELECT * FROM guru");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
        .bordered-card {
        border: 2px solid black; 
        padding: 20px; 
        border-radius: 10px; 
    }
    .table td {
        padding: 8px 12px; 
        vertical-align: middle;
    }
    .table td:first-child {
        width: 30%;
    }
    .table td:last-child {
        width: 70%;
    }
    .form-section {
        padding: 20px;
        margin: 10px auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        max-width: 600px;
        border: 2px solid black; 
        padding: 20px; 
        border-radius: 10px; 
    }
    .form-section h3 {
        margin-bottom: 20px;
        font-size: 1.5em;
        color: #333;
        text-align: center;
    }
    .form-section label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-section input,
    .form-section select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1
    }
    .form-section input:focus,
    .form-section select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
    .form-section .form-group {
        margin-bottom: 20px;
    }
    .button-group {
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Guru</h1>
        <div class="card p-4">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" class="form-control">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" class="form-control">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" class="form-control">
                </div>
                <div>
                    <button type="submit" name="add" class="btn btn-primary mt-3">Tambah</button>
                    <a href="admin_home.php"class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </form>
        </div>

        <h3 class="mt-5">Daftar Guru</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td><img src="uploads/<?php echo $row['gambar']; ?>" style="width: 100px;"></td>
                        <td>
                            <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php
        // Jika ada id untuk edit, ambil datanya
        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $editResult = $conn->query("SELECT * FROM guru WHERE id=$id");
            $editRow = $editResult->fetch_assoc();
        ?>

<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-header">
    <h1 class="text-center mb-4">Edit Data Guru</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $editRow['id']; ?>">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $editRow['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="<?php echo $editRow['jabatan']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="<?php echo $editRow['facebook']; ?>">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="<?php echo $editRow['twitter']; ?>">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="<?php echo $editRow['instagram']; ?>">
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Update Guru</button>
            </form>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>