<?php
include "aksi.php";
session_start();

$nis = $_SESSION['nis'];
$siswaData = getIdSiswaByNIS($nis);
$nisn = $siswaData['nisn'];

$laporanData = getAllData($nisn);
$hasil = getTotalPembayaranByStatus($nisn);


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
 <section class="flex justify-center mt-4">
        <div class="grid grid-cols-2 gap-10 mx-auto">
            <div class=" text-black flex flex-col justify-center items-center rounded-md  py-6 px-10   font-bold">
                <?php
                 echo number_format($hasil['total_selesai'], 0, ',', '.')
                ?></p>
                </p>
                <p>Total Pembayaran Selesai</p>
            </div>
            <div class=" text-black flex flex-col justify-center items-center rounded-md py-6 px-10  font-bold">
                <?php
                echo  number_format($hasil['total_belum'], 0, ',', '.')
                ?></p>
                </p>
                <p>Total Pembayaran Belum Selesai</p>
            </div>
        </div>
    </section>
    <div class="container mx-auto  my-5 p-5 bg-white rounded shadow-md ">
        <div class="flex justify-between mb-4 ">
            <div>
            <h1 class="text-3xl font-bold mb-5">Data siswa</h1>
            </div>
            <div class="flex gap-2"> 
                <h1 ><?= htmlspecialchars($siswaData['nama']); ?></h1>
                <h1 class="font-semibold"><?= htmlspecialchars($siswaData['nama_kelas']); ?></h1>
            </div>
        </div>
        <form action="" method="POST" class="mb-5 flex text-center">
            <?php if (empty($laporanData)): ?>
                <p>Anda belum mempunyai transaksi apapun</p>
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
                        <form action="" method="POST">

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
                                    <td class="px-4 py-2"><?php
                                    if($laporan['status'] == 'selesai'){?>
                                        <p class="text-green-500"> <?= htmlspecialchars($laporan['status']); ?></p>
                                        <?php }else{?>
                                        <p  class="text-red-500"><?= htmlspecialchars($laporan['status']); ?> </p><?php
                                    }?></td>
                                </tr>
                            <?php endforeach; ?>
                        </form>
                    </tbody>
                </table>
            <?php endif; ?>
    </div>
</body>

</html>