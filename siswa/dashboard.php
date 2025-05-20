<?php
include "aksi.php";
session_start();

$nis = $_SESSION['nis'];
$siswaData = getIdSiswaByNIS($nis);
$nisn = $siswaData['nisn'];

$laporanData = getAllData($nisn);



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
    include '../componen/navsis.php';
    ?>
    <h1 class="text-2xl font-medium py-3 px-7">WELKAM ADMIN DASHBOARD</h1>
    <h2 class="text-md font-medium text-cyan-700 px-15">Anda login sebagai Admin</h2>
    <div class="container mx-auto  my-5 p-5 bg-white rounded shadow-md text-center">
        <div class="flex justify-between mb-4 ">
            <h1 class="text-3xl font-bold mb-5">Data siswa</h1>
            <h1><?= htmlspecialchars($siswaData['nama']); ?></h1>
            <h1><?= htmlspecialchars($siswaData['nama_kelas']); ?></h1>

        </div>
        <form action="" method="POST" class="mb-5 flex">
            <?php if (empty($laporanData)): ?>
                <p>Tidak ada data siswa ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Id</th>
                            <th class="px-4 py-2">Petugas</th>
                            <th class="px-4 py-2">Nisn</th>
                            <th class="px-4 py-2">Tanggal Bayar</th>
                            <th class="px-4 py-2">Bulan</th>
                            <th class="px-4 py-2">Tahun</th>
                            <th class="px-4 py-2">SPP</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2">Status</th>


                        </tr>
                    </thead>
                    <tbody>
                        <form action="aksi_logout.php" method="POST">

                            <?php foreach ($laporanData as $laporan): ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['id_pembayaran']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['nama_petugas']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['nisn']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['tgl_bayar']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['bulan_dibayar']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['tahun_dibayar']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['tahun']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['jumlah_bayar']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['status']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </form>
                    </tbody>
                </table>
            <?php endif; ?>
    </div>
</body>

</html>