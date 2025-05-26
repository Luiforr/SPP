<?php
include "laporan_aksi.php";
session_start();
$username = $_SESSION['username'];

if (isset($_GET['delete'])) {
    deletePembayaran($_GET['delete']);
    header("Location: siswa.php?success=delete");
    exit;
}

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$tahun = null;
$bulanAngka = null;
$pembayaran = getPembayaranByTanggal($bulan, $limit, $offset);
$totalData = countPagePembayaran($bulan);
$totalPages = ceil($totalData / $limit);
$totalSelesai = sumPembayaranSelesai($bulan);
$totalBelum = sumPembayaranBelum($bulan);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <?php
    include '../../componen/navbar.php';
    ?>
    <h1 class="text-3xl font-bold mb-5 text-center mt-5">Laporan Pembayaran</h1>
    <section class="flex justify-center">
        <div class="grid grid-cols-2 gap-10 mx-auto">
            <div class="flex flex-col justify-center items-center rounded-md font-semibold">
                <p class="text-green-400">
                  
                    <?php
                  echo number_format($totalSelesai, 0, ',', '.');
                    ?></p>
                </p>
                <p>Jumlah Pembayaran Selesai</p>
            </div>
            <div class=" flex flex-col justify-center items-center rounded-md py-4 px-10  font-semibold">
            <p class="text-red-400">   
                <?php
               echo number_format($totalBelum, 0, ',', '.');
                ?></p>
                </p>
                <p>Jumlah Pembayaran Belum </p>
            </div>
    </section>
    <div class="container mx-auto  my-1 p-5 rounded ">

        <form method="GET" action="">
            <div class="flex justify-between">
                <div class="">
                    <label for="tanggal">Cari Pembayaran :</label>
                    <div class="flex"> 
                        <input type="month" class="w-full px-2 py-1 rounded-md border" name="bulan" id="bulan" value="<?php echo isset($_GET['bulan']) ? $_GET['bulan'] : ''; ?>" >
                        <button type="submit" name="" class="ml-2 px-4 text-sm bg-[#2D5074] text-white rounded cursor-pointer hover:bg-gray-500">Filter</button>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="generate.php?bulan=<?= urlencode($bulan) ?>&page=<?= $page ?>" 
                    target="_blank"
                    class="bg-[#2D5074] text-white px-4 py-2 rounded hover:bg-gray-500">
                    Cetak
                </a>
            </div>
        </div>
        </form>

        <div class="text-center">
            <?php if (empty($pembayaran)): ?>
                <p class="text-center mt-5 font-semibold">Anda belum mempunyai transaksi apapun</p>
            <?php else: ?>
        </div>
        <form action="" method="POST" class=" flex text-center">
            <table class="min-w-full table-auto border-collapse mt-5 shadow-md bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">NO</th>
                        <th class="px-4 py-2">NIS</th>
                        <th class="px-4 py-2">Nama Siswa</th>
                        <th class="px-4 py-2">Tanggal Bayar</th>
                        <th class="px-4 py-2">Jumlah Bayar</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="POST">
                        <?php
                        if ($pembayaran) {
                            $no = ($page - 1 )* $limit + 1;
                            foreach ($pembayaran as $laporan): ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2"><?= $no++ ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['nis']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['nama']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($laporan['tgl_bayar']); ?></td>
                                    <td class="px-4 py-2">RP <?php echo number_format($laporan['jumlah_bayar'], 0, ',', '.');?></td>
                                    <td class="px-4 py-2 font-semibold"> <?php if ($laporan['status'] === 'selesai'): ?>
                                            <span
                                                class="text-green-600 font-semibold cursor-pointer"
                                                onclick="toggleSelect('<?= $laporan['id_pembayaran'] ?>')">
                                                Selesai
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="text-red-600 font-semibold cursor-pointer"
                                                onclick="toggleSelect('<?= $laporan['id_pembayaran'] ?>')">
                                                Belum
                                            </span>
                                        <?php endif; ?>
                                    </td>
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
        <div class=" flex justify-center space-x-2 mb-4">
            <?php
            if ($page > 1): ?>
                <a href="?bulan=<?= urlencode($bulan) ?>&page=<?= $page - 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400"><</a>
            <?php endif; ?>
    
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?bulan=<?= urlencode($bulan) ?>&page=<?= $i ?>"
                    class="px-3 py-1 rounded <?= $i == $page ? 'bg-[#2D5074] text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
    
            <?php if ($page < $totalPages): ?>
                <a href="?bulan=<?= urlencode($bulan) ?>&page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">></a>
            <?php endif; ?>
        </div>
</body>
<?php include "../../componen/footer.php"  ?>
</html>