<?php
include 'koneksi.php';

session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}
// Cek apakah ada pencarian yang dilakukan
$search_keyword = "";
if (isset($_POST['search'])) {
    $search_keyword = mysqli_real_escape_string($conn, $_POST['search_keyword']);
    $query = mysqli_query($conn, "SELECT * FROM data_peserta WHERE nama LIKE '%$search_keyword%' OR nisn LIKE '%$search_keyword%' OR nik LIKE '%$search_keyword%'"); 
} else {
    $query = mysqli_query($conn, "SELECT * FROM data_peserta"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
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

        /* Mobile navigation */
        .navbar-toggler {
            display: none;
            background: none;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .navbar-toggler {
                display: block;
            }

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
                align-items: flex-start;
            }

            .nav-wrapper.active {
                display: flex;
            }
        }

        /* Search and control styles */
        .control-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: white;
            margin: 1rem 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .search-input {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 250px;
        }

        .search-button {
            padding: 0.5rem 1rem;
            background-color: #06BBCC;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 1rem 0;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: #06BBCC;
            color: white;
            padding: 1rem;
            text-align: left;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        /* Mobile cards */
        .mobile-cards {
            display: none;
        }

        @media (max-width: 768px) {
            .table-container {
                display: none;
            }

            .mobile-cards {
                display: block;
            }

            .student-card {
                background: white;
                border-radius: 8px;
                padding: 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .student-card h3 {
                color: #06BBCC;
                margin: 0 0 1rem 0;
            }

            .student-info {
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 0.5rem;
                margin-bottom: 1rem;
            }

            .student-info dt {
                font-weight: bold;
                color: #666;
            }

            .card-actions {
                display: flex;
                gap: 0.5rem;
                justify-content: flex-end;
            }

            .control-container {
                flex-direction: column;
            }

            .search-container form {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                width: 100%;
            }

            .search-input {
                width: 100%;
            }

            .btn-success {
                width: 100%;
            }
        }

        /* Button styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-view {
            background-color: #06BBCC;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
            color: black;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-primary {
            background-color: #06BBCC;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
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

    <header class="admin-header">
        <div class="container">
            <h1>Data Siswa SMA SENOPATI</h1>
        </div>
    </header>

    <div class="container">
        <div class="control-container">
            <div class="search-container">
                <form action="data_siswa.php" method="POST">
                    <input type="text" name="search_keyword" class="search-input" 
                        placeholder="Cari berdasarkan nama, NISN, atau NIK" 
                        value="<?php echo htmlspecialchars($search_keyword); ?>">
                    <button type="submit" name="search" class="search-button">Cari</button>
                </form>
            </div>
            <a href="tambah_peserta.php" class="btn btn-primary">Tambah Data Peserta</a>
            <div class="export-container">
                <form action="export_excel.php" method="POST">
                    <button type="submit" class="btn btn-success">Ekspor ke Excel</button>
                </form>
            </div>
        </div>

        <!-- Table view for desktop -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pendaftaran</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>NISN</th>
                        <th>NIK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . $row['nisn'] . "</td>";
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td class='action-buttons'>
                                <a class='btn btn-view' href='detail_siswa.php?id=" . $row['id'] . "'>Detail</a>
                                <a class='btn btn-edit' href='edit_peserta.php?id=" . $row['id'] . "'>Edit</a>
                                <a class='btn btn-delete' href='hapus_peserta.php?id=" . $row['id'] . "'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Card view for mobile -->
        <div class="mobile-cards">
            <?php
            mysqli_data_seek($query, 0); // Reset query pointer
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<div class='student-card'>";
                echo "<h3>" . $row['nama'] . "</h3>";
                echo "<dl class='student-info'>";
                echo "<dt>Kode Pendaftaran:</dt><dd>" . $row['id'] . "</dd>";
                echo "<dt>NISN:</dt><dd>" . $row['nisn'] . "</dd>";
                echo "<dt>NIK:</dt><dd>" . $row['nik'] . "</dd>";
                echo "<dt>Jenis Kelamin:</dt><dd>" . $row['jenis_kelamin'] . "</dd>";
                echo "</dl>";
                echo "<div class='card-actions'>";
                echo "<a class='btn btn-view' href='detail_siswa.php?id=" . $row['id'] . "'>Detail</a>";
                echo "<a class='btn btn-edit' href='edit_peserta.php?id=" . $row['id'] . "'>Edit</a>";
                echo "<a class='btn btn-delete' href='hapus_peserta.php?id=" . $row['id'] . "'>Hapus</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script>
        // Toggle mobile navigation
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            document.querySelector('.nav-wrapper').classList.toggle('active');
        });

        // Toggle dropdowns on mobile
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                if (window.innerWidth <= 991) {
                    e.preventDefault();
                    this.querySelector('.dropdown-content').classList.toggle('show');
                }
            });
        });

        // Close dropdowns when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-btn')) {
                document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                    if (dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                    }
                });
            }
        });
        
        function toggleMenu() {
            const navWrapper = document.getElementById('navWrapper');
            navWrapper.classList.toggle('active');
        }
        
    </script>
</body>
</html>











