<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $koneksi->query("DELETE FROM pesanan WHERE id=$id");
}

header("Location: index.php");
exit();
?>
