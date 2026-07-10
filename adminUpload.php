<?php include 'koneksi.php';

$message = '';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    $result = mysqli_query($conn, "SELECT file FROM uploadfile WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $file_name = $row['file'];

    if (file_exists("berkas/" . $file_name)) {
        if (unlink("berkas/" . $file_name)) {
            if (mysqli_query($conn, "DELETE FROM uploadfile WHERE id = $id")) {
                $message = "<div class='alert alert-success'>File berhasil dihapus.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Gagal menghapus dari database.</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Gagal menghapus file dari server.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>File tidak ditemukan di server.</div>";
    }
}

$result = mysqli_query($conn, "SELECT * FROM uploadfile");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Upload</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    color: #333;
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
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            color: #06BBCC;
        }

        /* Main Content Styles */
        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
        }

        .page-title {
            text-align: center;
            color: #06BBCC;
            margin-bottom: 2rem;
        }

        /* Table Styles */
        .table-responsive {
            overflow-x: auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #06BBCC;
            color: #ffffff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #06BBCC;
            color: #ffffff;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        /* Alert Styles */
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #28a745;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #dc3545;
            border: 1px solid #f5c6cb;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s;
        }

        .modal-content {
            background-color: #ffffff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 800px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 28px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 991px) {
    .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        padding: 1rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        display: none;
    }

    .navbar-collapse.show {
        display: block;
    }

    .navbar-nav {
        flex-direction: column;
        gap: 0.5rem;
    }

            .nav-menu.active {
                display: flex;
            }

            .dropdown-content {
                position: static;
                box-shadow: none;
                width: 100%;
            }

            .nav-link {
                width: 100%;
                text-align: center;
            }

            .table-responsive {
                margin: 0 -15px;
                border-radius: 0;
            }

            th, td {
                padding: 0.75rem;
                font-size: 0.9rem;
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

            .nav-link {
                width: 100%;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #eee;
            }

            .dropdown {
                width: 100%;
            }

            .dropdown-btn {
                display: none; /* Hide dropdown button on mobile */
            }

            .dropdown-content {
                display: block;
                position: static;
                box-shadow: none;
                background: transparent;
                padding: 0;
            }

            .dropdown-content a {
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #eee;
                color: #333;
            }

            .logout-btn {
                width: 100%;
                text-align: center;
                margin-top: 0.5rem;
            }
        }
    }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
                <button class="navbar-toggler" onclick="toggleMenu()">☰</button>
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
            <h1>Bukti Pendaftaran Siswa SMA SENOPATI</h1>
        </div>
    </header>
    </header>
            
            <?php if (!empty($message)) echo $message; ?>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pendaftar</th>
                            <th>File</th>
                            <th>Waktu Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['file']; ?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($row['upload_date'])); ?></td>
                            <td>
                                <a href="#" class="btn btn-primary view-link" data-file="berkas/<?php echo $row['file']; ?>">Lihat</a>
                                <a href="berkas/<?php echo $row['file']; ?>" class="btn btn-primary" download>Unduh</a>
                                <a href="adminUpload.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- File Preview Modal -->
    <div id="fileModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <iframe id="fileViewer" style="width: 100%; height: 500px; border: none;"></iframe>
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
        
         // File preview functionality
         document.querySelectorAll('.view-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const file = this.getAttribute('data-file');
                const fileViewer = document.getElementById('fileViewer');
                const fileExtension = file.split('.').pop().toLowerCase();

                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    fileViewer.style.display = 'none';
                    const img = document.createElement('img');
                    img.src = file;
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                    fileViewer.parentNode.insertBefore(img, fileViewer);
                } else if (fileExtension === 'pdf') {
                    fileViewer.src = file;
                    fileViewer.style.display = 'block';
                } else {
                    alert('File tidak dapat ditampilkan di browser.');
                    return;
                }

                document.getElementById('fileModal').style.display = 'block';
            });
        });

        // Close modal
        document.querySelector('.close').onclick = function() {
            document.getElementById('fileModal').style.display = 'none';
            document.getElementById('fileViewer').src = '';
            const img = document.querySelector('.modal-content img');
            if (img) img.remove();
        }

        // Close modal when clicking outside
        window.onclick = function(e) {
            if (e.target == document.getElementById('fileModal')) {
                document.getElementById('fileModal').style.display = 'none';
                document.getElementById('fileViewer').src = '';
                const img = document.querySelector('.modal-content img');
                if (img) img.remove();
            }
        }
    </script>
</body>
</html>