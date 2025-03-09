<?php
$koneksi = new mysqli("127.0.0.1:3307", "root", "", "db_pesanan");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
