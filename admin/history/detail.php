<?php
include 'aksi.php';
session_start();

if (!isset($_GET['id_pembayaran'])) {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id_pembayaran'];
$laporan = getTransaksiById($id);

if (!$laporan) {
    echo "Data kelas tidak ditemukan.";
    exit;
}

// if (isset($_POST['update'])) {
    //     updateKelas($_POST['id_kelas'], $_POST['nama_kelas'], $_POST['kompetensi_keahlian']);
    //     header('Location: ../index.php?success=update');
    //     exit;
    // }
    
    if (isset($_GET['delete'])) {
        deletePembayaran($_GET['delete']);
        header("Location: ../php-front/admin/kelas/index.php?success=delete");
        exit;
    }
    ?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Pembayaran</title>
        <link href="../output.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    
    <body>
     <?php  include '../../componen/navbar.php'; ?>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-xl rounded-xl border border-gray-200">
        <h2 class="text-3xl font-bold text-[#2D5074] mb-6 text-center border-b pb-2">Detail Pembayaran</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
            <div>
                <p class="font-medium text-gray-500">ID Pembayaran</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['id_pembayaran']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Nama Petugas</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['nama_petugas']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">NISN</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['nisn']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">NIS</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['nis']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Tanggal Bayar</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['tgl_bayar']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Bulan Dibayar</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['bulan_dibayar']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Tahun Dibayar</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['tahun_dibayar']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">ID SPP</p>
                <p class="text-lg"><?= htmlspecialchars($laporan['id_spp']); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Jumlah Bayar</p>
                <p class="text-lg font-semibold text-[#2D5074]">Rp <?= number_format($laporan['jumlah_bayar'], 0, ',', '.'); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-500">Status</p>
                <span class="inline-block text-sm px-3 py-1 rounded-full font-semibold 
            <?= $laporan['status'] === 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                    <?= htmlspecialchars($laporan['status']); ?>
                </span>
            </div>
        </div>
        <div class="mt-10 flex flex-col sm:flex-row justify-between items-center gap-4">
            <a href="index.php"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition shadow-sm">
                ← Kembali
            </a>
            <div class="flex gap-2">
                <a href="edit.php?id=<?= $laporan['id_pembayaran']; ?>"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition shadow-sm">
                     Edit
                </a>
                <a href="index.php?delete=<?= $laporan['id_pembayaran']; ?>"
                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition shadow-sm">
                     Hapus
                </a>
            </div>
        </div>
    </div>

</body>

</html>