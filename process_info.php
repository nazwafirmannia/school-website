<?php include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul_section = $_POST['judul_section'];
    $judul_info = $_POST['judul_info'];
    $deskripsi = $_POST['deskripsi'];
    $icon_class = $_POST['icon_class'];
    $warna_icon = $_POST['warna_icon'];

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target = "uploads/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO info_penting (judul_section, judul_info, deskripsi, icon_class, warna_icon, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $judul_section, $judul_info, $deskripsi, $icon_class, $warna_icon, $gambar);
    $stmt->execute();

    header("Location: admin_home.php");
}
?>
