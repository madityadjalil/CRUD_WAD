<?php
include 'koneksi.php';


$result = $koneksi->query("SELECT * FROM pesanan ORDER BY tanggal_pesanan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container mt-5 pt-4">
    <h2 class="text-center mb-4">KEDAI BERKAH</h2>

    <div class="text-center mb-4">
        <img src="img/menu.jpeg" alt="Menu Utama" class="menu-img">
    </div>


    <div class="text-center mb-3">
        <a href="tambah.php" class="btn btn-success">Tambah Pesanan</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Menu</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                        <td><?= htmlspecialchars($row['nama_menu']) ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td>Rp<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                        <td><?= $row['tanggal_pesanan'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7">Belum ada pesanan.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
