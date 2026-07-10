<?php
// Koneksi ke database
include 'koneksi.php';

// Tambah/Edit Data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $video = $_FILES['video']['name'];

    if ($id) {
        // Update data
        if ($video) {
            move_uploaded_file($_FILES['video']['tmp_name'], "uploads/" . $video);
            $query = "UPDATE kegiatan SET judul='$judul', deskripsi='$deskripsi', video='$video' WHERE id=$id";
        } else {
            $query = "UPDATE kegiatan SET judul='$judul', deskripsi='$deskripsi' WHERE id=$id";
        }
    } else {
        // Tambah data baru
        move_uploaded_file($_FILES['video']['tmp_name'], "uploads/" . $video);
        $query = "INSERT INTO kegiatan (judul, deskripsi, video) VALUES ('$judul', '$deskripsi', '$video')";
    }

    mysqli_query($conn, $query);
    header("Location: konten_kegiatan.php");
}

// Hapus Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id=$id");
    header("Location: konten_kegiatan.php");
}

// Data untuk form edit
$editData = ['id' => '', 'judul' => '', 'deskripsi' => '', 'video' => ''];
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $resultEdit = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id=$id");
    if ($resultEdit && mysqli_num_rows($resultEdit) > 0) {
        $editData = mysqli_fetch_assoc($resultEdit);
    }
}

// Tampilkan semua data
$result = mysqli_query($conn, "SELECT * FROM kegiatan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Kelola Kegiatan</h2>

    <form method="POST" enctype="multipart/form-data" class="mb-4">
        <input type="hidden" name="id" id="id" value="<?php echo $editData['id']; ?>">

        <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" class="form-control" name="judul" id="judul" required value="<?php echo htmlspecialchars($editData['judul']); ?>">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" required><?php echo htmlspecialchars($editData['deskripsi']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="video">Upload Video:</label>
            <input type="file" class="form-control-file" name="video" id="video" <?php echo $editData['video'] ? '' : 'required'; ?>>
        </div>

        <?php if ($editData['video']) : ?>
            <p>Video Saat Ini:</p>
            <video src="uploads/<?php echo $editData['video']; ?>" width="200" controls></video>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    <a href="admin_tentang.php" class="btn btn-secondary mb-4">Kembali</a>

    <h3>Daftar Kegiatan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Video</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['judul']; ?></td>
                <td><?php echo $row['deskripsi']; ?></td>
                <td><video src="uploads/<?php echo $row['video']; ?>" width="200" controls></video></td>
                <td>
                    <a href="konten_kegiatan.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="konten_kegiatan.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
