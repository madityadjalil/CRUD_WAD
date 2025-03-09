<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
    $nama_menu = htmlspecialchars($_POST['nama_menu']);
    $jumlah = intval($_POST['jumlah']);
    $total_harga = intval($_POST['total_harga']);

    $stmt = $koneksi->prepare("INSERT INTO pesanan (nama_pelanggan, nama_menu, jumlah, total_harga) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nama_pelanggan, $nama_menu, $jumlah, $total_harga);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan pesanan!');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<body class="bg-light">

<div class="container mt-5 pt-4">
    <h2 class="text-center mb-4">Tambah Pesanan</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Harga (Rp)</label>
                        <input type="text" name="total_harga" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
