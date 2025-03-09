<?php
include 'koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID tidak valid!'); window.location='index.php';</script>";
    exit();
}

$id = intval($_GET['id']);

$stmt = $koneksi->prepare("SELECT * FROM pesanan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $pesanan = $result->fetch_assoc();
} else {
    echo "<script>alert('Pesanan tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
    $nama_menu = htmlspecialchars($_POST['nama_menu']);
    $jumlah = intval($_POST['jumlah']);
    $total_harga = intval($_POST['total_harga']);

    $stmt = $koneksi->prepare("UPDATE pesanan SET nama_pelanggan = ?, nama_menu = ?, jumlah = ?, total_harga = ? WHERE id = ?");
    $stmt->bind_param("ssiii", $nama_pelanggan, $nama_menu, $jumlah, $total_harga, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pesanan berhasil diperbarui!'); window.location='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal mengupdate pesanan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Edit Pesanan</h2>
    <div class="card shadow p-4">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" value="<?= htmlspecialchars($pesanan['nama_pelanggan']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" value="<?= htmlspecialchars($pesanan['nama_menu']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="<?= $pesanan['jumlah'] ?>" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <input type="text" name="total_harga" class="form-control" value="<?= $pesanan['total_harga'] ?>" min="0" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
