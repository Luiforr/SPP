<?php
include "laporan_aksi.php";
session_start();

$username = $_SESSION['username'];
$dataPetugas = getDataPetugasByUsername($username);
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$pembayaran = getGenerateByTanggal($bulan);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Generate Laporan</title>
    <link href="../output.css" rel="stylesheet">
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body onload="window.print()" class="bg-gray-100">
    <h1 class="text-2xl font-bold text-center mt-5">Laporan Pembayaran</h1>
    <h1 class="text-md font-semibold mt-5">Petugas :<?php echo " ".$dataPetugas['nama_petugas']; ?></h1>
    <section class="flex justify-center mt-4">
    <div class="grid grid-cols-2 gap-10 mx-auto">
            <div class="flex flex-col justify-center items-center rounded-md font-semibold">
                <p class="text-green-400">
                  
                    <?php
                  echo number_format(sumPembayaranSelesai($bulan), 0, ',', '.');
                    ?></p>
                </p>
                <p>Jumlah Pembayaran Selesai</p>
            </div>
            <div class=" flex flex-col justify-center items-center rounded-md py-4 px-10  font-semibold">
            <p class="text-red-400">   
                <?php
               echo number_format(sumPembayaranBelum($bulan), 0, ',', '.');
                ?></p>
                </p>
                <p>Jumlah Pembayaran Belum </p>
            </div>
    </section>
    <form action="" method="POST" class=" flex text-center">
        <table class="min-w-full p-10 mx-auto table-auto border-collapse mt-5 shadow-md bg-white border-y ">
            <thead>
                <tr class="bg-gray-200 ">
                    <th class="px-4 py-2 border-x">NO</th>
                    <th class="px-4 py-2 border-x">NIS</th>
                    <th class="px-4 py-2 border-x">Nama Siswa</th>
                    <th class="px-4 py-2 border-x">Tanggal Bayar</th>
                    <th class="px-4 py-2 border-x">Jumlah Bayar</th>
                    <th class="px-4 py-2 border-x">Status</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="POST">
                    <?php
                    if ($pembayaran) {
                        $no = 1;
                        foreach ($pembayaran as $laporan): ?>
                            <tr class="border-t">
                                <td class="px-4 py-2 border-x"><?= $no++ ?></td>
                                <td class="px-4 py-2 border-x"><?= htmlspecialchars($laporan['nis']); ?></td>
                                <td class="px-4 py-2 border-x"><?= htmlspecialchars($laporan['nama']); ?></td>
                                <td class="px-4 py-2 border-x"><?= htmlspecialchars($laporan['tgl_bayar']); ?></td>
                                <td class="px-4 py-2 border-x">RP <?php echo number_format($laporan['jumlah_bayar'], 0, ',', '.'); ?></td>
                                <td class="px-4 py-2 border-x font-semibold"> <?php if ($laporan['status'] === 'selesai'): ?>
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
                    ?>
                </form>
            </tbody>
        </table>
    </form>
</body>

</html>