<?php include "koneksi.php" ; 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM info_penting WHERE id = $id");
    header("Location: konten_info_penting.php");
    exit;
}
?>



