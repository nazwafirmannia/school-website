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
        @media (max-width: 768px) {
            .card {
                margin: 0.5rem;
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
            <h1 class="display-6 fw-bold">Kelola Web Akademik SMA SENOPATI</h1>
        </div>
    </header>

    <!-- Content -->
    <div class="container mt-4">
        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Ekstrakurikuler</h3>
                        <a href="konten_ekstra.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Prestasi</h3>
                        <a href="konten_prestasi.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center bordered-card">
                    <div class="card-body">
                        <h3 class="card-title">Prestasi 2</h3>
                        <a href="konten_prestasi2.php" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>