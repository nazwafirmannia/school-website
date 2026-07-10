<?php include "koneksi.php" ; 

session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangani pengunggahan file
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
                $image_url = $destination;
            } else {
                die("Error uploading file.");
            }
        } else {
            die("Invalid file type.");
        }
    } else {
        die("No file uploaded or upload error.");
    }

    // Escape karakter khusus
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $button_text = $conn->real_escape_string($_POST['button_text']);
    

    // Query INSERT
    $query = "INSERT INTO carousel (image_url, title, description, button_text) 
              VALUES ('$image_url', '$title', '$description', '$button_text')";

    if ($conn->query($query)) {
        header("Location: admin_home.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM carousel");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 0.8rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .navbar-brand h2 {
            margin: 0;
            color: #06BBCC;
            font-weight: 600;
            font-size: clamp(1.2rem, 3vw, 1.5rem);
        }

        .nav-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: bold;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .nav-link:hover {
            color: #06BBCC;
            background-color: rgba(6, 187, 204, 0.1);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-btn {
            color: black;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1001;
        }

        .dropdown-content a {
            color: black;
            padding: 0.75rem 1rem;
            display: block;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #06BBCD;
            color: white;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .logout-btn:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-1px);
        }

        .admin-header {
            background-size: cover;
            background-position: center;
            padding: clamp(4rem, 10vw, 8rem) 0 clamp(2rem, 5vw, 4rem);
            margin-top: 72px;
        }

        .admin-header h1 {
            font-size: clamp(1.8rem, 5vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            color: black;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card a, .btn-primary {
            display: inline-block;
            background-color: #06BBCC;
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .card a:hover {
            background-color: #058e9d;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        .content-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .form-border {
            border: 0.5px solid black; 
        }
        .bordered-table, .bordered-form {
            border: 2px solid black; 
            padding: 20px; 
            border-radius: 10px; 
            background-color: #e9ecef; 
        }
        .bordered-card {
            border: 2px solid black; 
            padding: 20px; 
            border-radius: 10px; 
        }
        .form-label {
            font-weight: bold;
        }
        .table {
            border: 1px solid #dee2e6;
        }
        .table th, .table td {
            border: 1px solid #ced4da;
        }
        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="navbar-brand">
                    <img src="img/LOGO_SMA.gif" alt="SMA SENOPATI Logo">
                    <h2>Admin Dashboard</h2>
                </div>
                <button class="mobile-menu-btn" onclick="toggleMenu()">☰</button>
                <div class="nav-wrapper" id="navWrapper">
                    <a href="beranda.php" class="nav-link">Beranda</a>
                    <a href="data_siswa.php" class="nav-link">Data Siswa</a>
                    <a href="admin_menejemen.php" class="nav-link">Data Admin</a>
                    <a href="adminUpload.php" class="nav-link">Bukti Pendaftaran</a>
                    <div class="dropdown">
                        <span class="dropdown-btn">Kelola Web</span>
                        <div class="dropdown-content">
                            <a href="admin_home.php">Home</a>
                            <a href="admin_tentang.php">About</a>
                            <a href="admin_akademik.php">Akademik</a>
                            <a href="admin_galeri.php">Gallery</a>
                        </div>
                    </div>
                    <a href="logout.php" class="logout-btn">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="admin-header py-5">
        <div class="container">
            <h1 class="display-6 fw-bold">Kelola Web Home SMA SENOPATI</h1>
        </div>
    </header>

    <!-- Card Container -->
    <div class="container mt-4">
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
            <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Layanan dan Fasilitas</h3>
                        <a href="konten_home_layanan.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Guru</h3>
                        <a href="konten_guru.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Info Penting</h3>
                        <a href="konten_info_penting.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container my-4">
        <div class="content-card p-4 bordered-form">
            <h1 class="text-center text-purple mb-4">Admin Carousel</h1>
            <form method="POST" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Image File:</label>
                    <input type="file" class="form-control" name="image_file" accept="image/*" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Title:</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description:</label>
                    <textarea class="form-control" name="description" rows="4" required></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Button Text:</label>
                    <input type="text" class="form-control" name="button_text" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-30">Tambah Carousel</button>
                </div>
            </form>
    </div>

    <div class="container mt-5">
        <h2 class="text-center text-purple my-4">Existing Items</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-info">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Button</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><img src="<?php echo $row['image_url']; ?>" alt="" class="img-fluid" style="max-width: 100px;"></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['button_text']; ?></td>
                                <td><a href="delete_carousel.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                <a href="edit_konten_carousel.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                               
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
