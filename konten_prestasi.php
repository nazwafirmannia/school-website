<?php include 'koneksi.php';
// Tambah Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $category = $_POST['category'];
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO prestasi (category, icon, title, description)
            VALUES ('$category', '$icon', '$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Hapus Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM prestasi WHERE id = $id";
    $conn->query($sql);
    header("Location: konten_prestasi.php");
}

// Edit Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE prestasi 
            SET category='$category', icon='$icon', title='$title', description='$description' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data berhasil diperbarui!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
    header("Location: konten_prestasi.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Prestasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body class="bg-light">

<div class="container mt-5">
    
    <h1 class="text-center mb-4">Kelola Prestasi</h1>
    
    <!-- Form Tambah Data -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Tambah Data Prestasi
        </div>
        <div class="card-body">
            
            <a href="admin_akademik.php" class="btn btn-secondary mb-4">Kembali</a>
            <form method="post" action="konten_prestasi.php">
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ikon (FontAwesome Class)</label>
                    <input type="text" name="icon" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>

                <button type="submit" name="add" class="btn btn-success">Tambah Data</button>
            </form>
            
        </div>
    </div>

    <!-- Tabel Data -->
    <h2 class="mb-3">Data Prestasi</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Ikon</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM prestasi";
        $result = $conn->query($sql);
        $no = 1;

        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><i class="fa <?= htmlspecialchars($row['icon']) ?>"></i></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td>
                    <a href="konten_prestasi.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    <a href="konten_prestasi.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- Form Edit -->
    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM prestasi WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        ?>

        <div class="card mt-4">
            <div class="card-header bg-warning text-dark">
                Edit Data Prestasi
            </div>
            <div class="card-body">
                <form method="post" action="konten_prestasi.php">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($row['category']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ikon (FontAwesome Class)</label>
                        <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($row['icon']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($row['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($row['description']) ?></textarea>
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
