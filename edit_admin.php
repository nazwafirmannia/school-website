<?php include "koneksi.php" ; 
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data admin berdasarkan ID
if (isset($_GET['id'])) {
    $id_admin = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM admin WHERE id_admin = ?");
    $stmt->bind_param("i", $id_admin);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();

    if (!$admin) {
        die("Admin tidak ditemukan.");
    }
}

// Update data admin
if (isset($_POST['update_admin'])) {
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $password = $_POST['password'];

    // Jika password baru diisi, hash password tersebut
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE admin SET username = ?, email = ?, nama = ?, no_telp = ?, password = ? WHERE id_admin = ?");
        $stmt->bind_param("sssssi", $username, $email, $nama, $no_telp, $hashed_password, $id_admin);
    } else {
        $stmt = $conn->prepare("UPDATE admin SET username = ?, email = ?, nama = ?, no_telp = ? WHERE id_admin = ?");
        $stmt->bind_param("ssssi", $username, $email, $nama, $no_telp, $id_admin);
    }

    // Eksekusi query
if ($stmt->execute()) {
    $stmt->close();
    // Redirect dengan status sukses
    header("Location: admin_menejemen.php?status=success");
    exit();
} else {
    echo "Error: " . $stmt->error;
    $stmt->close();
}

    // Eksekusi query
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Admin</h1>

        <!-- Notifikasi jika data berhasil diupdate -->
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data admin berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id_admin" value="<?= $admin['id_admin'] ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $admin['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (Opsional)</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">Show</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $admin['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $admin['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?= $admin['no_telp'] ?>" required>
                    </div>
                    <button type="submit" name="update_admin" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="admin_menejemen.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');

    togglePasswordButton.addEventListener('click', () => {
        // Toggle attribute 'type'
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Ubah teks tombol
        togglePasswordButton.textContent = type === 'password' ? 'Show' : 'Hide';
    });
</script>

