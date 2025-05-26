<?php
session_start();
$id_petugas = $_SESSION['id_petugas'];
$username = $_SESSION['username'];
include "aksi.php";
// $_GET['id_petugas'];
if (isset($_POST['create'])) {
    createLaporan($_POST['nisn'], $_POST['tanggal_bayar'],  $_POST['jumlah_bayar'], $_POST['status']);
    header("Location: dashboard.php?success=create");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Entry Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <?php
    include "../../componen/navbar.php"
    ?>
    <div class="flex justify-center items-center min-h-screen">
        <form method="POST" action="" class="bg-white shadow-xl p-6 rounded-xl w-full max-w-md space-y-4">
            <h2 class="text-2xl font-bold text-center">Entry Transaksi</h2>
            <div>
                <label for="nisn" class="block font-semibold">Pilih Siswa:</label>
                <select name="nisn" id="nisn" required class="w-full border px-2 py-1 rounded-md">
                    <option value="">-- Pilih Siswa --</option>
                    <?php foreach ($siswaList as $siswa): ?>
                        <option value="<?= htmlspecialchars($siswa['nisn']) ?>">
                            <?= htmlspecialchars($siswa['nama']) ?> (<?= $siswa['nisn'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="tanggal_bayar" class="block font-semibold">Tanggal Bayar:</label>
                <input type="date" class="w-full border px-2 py-1 rounded-md" name="tanggal_bayar" id="tanggal_bayar" required>
            </div>
            <div>
                <label for="jumlah_bayar" class="block font-semibold">Jumlah Bayar:</label>
                <input type="number" class="w-full border px-2 py-1 rounded-md" name="jumlah_bayar" id="jumlah_bayar" required>

            </div>
            <div>
                <label for="status" class="block font-semibold">Status:</label>
                <select name="status" class="w-full border px-2 py-1 rounded-md" id="status" required>
                    <option value="selesai">Selesai</option>
                    <option value="belum">Belum</option>
                </select>
            </div>
            <div class="flex justify-end gap-4">
                <a href="../dashboard.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-400">Kembali</a>
                <button type="submit" name="create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-400">Simpan</button>
            </div>
        </form>
    </body>
    </html>
