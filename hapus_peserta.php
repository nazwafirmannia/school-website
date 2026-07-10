<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM data_peserta WHERE id='$id'");

if ($query) {
    header("Location: data_siswa.php");
} else {
    echo "Gagal menghapus data.";
}
?>
