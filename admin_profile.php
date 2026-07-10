<?php include "koneksi.php" ; 

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current Visi data
$visi_query = $conn->query("SELECT * FROM visi LIMIT 1");
$visi = $visi_query->fetch_assoc();

// Check if any data was fetched from the database
if ($visi === null) {
    // If no data is found, you can display a message or handle it accordingly
    echo "No Visi data found. Please check the database.";
    exit; // Stop the script execution if no data is found
}

// Handle form submission for updating Visi data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul_section = $_POST['judul_section'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Handle image upload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['name']) {
        $gambar = "uploads/" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
    } else {
        $gambar = $visi['gambar']; // Keep old image if no new one is uploaded
    }

    // Update database
    $stmt = $conn->prepare("UPDATE visi SET judul_section=?, judul=?, deskripsi=?, gambar=? WHERE id=1");
    $stmt->bind_param("ssss", $judul_section, $judul, $deskripsi, $gambar);

    if ($stmt->execute()) {
        header("Location: admin_profile.php"); // Redirect after successful update
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Visi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-thumbnail {
            max-width: 150px;
            max-height: 150px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Visi Content</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul_section">Judul Section</label>
                <input type="text" name="judul_section" class="form-control" value="<?= htmlspecialchars($visi['judul_section']) ?>" required>
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($visi['judul']) ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($visi['deskripsi']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" class="form-control">
                <?php if ($visi['gambar']): ?>
                    <img src="<?= htmlspecialchars($visi['gambar']) ?>" alt="Current Image" class="img-thumbnail">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
        </form>
    </div>
</body>
</html>
