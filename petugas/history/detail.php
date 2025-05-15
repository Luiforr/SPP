<?php
include 'aksi.php';
include '../../componen/petugas.php';


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
    <title>Admin Edit</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto my-5 p-5 bg-white rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">Detail</h1>
        <h1>ID Pembayaran</h1>
        <h1><?= htmlspecialchars($laporan['id_pembayaran']); ?></h1>
        <h1>Nama Petugas</h1>
        <h1><?= htmlspecialchars($laporan['nama_petugas']); ?></h1>
        <h1>NISN</h1>
        <h1><?= htmlspecialchars($laporan['nisn']); ?></h1>
        <h1>NIS</h1>
        <h1><?= htmlspecialchars($laporan['nis']); ?></h1>
        <h1>Tanggal Bayar</h1>
        <h1><?= htmlspecialchars($laporan['tgl_bayar']); ?></h1>
        <h1>Bulan Dibayar</h1>
        <h1><?= htmlspecialchars($laporan['bulan_dibayar']); ?></h1>
        <h1>Tahun Dibayar</h1>
        <h1><?= htmlspecialchars($laporan['tahun_dibayar']); ?></h1>
        <h1>ID SPP</h1>
        <h1><?= htmlspecialchars($laporan['id_spp']); ?></h1>
        <h1>Jumlah Bayar</h1>
        <h1><?= htmlspecialchars($laporan['jumlah_bayar']); ?></h1>
        <h1>Status</h1>
        <h1><?= htmlspecialchars($laporan['status']); ?></h1>
        <td class="px-4 py-2">
            <a href="edit.php?id=<?= $laporan['id_pembayaran']; ?>" class="text-[#00FF33] font-medium hover:underline">Edit</a>
            <a href="index.php?delete=<?= $laporan['id_pembayaran']; ?>"
                onclick="return confirm('Yakin ingin menghapus data ini?')"
                class="text-[#FF0000] font-medium hover:underline">Delete</a>
        </td>

    </div>
</body>

</html>