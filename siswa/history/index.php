<?php
include "../aksi.php";
session_start();

$nis = $_SESSION['nis'];
$siswaData = getIdSiswaByNIS($nis);
$nisn = $siswaData['nisn'];
$laporanData = getAllData($nisn);

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$pembayaran = getPembayaranSiswa($nisn, $bulan, $limit, $offset);
$totalData = countPembayaranSiswa($nisn, $bulan);
$totalPages = ceil($totalData / $limit);



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
    include '../../componen/navsis.php';
    ?>
    <h1 class="text-3xl font-bold mb-5 text-center">History Pembayaran</h1>
    <div class="container mx-auto  my-5 p-5 bg-white rounded shadow-md ">
        <?php
        if ($bulan) {
        } else {?>
            <h4 class="text-center text-md font-semibold">Semua Riwayat Pembayaran</h4>
        <?php
        }
        ?>
        <form method="GET" action="">
            <label for="tanggal">Cari History :</label>
            <div class="flex">
                <input type="month" class="w-full px-2 py-1 rounded-md border" name="bulan" id="bulan" value="<?php echo isset($_GET['bulan']) ? $_GET['bulan'] : ''; ?>" required>
                <button type="submit" name="" class="ml-2 px-4 text-sm bg-[#2D5074] text-white rounded ">Filter</button>
            </div>
        </form>

        <div class="text-center">
            <?php if (empty($pembayaran)): ?>
                <p class="text-center mt-5 font-semibold">Anda belum mempunyai transaksi apapun</p>
            <?php else: ?>
        </div>
        <form action="" method="POST" class="mb-5 flex text-center">
            <table class="min-w-full table-auto border-collapse mt-5">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">NO</th>
                        <th class="px-4 py-2">Tanggal Bayar</th>
                        <th class="px-4 py-2">Jumlah Bayar</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="POST">
                        <?php
                        if ($pembayaran) {
                            $no = 1;
                            foreach ($pembayaran as $laporan): ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2"><?= $no++ ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['tgl_bayar']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['jumlah_bayar']); ?></td>
                                    <td class="px-4 py-2"><?php
                                    if($laporan['status'] == 'selesai'){?>
                                        <p class="text-green-500"> <?= htmlspecialchars($laporan['status']); ?></p>
                                        <?php }else{?>
                                        <p  class="text-red-500"><?= htmlspecialchars($laporan['status']); ?> </p><?php
                                    }?></td>
                                </tr>
                    <?php endforeach;
                        }
                    endif
                    ?>
                    </form>
                </tbody>
            </table>
        </form>
    </div>
    <div class="mt-5 flex justify-center space-x-2">
            <?php
            if ($page > 1): ?>
                <a href="?bulan=<?= urlencode($bulan) ?>&page=<?= $page - 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400"><</a>
            <?php endif; ?>
    
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?bulan=<?= urlencode($bulan) ?>&page=<?= $i ?>"
                    class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
    
            <?php if ($page < $totalPages): ?>
                <a href="?bulan=<?= urlencode($bulan) ?>&page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">></a>
            <?php endif; ?>
        </div>
</body>

</html>