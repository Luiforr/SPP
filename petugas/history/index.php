<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    
</body>
</html>

<?php
include "aksi.php";
session_start();

$username = $_SESSION['username'];

if (isset($_GET['delete'])) {
    deletePembayaran($_GET['delete']);
    header("Location: siswa.php?success=delete");
    exit;
}
$laporanData = getAllData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Siswa</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <?php
    include '../../componen/navgas.php';
    ?>
    
    <section class="flex justify-center mt-4">
    <div class="grid grid-cols-4 gap-10 mx-auto">
        <div class=" text-black flex flex-col justify-center items-center rounded-md  py-6 px-10   font-bold">
            <p>1</p>
            <p>siswa</p>
        </div>
        <div class=" text-black flex flex-col justify-center items-center rounded-md py-6 px-10  font-bold">
            <p>1</p>
            <p>petugas</p>
        </div>
        <div class=" text-black flex flex-col justify-center items-center rounded-md  py-6 px-10  font-bold">
            <p>1</p>
            <p>pembayaran bulan ini</p>
        </div>
        <div class=" text-black flex flex-col justify-center items-center rounded-md py-6 px-10   font-bold">
            <p>1</p>
            <p>Kelas </p>
        </div>
    </div>
</section>
    <div class="container mx-auto  my-5 p-5 bg-white rounded shadow-md text-center">
        <div class="flex justify-between mb-4 ">
            <h1 class="text-3xl font-bold mb-5">Data Laporan SPP</h1>
            <a href="/php-front/petugas/transaksi/index.php" type="button" class="mb-5 bg-green-600 rounded-md text-white px-4 py-2 hover:bg-green-300">Entry Transaksi</a>
        </div>
        <form action="" method="POST" class="mb-5 flex">
            <?php if (empty($laporanData)): ?>
                <p>Tidak ada data siswa ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">NIS</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Tanggal Bayar</th>
                            <th class="px-4 py-2">Nominal</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="aksi_logout.php" method="POST">

                            <?php foreach ($laporanData as $laporan): ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['nis']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['nama']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['tgl_bayar']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['jumlah_bayar']); ?></td>
                                    <td class="px-4 py-2">
                                <a href="detail.php?id_pembayaran=<?= $laporan['id_pembayaran']; ?>" class="text-[#00FF33] font-medium hover:underline">Detail</a>
                            </td>
                            <?php endforeach; ?>
                        </form>
                    </tbody>
                </table>
            <?php endif; ?>
    </div>
</body>

</html>