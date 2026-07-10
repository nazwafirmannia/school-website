<?php include 'koneksi.php';
// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses Hapus Data
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_stmt = $conn->prepare("DELETE FROM ekstrakurikuler WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);

    if ($delete_stmt->execute()) {
        echo "<div class='alert alert-success'>Ekstrakurikuler berhasil dihapus.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $delete_stmt->error . "</div>";
    }
    $delete_stmt->close();
}

// Proses Edit Data
$data = null; // Initialize $data
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_stmt = $conn->prepare("SELECT * FROM ekstrakurikuler WHERE id = ?");
    $edit_stmt->bind_param("i", $edit_id);
    $edit_stmt->execute();
    $result = $edit_stmt->get_result();
    $data = $result->fetch_assoc();
    $edit_stmt->close();
}

// Proses Tambah dan Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_id'])) {
        // Update data
        $edit_id = $_POST['edit_id'];
        $judul = $conn->real_escape_string($_POST['judul']);
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "img/Kegiatan Ekstra/";
        $target_file = $target_dir . basename($gambar);

        if (!empty($gambar)) {
            // Pindahkan file gambar ke direktori yang ditentukan
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                $stmt = $conn->prepare("UPDATE ekstrakurikuler SET judul = ?, gambar = ? WHERE id = ?");
                $stmt->bind_param("ssi", $judul, $gambar, $edit_id);
            } else {
                echo "<div class='alert alert-danger'>Gagal meng-upload gambar.</div>";
            }
        } else {
            // Jika gambar tidak diupload, hanya update judul
            $stmt = $conn->prepare("UPDATE ekstrakurikuler SET judul = ? WHERE id = ?");
            $stmt->bind_param("si", $judul, $edit_id);
        }

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Ekstrakurikuler berhasil diperbarui.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        // Tambah data
        $judul = $conn->real_escape_string($_POST['judul']);
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "img/Kegiatan Ekstra/";
        $target_file = $target_dir . basename($gambar);

        // Pindahkan file gambar ke direktori yang ditentukan
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO ekstrakurikuler (judul, gambar) VALUES (?, ?)");
            $stmt->bind_param("ss", $judul, $gambar);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Ekstrakurikuler berhasil ditambahkan.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Gagal meng-upload gambar.</div>";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Ekstrakurikuler</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            background: #ffffff;
            color: #333;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 40px;
        }
        .form-control, .form-control-file {
            border-radius: 8px;
            padding: 10px;
        }
        button {
            border: none;
            border-radius: 50px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        button:hover {
            background: linear-gradient(to left, #6a11cb, #2575fc);
            transform: translateY(-2px);
        }
        .card {
            border: none;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .card img {
            border-radius: 12px 12px 0 0;
            height: 180px;
            object-fit: cover;
        }
        h1, h6 {
            font-weight: bold;
        }
        h1 {
            color: #2575fc;
        }
        h6 {
            color: #6a11cb;
        }
        .navbar {
            background: #2575fc;
            padding: 15px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 20px;
        }
        footer {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .btn-sm {
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 14px;
        }
        .btn-sm:hover {
            background: #2575fc !important;
            color: #fff !important;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            .card img {
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <!-- Main Container -->
    <div class="container">
        <div class="text-center mt-4">
            <a href="admin_akademik.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <h1 class="text-center mb-4">Tambah Ekstrakurikuler</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="form-group mb-4">
                <label for="judul" class="form-label">Judul:</label>
                <input type="text" id="judul" name="judul" class="form-control" value="<?php echo isset($data) ? $data['judul'] : ''; ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="gambar" class="form-label">Gambar:</label>
                <input type="file" id="gambar" name="gambar" class="form-control-file">
                <?php if (isset($data)): ?>
                    <p class="mt-2">Gambar Saat Ini: <img src="img/Kegiatan Ekstra/<?php echo $data['gambar']; ?>" alt="" width="100"></p>
                <?php endif; ?>
            </div>
            <?php if (isset($data)): ?>
                <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
                <button type="submit" class="btn w-100">Update</button>
            <?php else: ?>
                <button type="submit" class="btn w-100">Tambah</button>
            <?php endif; ?>
        </form>

        <div class="text-center section-title mb-5">
            <h6 class="bg-white text-primary px-3 py-2 d-inline-block rounded-pill">SMA SENOPATI</h6>
            <h1 class="mb-5">EKSTRAKURIKULER</h1>
        </div>

        <!-- Cards Section -->
        <div class="row g-4">
            <?php include 'koneksi.php';
            $sql = "SELECT * FROM ekstrakurikuler";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-lg-4 col-md-6">';
                    echo '<div class="card">';
                    echo '<img class="card-img-top" src="img/Kegiatan Ekstra/' . $row["gambar"] . '" alt="">';
                    echo '<div class="card-body text-center">';
                    echo '<h5 class="card-title mb-3">' . $row["judul"] . '</h5>';
                    echo '<a href="?delete_id=' . $row["id"] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus?\')"><i class="fas fa-trash-alt"></i> Hapus</a> ';
                    echo '<a href="?edit_id=' . $row["id"] . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12 text-center">Tidak ada ekstrakurikuler yang tersedia.</div>';
            }

            $conn->close();
            ?>
        </div>

       
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
