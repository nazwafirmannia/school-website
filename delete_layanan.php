<?php include "koneksi.php" ; 
// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hapus layanan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM services WHERE id = $id");
    header("Location: konten_home_layanan.php");
}
?>