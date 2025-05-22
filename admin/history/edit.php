<?php
include 'aksi.php';
session_start();

$id_petugas = $_SESSION['id_petugas'];
$username = $_SESSION['username'];
if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];
$laporan = getTransaksiById($id);

if (!$laporan) {
    echo "Data kelas tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    updateTransaksi($_POST['id_pembayaran'], $_POST['nisn'], $_POST['tgl_bayar'], $_POST['jumlah_bayar'], $_POST['status'] );
    header('Location: ../index.php?success=update');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>


<body class="bg-gray-100">
<?php include '../../componen/navbar.php'; ?>
<div class="flex justify-center items-center min-h-screen">
        <form method="POST" action="" class="bg-white shadow-xl p-6 rounded-xl w-full max-w-md space-y-4">
            <h2 class="text-2xl font-bold text-center">Entry Transaksi</h2>
            <input type="hidden" name="id_pembayaran" value="<?= $laporan['id_pembayaran']; ?>">
            <div>
                <label for="nisn" class="block font-semibold">Pilih Siswa:</label>
                <select name="nisn" id="nisn"  class="w-full border px-2 py-1 rounded-md">
                    <option value="<?= $laporan['nisn']; ?>"><?= htmlspecialchars($laporan['nama']) ?> (<?= $laporan['nisn'] ?>)</option>
                    <?php foreach ($siswaList as $siswa): ?>
                        <option value="<?= htmlspecialchars($siswa['nisn']) ?>">
                            <?= htmlspecialchars($siswa['nama']) ?> (<?= $siswa['nisn'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="tgl_bayar" class="block font-semibold">Tanggal Bayar:</label>
                <input type="date" class="w-full border px-2 py-1 rounded-md" name="tgl_bayar" id="tgl_bayar" value="<?= $laporan['tgl_bayar']; ?>" >
            </div>
            <div>
                <label for="jumlah_bayar" class="block font-semibold">Jumlah Bayar:</label>
                <input type="number" value="<?= $laporan['jumlah_bayar']; ?>" class="w-full border px-2 py-1 rounded-md" name="jumlah_bayar" id="jumlah_bayar">

            </div>
            <div>
                <label for="status" class="block font-semibold">Status: </label>
                <select name="status" class="w-full border px-2 py-1 rounded-md" id="status" >
                <option value="<?= $laporan['status']; ?> "><?= $laporan['status']; ?> 
                    <option value="selesai">Selesai</option>
                    <option value="belum">Belum</option>
                </option>
                </select>
            </div>
            <div class="flex justify-end gap-4">
                <a href="detail.php?id_pembayaran=<?= $laporan['id_pembayaran']; ?>" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-400">Kembali</a>
                <button type="submit" name="update" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-400">Simpan</button>
            </div>
        </form>
</body>

</html>