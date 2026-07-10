<?php include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangani penambahan info penting
    if (isset($_POST['add_info'])) {
        $judul_section = $_POST['judul_section'];
        $judul_info = $_POST['judul_info'];
        $deskripsi = $_POST['deskripsi'];
        $icon_class = $_POST['icon_class'];
        $warna_icon = $_POST['warna_icon'];
        $gambar = $_FILES['gambar']['name'];
        $target = "uploads/" . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

        $stmt = $conn->prepare("INSERT INTO info_penting (judul_section, judul_info, deskripsi, icon_class, warna_icon, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $judul_section, $judul_info, $deskripsi, $icon_class, $warna_icon, $gambar);
        $stmt->execute();
    }
}

$result = $conn->query("SELECT * FROM info_penting");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Info Penting</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Kelola Info Penting</h2>
        <a href="admin_home.php" class="btn btn-secondary mb-4">Kembali</a>
        <!-- Form untuk menambah info penting -->
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="form-group">
                <label for="judul_section">Judul Section</label>
                <input type="text" name="judul_section" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="judul_info">Judul Info</label>
                <input type="text" name="judul_info" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="icon_class">Icon Class</label>
                <input type="text" name="icon_class" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="warna_icon">Warna Icon</label>
                <input type="text" name="warna_icon" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>
            <button type="submit" name="add_info" class="btn btn-primary">Tambah Info Penting</button>
        </form>

        <h3>Daftar Info Penting</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Section</th>
                    <th>Judul Info</th>
                    <th>Deskripsi</th>
                    <th>Icon Class</th>
                    <th>Warna Icon</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['judul_section']; ?></td>
                        <td><?php echo $row['judul_info']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><?php echo $row['icon_class']; ?></td>
                        <td><?php echo $row['warna_icon']; ?></td>
                        <td>
                            <?php if ($row['gambar']): ?>
                                <img src="uploads/<?php echo $row['gambar']; ?>" alt="Gambar" style="width: 100px;">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_info_penting.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_info_penting.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>