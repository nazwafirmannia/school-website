<?php include "koneksi.php" ; 
// Koneksi ke database

// Debug parameter 'id'
if (isset($_GET['id'])) {
    echo "ID ditemukan: " . $_GET['id'];
} else {
    echo "Parameter 'id' tidak ditemukan.";
    exit;
}

// Pastikan 'id' adalah angka
if (!is_numeric($_GET['id'])) {
    echo "Parameter 'id' tidak valid.";
    exit;
}

$id = $_GET['id'];

// Hapus data berdasarkan ID
$query = "DELETE FROM guru WHERE id = $id";
if ($conn->query($query) === TRUE) {
    header("Location: konten_guru.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
?>
