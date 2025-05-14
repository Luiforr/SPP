<?php
session_start();
$id_petugas = $_SESSION['id_petugas'];
$username = $_SESSION['username'];  
include "aksi.php";
// $_GET['id_petugas'];
if (isset($_POST['create'])) {
    createLaporan( $_POST['nisn'], $_POST['tanggal_bayar'],  $_POST['jumlah_bayar'], $_POST['status']);
    header("Location: petugas.php?success=create");
    exit;
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pilih Siswa</title>
</head>
<body>
    <h2>Pilih Siswa untuk Buat Laporan Pembayaran
    <?= htmlspecialchars($username) ?>
    <?= htmlspecialchars($id_petugas) ?></h2>
    <form action="" method="post">
        <label for="nisn">Pilih Siswa:</label>
        <select name="nisn" id="nisn" required>
            <option value="">-- Pilih Siswa --</option>
            <?php foreach ($siswaList as $siswa): ?>
                <option value="<?= htmlspecialchars($siswa['nisn']) ?>">
                    <?= htmlspecialchars($siswa['nama']) ?> (<?= $siswa['nisn'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="tanggal_bayar">Tanggal Bayar:</label>
        <input type="date" name="tanggal_bayar" id="tanggal_bayar" required>
        <br><br>

        <label for="jumlah_bayar">Jumlah Bayar:</label>
        <input type="number" name="jumlah_bayar" id="jumlah_bayar" required>
        <br><br>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="selesai">Selesai</option>
            <option value="belum">Belum</option>
        </select>
        <br><br>

        <button type="submit" name="create">Buat Laporan</button>
    </form>
</body>
</html>
