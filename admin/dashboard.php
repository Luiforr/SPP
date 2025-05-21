<?php
include "aksi.php";

session_start();


$username = $_SESSION['username'];

if (isset($_GET['deleteKelas'])) {
    deleteKelas($_GET['deleteKelas']);
    exit;
}
if (isset($_GET['deleteSpp'])) {
    deleteSPP($_GET['deleteSpp']);
    exit;
}
if (isset($_GET['deletePetugas'])) {
    deletePetugas($_GET['deletePetugas']);
    exit;
}
if (isset($_GET['deleteSiswa'])) {
    deleteSiswa($_GET['deleteSiswa']);
    exit;
}

$kelasData = getAllDataKelas();
$siswaData = getAllDataSiswa();
$sppData = getAllDataSpp();
$petugasData = getAllDataPetugas();
$pembayaranData = getAllDataPembayaran();
$totalBayarBulanIni = sumPembayaranBulanIni();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Kelas</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <?php
    include '../componen/navbar.php';
    ?>
    <div class=" w-full py-5  mt-10 h-18">
        <h2 class=" text-center font-medium text-black text-xl ">Selamat admin <?= htmlspecialchars($username) ?> di page Dashboard
        </h2>
    </div>
    <section class="flex justify-center mt-4">
        <div class="grid grid-cols-4 gap-10 mx-auto">
            <div class=" text-black flex flex-col justify-center items-center rounded-md  py-6 px-10   font-bold">
                <?php
                echo countSiswa();
                ?></p>
                </p>
                <p>siswa</p>
            </div>
            <div class=" text-black flex flex-col justify-center items-center rounded-md py-6 px-10  font-bold">
                <?php
                echo countPetugas();
                ?></p>
                </p>
                <p>petugas</p>
            </div>
            <div class=" text-black flex flex-col justify-center items-center rounded-md  py-6 px-10  font-bold">
                <p>
                    <?php
                       echo number_format($totalBayarBulanIni, 0, ',', '.');
                    ?>
                </p>
                <p>pembayaran bulan ini</p>
            </div>
            <div class=" text-black flex flex-col justify-center items-center rounded-md py-6 px-10   font-bold">
                <?php
                echo countKelas();
                ?></p>
                </p>
                <p>Kelas </p>
            </div>
        </div>
    </section>
    <div class="container mx-auto  my-5 p-5 text-center">
        <div class="flex justify-between mb-4 text-center">
            <a href="petugas/index.php" class="text-3xl cursor-pointer mb-5 text-center font-semibold hover:text-gray-400">Daftar Petugas</a>
        </div>
        <?php if (empty($petugasData)): ?>
            <p>Tidak ada data Petugas ditemukan.</p>
        <?php else: ?>
            <table class="min-w-full table-auto border-collapse bg-white shadow-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">Nama Petugas</th>
                        <th class="px-4 py-2">Level</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($petugasData as $petugas): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?= htmlspecialchars($petugas['id_petugas']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($petugas['username']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($petugas['nama_petugas']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($petugas['level']); ?></td>
                            <td class="px-4 py-2">
                                <a href="petugas/edit.php?id_petugas=<?= $petugas['id_petugas']; ?>" class="text-[#00FF33] font-medium hover:underline">Edit</a>
                                <a href="dashboard.php?deletePetugas=<?= $petugas['id_petugas']; ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="text-[#FF0000] font-medium hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="container mx-auto  my-5 p-5  text-center">
        <div class="flex justify-between mb-4 text-center">
            <a href="siswa/index.php" class="text-3xl cursor-pointer mb-5 text-center font-semibold hover:text-gray-400">Daftar Siswa</a>
        </div>
        <?php if (empty($siswaData)): ?>
            <p>Tidak ada data Siswa ditemukan.</p>
        <?php else: ?>
            <table class="min-w-full table-auto border-collapse bg-white shadow-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">NISN</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Kelas</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">SPP</th>
                        <th class="px-4 py-2">Telepon</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siswaData as $siswa): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?= htmlspecialchars($siswa['nisn']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($siswa['nama']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($siswa['nama_kelas']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($siswa['alamat']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($siswa['id_spp']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($siswa['no_telp']); ?></td>
                            <td class="px-4 py-2">
                                <a href="siswa/edit.php?nisn=<?= $siswa['nisn']; ?>" class="text-[#00FF33] font-medium hover:underline">Edit</a>
                                <a href="dashboard.php?deleteSiswa=<?= $siswa['nisn']; ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="text-[#FF0000] font-medium hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="container mx-auto  my-5 p-5  text-center">
        <div class="flex justify-between mb-4 text-center">
            <a href="laporan/index.php" class="text-3xl cursor-pointer  mb-5 text-center font-semibold hover:text-gray-400">History Pembayaran</a>
        </div>
        <?php if (empty($pembayaranData)): ?>
            <p>Tidak ada data pembayaran ditemukan.</p>
        <?php else: ?>
            <table class="min-w-full table-auto border-collapse shadow-md bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Petugas</th>
                        <th class="px-4 py-2">NISN</th>
                        <th class="px-4 py-2">Tanggal Bayar</th>
                        <th class="px-4 py-2">Bulan</th>
                        <th class="px-4 py-2">Tahun</th>
                        <th class="px-4 py-2">SPP</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembayaranData as $pembayaran): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['id_pembayaran']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['nama_petugas']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['nisn']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['tgl_bayar']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['bulan_dibayar']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['tahun_dibayar']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['tahun']); ?></td>
                            <td class="px-4 py-2"><?php echo number_format($pembayaran['jumlah_bayar'], 0, ',', '.');?></td>
                            <td class="px-4 py-2"><?php
                                                    if ($pembayaran['status'] == 'selesai') { ?>
                                    <p class="text-green-500"> <?= htmlspecialchars($pembayaran['status']); ?></p>
                                <?php } else { ?>
                                    <p class="text-red-500"><?= htmlspecialchars($pembayaran['status']); ?> </p><?php
                                                                                                            } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>