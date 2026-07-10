<?php include "koneksi.php" ; 

// Koneksi database

session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}


// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['id'] as $key => $id) {
        $jumlah = $_POST['jumlah'][$key];
        $conn->query("UPDATE data_siswa SET jumlah = $jumlah WHERE id = $id");
    }
    header("Location: admin_tentang.php");
    exit;
}

// Fetch data
$result = $conn->query("SELECT * FROM data_siswa");
$data = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
      /* Style umum */
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
  <!-- Content -->

   <!-- Header -->
   <!-- Header -->
   <header class="admin-header py-5">
        <div class="container">
            <h1 class="display-6 fw-bold">Kelola Web Tentang SMA SENOPATI</h1>
        </div>
    </header>
    <!-- Tambahkan ini pada bagian body -->
    <div class="container mt-4">
        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Konten About</h3>
                        <a href="konten_about2.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Konten Kegiatan</h3>
                        <a href="konten_kegiatan.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <h1 class="text-center mb-4">Admin Panel - Konten Tentang</h1>
        <form method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kelas</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item): ?>
                    <tr>
                        <td><?php echo $item['kelas']; ?></td>
                        <td>
                            <input type="hidden" name="id[]" value="<?php echo $item['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control" value="<?php echo $item['jumlah']; ?>">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="#.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
