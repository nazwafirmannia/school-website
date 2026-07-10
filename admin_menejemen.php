<?php include "koneksi.php" ; 

session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah admin baru
if (isset($_POST['add_admin'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];

    // Cek apakah email sudah ada
    $check_email = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        // Jika email belum ada, lakukan INSERT
        $insert = $conn->prepare("INSERT INTO admin (username, password, email, nama, no_telp) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("sssss", $username, $password, $email, $nama, $no_telp);

        if ($insert->execute()) {
            echo "<script>alert('Admin berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan admin.');</script>";
        }
    }
}

// Update admin
if (isset($_POST['update_admin'])) {
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];

    $update = $conn->prepare("UPDATE admin SET username = ?, email = ?, nama = ?, no_telp = ? WHERE id_admin = ?");
    $update->bind_param("ssssi", $username, $email, $nama, $no_telp, $id_admin);
    $update->execute();
}

// Hapus admin
if (isset($_GET['delete'])) {
    $id_admin = $_GET['delete'];
    $delete = $conn->prepare("DELETE FROM admin WHERE id_admin = ?");
    $delete->bind_param("i", $id_admin);
    $delete->execute();
}

// Ambil data admin
$result = $conn->query("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Admin</title>
    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
/* Navbar */
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

        .navbar-brand h2 {
            margin: 0;
            color: #06BBCC;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-wrapper {
            display: flex;
            align-items: center;
            gap: 0.05rem;
            font-weight: bold;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #06BBCC;
            background-color: rgba(6, 187, 204, 0.1);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-btn {
            color: black;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .dropdown-btn:hover {
            background-color: white;
            color: #06BBCD;
            transform: scale(1.1);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            animation: fadeIn 0.3s ease;
        }

        .dropdown-content a {
            color: black;
            padding: 0.75rem 1rem;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #06BBCD;
            color: white;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .admin-header {
            background-size: cover;
            background-position: center;
            padding: 8rem 0 4rem;
            margin-top: 72px;
        }

        .admin-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            color: black; 
        }

        .admin-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            color: black; 
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-left: 20px; 
        }

        .logout-btn:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-1px);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

/* Slide-down animation */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Form responsive styles */
@media (max-width: 576px) {
    .card-body {
        padding: 1rem;
    }
    
    .form-control {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .mobile-menu-btn {
        display: block;
    }
    .navbar {
        flex-direction: column;    
    }
    .navbar-collapse {
        flex-direction: column;
        align-items: flex-start;
    }
    .navbar-nav {
        flex-direction: column;
    }
    .nav-item {
        margin-right: 0;
        margin-bottom: 10px;
    }
    .nav-item a {
        padding: 10px 15px;
    }
    .dropdown {
        margin-bottom: 10px;
    }
    .dropdown-btn {
        width: 100%;
    }
    .dropdown-content {
        min-width: 100%;
    }
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .card {
        margin: 1rem;
    }
    .container {
        padding: 0 10px;
    }
}

/* Responsive styles */
@media (max-width: 991px) {
    .mobile-menu-btn {
        display: block;
    }

    .nav-wrapper {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: white;
        padding: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        flex-direction: column;
        align-items: stretch;
    }

    .nav-wrapper.active {
        display: flex;
    }

    .nav-link {
        padding: 0.75rem 1rem;
        width: 100%;
        text-align: left;
    }

    .dropdown {
        width: 100%;
    }

    .dropdown-btn {
        width: 100%;
        text-align: left;
        padding: 0.75rem 1rem;
    }

    

    .dropdown-content.show {
        display: block;
    }

    .logout-btn {
        margin: 0.5rem 0;
        width: 100%;
        text-align: center;
    }
}


/* Slide-down animation */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


        /* Spasi antara navbar dan konten */
        .content {
            padding: 20px;
            margin-top: 10px;
            background-color: transparent;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }


        
    </style>
</head>
<body>
   <!-- Navbar -->
    <!-- Navbar -->
 <nav class="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="navbar-brand">
                    <img src="img/LOGO_SMA.gif" alt="SMA SENOPATI Logo" width="50" height="50">
                    <h2>Admin Dashboard</h2>
                </div>
                <button class="mobile-menu-btn" onclick="toggleMenu()">☰</button>
                <div class="nav-wrapper">
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
<header class="admin-header">
        <div class="container">
            <h1>Data Admin SMA SENOPATI</h1>
        </div>
    </header>



    <!-- Container utama -->
    <div class="container mt-5">
       
        <!-- Daftar Admin -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5>Daftar Admin</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_admin'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['no_telp'] ?></td>
                            <td>
                                <a href="edit_admin.php?id=<?= $row['id_admin'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?delete=<?= $row['id_admin'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form Tambah Admin -->
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5>Tambah Admin Baru</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                    </div>
                    <button type="submit" name="add_admin" class="btn btn-success">Tambah Admin</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php $conn->close(); ?>
