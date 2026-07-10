<?php include "koneksi.php" ; 

// Tambah data
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $instagram_embed = $_POST['instagram_embed'];

    $stmt = $conn->prepare("INSERT INTO gallery (title, category, instagram_embed) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $category, $instagram_embed);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_galeri.php");
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $instagram_embed = $_POST['instagram_embed'];

    $stmt = $conn->prepare("UPDATE gallery SET title=?, category=?, instagram_embed=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $category, $instagram_embed, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_galeri.php");
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_galeri.php");
}

// Ambil data
$result = $conn->query("SELECT * FROM gallery");
$galleryItems = [];
while ($row = $result->fetch_assoc()) {
    $galleryItems[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Gallery</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
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
            margin-top: 72px; 
            padding: clamp(4rem, 10vw, 8rem) 0 clamp(2rem, 5vw, 4rem); 
        }
        @media (max-width: 991px) {
            .navbar-nav {
                align-items: flex-start !important;
            }
        }

        iframe {
            width: 100%;
            height: 300px;
        }
        .form-label {
            font-weight: bold;
        }
        .bordered-form {
            border: 2px solid black; 
            padding: 20px; 
            border-radius: 10px; 
            background-color: #e9ecef; 
        }
    </style>
</head>
<body>
\  <!-- Navbar -->
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

    <header class="admin-header py-5">
        <div class="container">
            <h1 class="display-6 fw-bold">Kelola Web Gallery SMA SENOPATI</h1>
        </div>
    </header>

    <div class="container mt-5">
        <form method="POST" class="content-card p-4 bordered-form">
            <div class="mb-3">
                <label for="title" class="form-label">Judul:</label>
                <input type="text" class="form-control" name="title" required placeholder="Masukkan judul galeri">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori:</label>
                <select class="form-select" name="category" required>
                    <option value="">Pilih kategori</option>
                    <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
                    <option value="Prestasi">Prestasi</option>
                    <option value="Ekstrakurikuler">Ekstrakurikuler</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="instagram_embed" class="form-label">URL Embed Instagram Reel:</label>
                <input type="text" class="form-control" name="instagram_embed" required 
                    placeholder="https://www.instagram.com/reel/[CODE]/embed">
                <small class="text-muted">Contoh: https://www.instagram.com/reel/CskVsWMpipr/embed</small>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Tambah Konten</button>
        </form>

        <div class="container mt-5">
            <h2 class="text-center text-purple my-4">Existing List</h2>
        </div>

        <div class="row g-4">
        <?php foreach ($galleryItems as $item): ?>
        <div class="col-md-4">
            <div class="position-relative">
                <iframe 
                    src="<?php echo htmlspecialchars($item['instagram_embed']); ?>"
                    class="w-100" height="450" frameborder="0" allowfullscreen></iframe>
                <div class="bg-white text-center p-3">
                    <h5><?php echo htmlspecialchars($item['title']); ?></h5>
                    <small class="text-primary"><?php echo htmlspecialchars($item['category']); ?></small>
                    
                    <div class="mt-2">
                        <a href="admin_galeri.php?delete=<?php echo $item['id']; ?>" 
                        onclick="return confirm('Are you sure?')" 
                        class="btn btn-danger">Hapus</a>
                        <button type="button" 
                                class="btn btn-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal<?php echo $item['id']; ?>">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal<?php echo $item['id']; ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul:</label>
                                <input type="text" class="form-control" name="title" 
                                    value="<?php echo htmlspecialchars($item['title']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori:</label>
                                <select class="form-select" name="category" required>
                                    <option value="Kegiatan Sekolah" <?php echo $item['category'] == 'Kegiatan Sekolah' ? 'selected' : ''; ?>>
                                        Kegiatan Sekolah
                                    </option>
                                    <option value="Prestasi" <?php echo $item['category'] == 'Prestasi' ? 'selected' : ''; ?>>
                                        Prestasi
                                    </option>
                                    <option value="Ekstrakurikuler" <?php echo $item['category'] == 'Ekstrakurikuler' ? 'selected' : ''; ?>>
                                        Ekstrakurikuler
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="instagram_embed" class="form-label">URL Embed Instagram:</label>
                                <input type="text" class="form-control" name="instagram_embed"
                                    value="<?php echo htmlspecialchars($item['instagram_embed']); ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>