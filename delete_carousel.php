<?php include "koneksi.php" ; 
$id = $_GET['id'];
$conn->query("DELETE FROM carousel WHERE id = $id");
header("Location: admin_home.php");
?>
