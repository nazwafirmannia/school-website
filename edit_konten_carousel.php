<?php include "koneksi.php" ; 
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escape karakter khusus
    $id = $_POST['id'];
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $button_text = $conn->real_escape_string($_POST['button_text']);
    
    // Cek apakah ada file gambar yang diunggah
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmpPath = $_FILES['image_file']['tmp_name'];
        $fileName = basename($_FILES['image_file']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = uniqid('img_', true) . '.' . $fileExtension;
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destination)) {
                // Update query dengan gambar baru
                $query = "UPDATE carousel SET title='$title', description='$description', button_text='$button_text', image_url='$destination' WHERE id='$id'";
            } else {
                die("Error uploading file.");
            }
        } else {
            die("Invalid file type.");
        }
    } else {
        // Jika tidak ada gambar baru, tetap gunakan gambar yang lama
        $query = "UPDATE carousel SET title='$title', description='$description', button_text='$button_text' WHERE id='$id'";
    }

    if ($conn->query($query)) {
        header("Location: admin_home.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM carousel WHERE id='$id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Carousel</h1>
        <a href="admin_home.php" class="btn btn-secondary">Kembali</a>
        <form method="POST" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="col-md-6">
                <label class="form-label">Title:</label>
                <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Description:</label>
                <textarea class="form-control" name="description" rows="4" required><?php echo $row['description']; ?></textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Button Text:</label>
                <input type="text" class="form-control" name="button_text" value="<?php echo $row['button_text']; ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Current Image:</label>
                <img src="<?php echo $row['image_url']; ?>" alt="Current Image" class="img-fluid" style="max-width: 200px;">
            </div>
            <div class="col-12">
                <label class="form-label">Upload New Image (optional):</label>
                <input type="file" class="form-control" name="image_file" accept="image/*">
                <small class="form-text text-muted">Leave blank if you do not want to change the image.</small>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update Carousel</button>
            </div>
        </form>
    </div>
</body>
</html>