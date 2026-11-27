<?php
require 'koneksi.php';

$sql = 'SELECT p.id_pelanggan, p.nama_pelanggan, p.alamat, p.no_handphone, j.jenis
        FROM pelanggan AS p
        INNER JOIN jenis_pelanggan AS j ON j.id_jenis = p.id_jenis
        ORDER BY p.id_pelanggan';
$hasil = mysqli_query($koneksi, $sql);
?>

<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <title>Daftar Pelanggan</title>
    </head>
    <body>
        <h1>Daftar Pelanggan</h1>
        <p><a href="index.php">Daftar produk</a></p>
        <p><a href="tambah_pelanggan.php">Tambah pelanggan</a></p>
        <table>
            <tr>
                <th>Nama pelanggan</th>
                <th>Jenis pelanggan</th>
                <th>Alamat</th>
                <th>No. handphone</th>
                <th>Aksi</th>
            </tr>
            <?php while ($baris = mysqli_fetch_assoc($hasil)): ?>
            <tr>
                <td><?= e($baris['nama_pelanggan']) ?></td>
                <td><?= e($baris['jenis']) ?></td>
                <td><?= e($baris['alamat'] ?? '-') ?></td>
                <td><?= e($baris['no_handphone'] ?? '-') ?></td>
                <td>
                    <a href="edit_pelanggan.php?id=<?= e($baris['id_pelanggan']) ?>">Edit</a>
                    <form method="post" action="hapus_pelanggan.php" style="display: inline;">
                        <input type="hidden" name="id" value="<?= e($baris['id_pelanggan']) ?>">
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php if (mysqli_num_rows($hasil) === 0): ?><p>Belum ada pelanggan.</p><?php endif; ?>
    </body>
</html>
