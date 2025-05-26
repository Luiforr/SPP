<?php
include "aksi.php";
session_start();

$username = $_SESSION['username'];
$id_petugas = $_SESSION['id_petugas'];
if (isset($_GET['deleteKelas'])) {
    deleteKelas($_GET['deleteKelas']);
    header("Location: dashboard.php?tab=kelas&page=$page");
    exit;
}
if (isset($_GET['deleteSpp'])) {
    deleteSPP($_GET['deleteSpp']);
    header("Location: dashboard.php?tab=spp&page=$page");
    exit;
}
if (isset($_GET['deletePetugas'])) {
    deletePetugas($_GET['deletePetugas']);
    header("Location: dashboard.php?tab=petugas&page=$page");
    exit;
}
if (isset($_GET['deleteSiswa'])) {
    deleteSiswa($_GET['deleteSiswa']);
    header("Location: dashboard.php?tab=siswa&page=$page");
    exit;
}
$userData = getDataPetugasId($id_petugas);
$totalBayarBulanIni = sumPembayaranBulanIni();
$limit = 5;
$activeTab = $_GET['tab'] ?? 'petugas';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$no = ($page - 1) * $limit + 1;
switch ($activeTab) {
    case 'siswa':
        $siswaData = getAllDataSiswa($limit, $page);
        $total = countAllSiswa();
        $totalPages = ceil($total / $limit);
        break;

    case 'pembayaran':
        $pembayaranData = getAllDataPembayaran($limit, $page);
        $total = countAllPembayaran();
        $totalPages = ceil($total / $limit);
        break;

    case 'kelas':
        $kelasData = getAllDataKelas($limit, $page);
        $total = countAllKelas();
        $totalPages = ceil($total / $limit);
        break;

    case 'spp':
        $sppData = getAllDataSpp($limit, $page);
        $total = countAllSpp();
        $totalPages = ceil($total / $limit);
        break;


    default: // petugas
        $petugasData = getAllDataPetugas($limit, $page);
        $total = countAllPetugas();
        $totalPages = ceil($total / $limit);
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 ">
    <?php
    include '../componen/navbar.php';
    ?>
    <div class=" w-full  mt-6 h-18">
        <h2 class=" text-center font-medium text-black text-xl ">Selamat datang  <?php echo  $userData["nama_petugas"]?> di page Dashboard</h2>
    </div>
    <section class="flex justify-center ">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 mb-5 px-4 w-full">
            <div class=" text-black flex flex-col justify-center items-center rounded-md   px-10   font-bold">
                <?php
                echo countSiswa();
                ?></p>
                </p>
                <p>siswa</p>
            </div>
            <div class=" text-black flex flex-col justify-center items-center rounded-md  px-10  font-bold">
                <?php
                echo countPetugas();
                ?></p>
                </p>
                <p>petugas</p>
            </div>
            <div class=" text-black flex flex-col justify-center items-center rounded-md   px-10  font-bold">
                <p>
                    <?php
                    echo number_format($totalBayarBulanIni, 0, ',', '.');
                    ?>
                </p>
                <p>pembayaran bulan ini</p>
            </div>
            <div class=" text-black flex flex-col justify-center items-center rounded-md  px-10   font-bold">
                <?php
                echo countKelas();
                ?></p>
                </p>
                <p>Kelas </p>
            </div>
        </div>
    </section>
    <div class="container mx-auto    text-center p-5">
        <div class="flex justify-center w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 w-full max-w-5xl px-4 mb-4">
                <a href="?tab=petugas&page=1" class="text-md bg-[#2D5074] font-semibold px-4 py-2 rounded text-center w-full hover:bg-slate-500 hover:text-gray-400 <?= $activeTab == 'petugas' ? 'text-gray-400' : 'text-white' ?>">Petugas</a>
                <a href="?tab=siswa&page=1" class="text-md bg-[#2D5074] font-semibold px-4 py-2 rounded text-center w-full hover:bg-slate-500 hover:text-gray-400 <?= $activeTab == 'siswa' ? 'text-gray-400' : 'text-white' ?>">Siswa</a>
                <a href="?tab=pembayaran&page=1" class="text-md bg-[#2D5074] font-semibold px-4 py-2 rounded text-center w-full hover:bg-slate-500 hover:text-gray-400 <?= $activeTab == 'pembayaran' ? 'text-gray-400' : 'text-white' ?>">Pembayaran</a>
                <a href="?tab=kelas&page=1" class="text-md bg-[#2D5074] font-semibold px-4 py-2 rounded text-center w-full hover:bg-slate-500 hover:text-gray-400 <?= $activeTab == 'kelas' ? 'text-gray-400' : 'text-white' ?>">Kelas</a>
                <a href="?tab=spp&page=1" class="text-md bg-[#2D5074] font-semibold px-4 py-2 rounded text-center w-full hover:bg-slate-500 hover:text-gray-400 <?= $activeTab == 'spp' ? 'text-gray-400' : 'text-white' ?>">SPP</a>
            </div>
        </div>

        <?php if ($activeTab == 'petugas'): ?>
            <?php if (empty($petugasData)): ?>
                <p>Tidak ada data Petugas ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse bg-white shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">NO</th>
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
                                <td class="px-4 py-2"><?= htmlspecialchars($no++); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($petugas['id_petugas']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($petugas['username']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($petugas['nama_petugas']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($petugas['level']); ?></td>
                                <td class="px-4 py-2">
                                    <a href="petugas/edit.php?id_petugas=<?= $petugas['id_petugas']; ?>" class="text-[#00FF33] font-medium hover:underline">Edit</a>
                                    <a href="dashboard.php?deletePetugas=<?= $petugas['id_petugas']; ?>&tab=petugas&page=<?= $page ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="text-[#FF0000] font-medium hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php elseif ($activeTab == 'siswa'): ?>
            <?php if (empty($siswaData)): ?>
                <p>Tidak ada data siswa ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse bg-white shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">NO</th>
                            <th class="px-4 py-2">NIS</th>
                            <th class="px-4 py-2">Nama Siswa</th>
                            <th class="px-4 py-2">Kelas</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswaData as $siswa): ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?= htmlspecialchars($no++); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['nis']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['nama']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['nama_kelas']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['alamat']); ?></td>
                                <td class="px-4 py-2">
                                    <a href="siswa/edit.php?nisn=<?= $siswa['nisn']; ?>" class="text-[#00FF33] font-medium hover:underline">Edit</a>
                                    <a href="dashboard.php?deleteSiswa=<?= $siswa['nisn']; ?>&tab=siswa&page=<?= $page ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="text-[#FF0000] font-medium hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php elseif ($activeTab == 'pembayaran'): ?>
            <?php if (empty($pembayaranData)): ?>
                <p>Tidak ada data pembayaran ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse bg-white shadow-md">
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
                        <?php foreach ($pembayaranData as $pembayaran): ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?= htmlspecialchars($no++); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['nis']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['nama']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($pembayaran['tgl_bayar']); ?></td>
                                <td class="px-4 py-2">RP <?php echo number_format($pembayaran['jumlah_bayar'], 0, ',', '.'); ?></td>
                                <td class="px-4 py-2 font-semibold"> <?php if ($pembayaran['status'] === 'selesai'): ?>
                                        <span
                                            class="text-green-600 font-semibold cursor-pointer"
                                            onclick="toggleSelect('<?= $pembayaran['id_pembayaran'] ?>')">
                                            Selesai
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="text-red-600 font-semibold cursor-pointer"
                                            onclick="toggleSelect('<?= $pembayaran['id_pembayaran'] ?>')">
                                            Belum
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php elseif ($activeTab == 'kelas'): ?>
            <?php if (empty($kelasData)): ?>
                <p>Tidak ada data kelas ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse bg-white shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">NO</th>
                            <th class="px-4 py-2">Nama Kelas</th>
                            <th class="px-4 py-2">Kompetensi Keahlian</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($kelasData as $kelas):  ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?php echo $no++ ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($kelas['nama_kelas']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($kelas['kompetensi_keahlian']); ?></td>
                                <td class="px-4 py-2">
                                    <a href="kelas/edit.php?id=<?= $kelas['id_kelas']; ?>" class="text-[#00FF33] font-medium hover:underline">Edit</a>
                                    <a href="dashboard.php?deleteKelas=<?= $kelas['id_kelas']; ?>&tab=kelas&page=<?= $page ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="text-[#FF0000] font-medium hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php elseif ($activeTab == 'spp'): ?>
            <?php if (empty($sppData)): ?>
                <p>Tidak ada data kelas ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse bg-white shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">NO</th>
                            <th class="px-4 py-2">Tahun</th>
                            <th class="px-4 py-2">Nominal</th>
                            <th class="px-4 py-2">Aksi</th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sppData as $spp): ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?php echo $no++ ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($spp['tahun']); ?></td>
                                <td class="px-4 py-2">RP <?php echo number_format($spp['nominal'], 0, ',', '.'); ?></td>
                                <td class="px-4 py-2">
                                    <a href="spp/edit.php?id=<?= $spp['id_spp']; ?>" class="text-[#00FF33] font-medium hover:underline">Edit</a>
                                    <a href="dashboard.php?deleteSpp=<?= $spp['id_spp']; ?>&tab=spp&page=<?= $page ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="text-[#FF0000] font-medium hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($totalPages > 1): ?>
            <div class="mt-4 flex justify-center space-x-2 mb-5">
                <?php if ($page > 1): ?>
                    <a href="?tab=<?= $activeTab ?>&page=<?= $page - 1 ?>"
                        class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">
                        <
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?tab=<?= $activeTab ?>&page=<?= $i ?>"
                                class="px-3 py-1  rounded <?= $i == $page ? 'bg-[#2D5074] text-white rounded' : 'bg-gray-300 hover:bg-gray-400' ?>">
                                <?= $i ?></a>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                            <a href="?tab=<?= $activeTab ?>&page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">></a>
                        <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
<?php include "../componen/footer.php"  ?>
</html>