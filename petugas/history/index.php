<?php
include "aksi.php";
session_start();

$username = $_SESSION['username'];

if (isset($_GET['delete'])) {
    deletePembayaran($_GET['delete']);
    header("Location: siswa.php?success=delete");
    exit;
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$laporanData = getAllData($search, $limit, $offset);
$totalData = countAllData($search);
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
    include '../../componen/navgas.php';
    ?>


    <div class="container mx-auto  my-5 p-5 text-center">
        <div class="flex justify-between  ">
            <h1 class="text-3xl font-bold mb-5">History Pembayaran</h1>
        </div>
        <form method="GET" action="" class="mb-4 flex gap-2">
            <input type="text" name="search" placeholder="Cari NIS atau Nama" value="<?= htmlspecialchars($search) ?>" class="px-3 py-1 border rounded w-full">
            <button type="submit" class="bg-[#2D5074] cursor-pointer text-white px-4 py-1 rounded w-38">Cari</button>
        </form>
        <form action="" method="POST" class="mb-5 flex">
            <?php if (empty($laporanData)): ?>
                <p>Tidak ada data Pembayaran ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse  bg-white rounded shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">NIS</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Tanggal Bayar</th>
                            <th class="px-4 py-2">Nominal</th>
                            <th class="px-4 py-2">Status</th>
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
                                    <td class="px-4 py-2"><?php echo number_format($laporan['jumlah_bayar'], 0, ',', '.');?></td>
                                    <td class="px-4 py-2"><?php
                                                            if ($laporan['status'] == 'selesai') { ?>
                                            <p class="text-green-500"> <?= htmlspecialchars($laporan['status']); ?></p>
                                        <?php } else { ?>
                                            <p class="text-red-500"><?= htmlspecialchars($laporan['status']); ?> </p><?php
                                                                                                                    } ?>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="detail.php?id_pembayaran=<?= $laporan['id_pembayaran']; ?>" class="text-[#00FF33] font-medium hover:underline">Detail</a>
                                    </td>
                                <?php endforeach; ?>
                        </form>
                    </tbody>
                </table>
            <?php endif; ?>
    </div>
    <div class="mt-5 flex justify-center space-x-2">
        <?php if ($page > 1): ?>
            <a href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400"><</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" class="px-3 py-1 rounded <?= $i == $page ? 'bg-[#2D5074] text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">></a>
        <?php endif; ?>
    </div>

</body>

</html>