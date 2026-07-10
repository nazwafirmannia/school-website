<?php include "koneksi.php" ; 
$id = $_GET['id'];
$conn->query("DELETE FROM gallery WHERE id = $id");
header("Location: admin_galeri.php");
?>
