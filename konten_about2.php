<?php include 'koneksi.php';
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$row = null; // Variabel untuk menyimpan data saat mode edit

// Jika tombol "Edit" ditekan
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM about_us WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

// Tambah atau Edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $promo = $conn->real_escape_string($_POST['promo']);
    $features = $conn->real_escape_string($_POST['features']);
    $button_text = $conn->real_escape_string($_POST['button_text']);
    $button_link = $conn->real_escape_string($_POST['button_link']);
    
    // Proses upload gambar
    if (!empty($_FILES['image']['name'])) {
        $image_path = 'img/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    } else {
        $image_path = $_POST['current_image'];
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update data
        $id = (int)$_POST['id'];
        $sql = "UPDATE about_us SET title='$title', description='$description', promo='$promo', 
                features='$features', button_text='$button_text', button_link='$button_link', image_path='$image_path' 
                WHERE id=$id";
    } else {
        // Tambah data baru
        $sql = "INSERT INTO about_us (title, description, promo, features, button_text, button_link, image_path) 
                VALUES ('$title', '$description', '$promo', '$features', '$button_text', '$button_link', '$image_path')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: konten_about2.php?success=1");
        exit;
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM about_us WHERE id=$id");
    header("Location: konten_about2.php?deleted=1");
    exit;
}

// Ambil data dari database
$result = $conn->query("SELECT * FROM about_us");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Kelola About Us</h2>
    <?php if (isset($_GET['success'])) echo "<div class='alert alert-success'>Data berhasil disimpan.</div>"; ?>
    <?php if (isset($_GET['deleted'])) echo "<div class='alert alert-warning'>Data berhasil dihapus.</div>"; ?>

    <!-- Form Tambah/Edit -->
    <form method="POST" enctype="multipart/form-data" class="mb-5">
        <input type="hidden" name="id" value="<?= isset($row['id']) ? $row['id'] : '' ?>">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="<?= $row['title'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" required><?= $row['description'] ?? '' ?></textarea>
        </div>
        <div class="mb-3">
            <label>Promo</label>
            <textarea name="promo" class="form-control" rows="2"><?= $row['promo'] ?? '' ?></textarea>
        </div>
        <div class="mb-3">
            <label>Fitur</label>
            <textarea name="features" class="form-control" rows="3"><?= $row['features'] ?? '' ?></textarea>
        </div>
        <div class="mb-3">
            <label>Teks Tombol</label>
            <input type="text" name="button_text" class="form-control" value="<?= $row['button_text'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label>Link Tombol</label>
            <input type="text" name="button_link" class="form-control" value="<?= $row['button_link'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control">
            <input type="hidden" name="current_image" value="<?= $row['image_path'] ?? '' ?>">
            <?php if (!empty($row['image_path'])): ?>
                <img src="<?= $row['image_path'] ?>" alt="Gambar" width="100">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>

    </form>
    <a href="admin_tentang.php" class="btn btn-secondary mb-4">Kembali</a>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><img src="<?= $row['image_path'] ?>" alt="Gambar" width="100"></td>
                    <td>
                        <a href="konten_about2.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="konten_about2.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
