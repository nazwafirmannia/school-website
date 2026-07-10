<?php include 'koneksi.php';
// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tambah layanan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $delay = $_POST['delay'];

    $sql = "INSERT INTO services (icon, title, description, delay) VALUES ('$icon', '$title', '$description', '$delay')";
    $conn->query($sql);
}

// Ambil semua layanan
$result = $conn->query("SELECT * FROM services");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Services</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 30px;
        }
        .btn {
            margin: 5px;
        }
        .card {
            border: none;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }
        .form-control, .btn-primary {
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1>Admin Services</h1>
            </div>
            <div class="card-body">
                <a href="admin_home.php" class="btn btn-secondary mb-4">Kembali</a>
                <form action="" method="POST" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="icon" class="form-label">Icon Class</label>
                            <input type="text" name="icon" class="form-control" placeholder="Icon Class" required>
                        </div>
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="delay" class="form-label">Delay</label>
                            <input type="number" name="delay" class="form-control" placeholder="Delay (seconds)" step="0.1" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Add Service</button>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header text-center">
                <h2>Current Services</h2>
            </div>
            <div class="card-body">
                <?php if ($result->num_rows > 0): ?>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Delay</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><i class="<?php echo $row['icon']; ?>"></i></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo $row['delay']; ?>s</td>
                                <td>
                                    <a href="edit_layanan.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_layanan.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">Belum ada layanan yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
