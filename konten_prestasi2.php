<?php include 'koneksi.php';
// Tambah Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tab_name = $_POST['tab_name'];

    // Upload file gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["add"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File adalah gambar - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Maaf, file tidak dapat diupload.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "File ". basename( $_FILES["image"]["name"]). " telah diupload.";
        } else {
            echo "Maaf, file tidak dapat diupload.";
        }
    }

    $image_url = $target_file;

    $sql = "INSERT INTO prestasi2 (title, description, image_url, tab_name)
            VALUES ('$title', '$description', '$image_url', '$tab_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Hapus Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM prestasi2 WHERE id = $id";
    $conn->query($sql);
    header("Location: konten_prestasi2.php");
}

// Edit Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tab_name = $_POST['tab_name'];

    // Upload file gambar
    if ($_FILES["image"]["name"] != "") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["update"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File adalah gambar - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File bukan gambar.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Maaf, file tidak dapat diupload.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "File ". basename( $_FILES["image"]["name"]). " telah diupload.";
    } else {
        echo "Maaf, file tidak dapat diupload.";
    }
}

$image_url = $target_file;

$sql = "UPDATE prestasi2 SET 
        title='$title', 
        description='$description', 
        image_url='$image_url', 
        tab_name='$tab_name' 
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success'>Data berhasil diperbarui!</div>";
} else {
    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
}
} else {
    $sql = "UPDATE prestasi2 SET 
            title='$title', 
            description='$description', 
            tab_name='$tab_name' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data berhasil diperbarui!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Prestasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
    <a href="admin_akademik.php" class="btn btn-secondary mb-4">Kembali</a>
    <h1>Tambah Data Prestasi</h1>
    <form method="post" action="konten_prestasi2.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul:</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label>Upload Gambar:</label>
            <input type="file" class="form-control" name="image" required>
        </div>
        <div class="form-group">
            <label>Nama Tab:</label>
            <input type="text" class="form-control" name="tab_name" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Tambah Data</button>
    </form>

    <h2 class="mt-5">Data Prestasi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Nama Tab</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM prestasi2";
            $result = $conn->query($sql);
            $no = 1;

            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['description'] ?></td>
                    
                    <td><img src="<?= $row['image_url'] ?>" class="img-fluid" width="100"></td>
                    <td><?= $row['tab_name'] ?></td>
                    <td>
                        <a href="konten_prestasi2.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="konten_prestasi2.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php 
    // Form Edit Data
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM prestasi2 WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <h1>Edit Data Prestasi</h1>
    <form method="post" action="konten_prestasi2.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="form-group">
            <label>Judul:</label>
            <input type="text" class="form-control" name="title" value="<?= $row['title'] ?>" required>
        </div>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea class="form-control" name="description" required><?= $row['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label>Upload Gambar:</label>
            <input type="file" class="form-control" name="image">
            <img src="<?= $row['image_url'] ?>" class="img-fluid" width="100">
        </div>
        <div class="form-group">
            <label>Nama Tab:</label>
            <input type="text" class="form-control" name="tab_name" value="<?= $row['tab_name'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-success">Perbarui Data</button>
    </form>
    <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>