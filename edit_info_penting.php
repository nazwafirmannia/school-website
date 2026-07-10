<?php include "koneksi.php" ; 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Make sure $id is an integer to prevent SQL injection
    $result = $conn->query("SELECT * FROM info_penting WHERE id = $id");

    // If no record found
    if ($result->num_rows === 0) {
        die("Record not found.");
    }

    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $judul_section = mysqli_real_escape_string($conn, $_POST['judul_section']);
    $judul_info = mysqli_real_escape_string($conn, $_POST['judul_info']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $icon_class = mysqli_real_escape_string($conn, $_POST['icon_class']);
    $warna_icon = mysqli_real_escape_string($conn, $_POST['warna_icon']);

    // Handle image upload
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target = "uploads/" . basename($gambar);

        // Check if the file is a valid image
        $check = getimagesize($_FILES['gambar']['tmp_name']);
        if ($check === false) {
            die("File is not an image.");
        }

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $stmt = $conn->prepare("UPDATE info_penting SET judul_section=?, judul_info=?, deskripsi=?, icon_class=?, warna_icon=?, gambar=? WHERE id=?");
            $stmt->bind_param("ssssssi", $judul_section, $judul_info, $deskripsi, $icon_class, $warna_icon, $gambar, $id);
        } else {
            die("Failed to upload image.");
        }
    } else {
        // If no image was uploaded, update without the image field
        $stmt = $conn->prepare("UPDATE info_penting SET judul_section=?, judul_info=?, deskripsi=?, icon_class=?, warna_icon=? WHERE id=?");
        $stmt->bind_param("sssssi", $judul_section, $judul_info, $deskripsi, $icon_class, $warna_icon, $id);
    }

    if ($stmt->execute()) {
        header("Location: konten_info_penting.php");
        exit;
    } else {
        die("Error: " . $stmt->error);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Info Penting</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Edit Info Penting</h2>
        <a href="konten_info_penting.php" class="btn btn-secondary">Kembali</a>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul_section">Judul Section</label>
                <input type="text" name="judul_section" class="form-control" value="<?php echo htmlspecialchars($row['judul_section']); ?>" required>
            </div>
            <div class="form-group">
                <label for="judul_info">Judul Info</label>
                <input type="text" name="judul_info" class="form-control" value="<?php echo htmlspecialchars($row['judul_info']); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="icon_class">Icon Class</label>
                <input type="text" name="icon_class" class="form-control" value="<?php echo htmlspecialchars($row['icon_class']); ?>" required>
            </div>
            <div class="form-group">
                <label for="warna_icon">Warna Icon</label>
                <input type="text" name="warna_icon" class="form-control" value="<?php echo htmlspecialchars($row['warna_icon']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar (Kosongkan jika tidak ingin mengubah)</label>
                <input type="file" name="gambar" class="form-control">
                <?php if ($row['gambar']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar" style="width: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Info Penting</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
