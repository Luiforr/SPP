<?php
include "siswa_aksi.php";
session_start();

$username = $_SESSION['username'];
if (isset($_GET['delete'])) {
    deleteSiswa($_GET['delete']);
    header("Location: index.php?success=delete");
    exit;
}
$siswaData = getAllData();

if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'create':
            $successMessage = " Data siswa berhasil ditambahkan.";
            break;
        case 'update':
            $successMessage = "Data siswa berhasil diperbarui.";
            break;
        case 'delete':
            $successMessage = " Data siswa berhasil dihapus.";
            break;
    }
}

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
    include '../../componen/navbar.php';
    ?>

    <h1 class="text-2xl font-medium py-3 px-7">WELKAM ADMIN DASHBOARD</h1>
    <h2 class="text-md font-medium text-cyan-700 px-15">Anda login sebagai Admin</h2>

    <section class="flex justify-center mt-4">
        <div class="grid grid-cols-3 gap-20">
            <div class="bg-white text-black flex flex-col justify-center items-center rounded-md border py-6 px-10 shadow-md font-bold">
                <p>Jumlah siswa</p>
                <p>1</p>
            </div>
            <div class="bg-white text-black flex flex-col justify-center items-center rounded-md border py-6 px-10 shadow-md font-bold">
                <p>Jumlah petugas</p>
                <p>1</p>
            </div>
            <div class="bg-white text-black flex flex-col justify-center items-center rounded-md border py-6 px-10 shadow-md font-bold">
                <p>Total pembayaran bulan ini</p>
                <p>1</p>
            </div>
        </div>
    </section>


    <div class="container mx-auto  my-5 p-5 bg-white rounded shadow-md text-center">
        <div class="flex justify-between mb-4 ">
            <h1 class="text-3xl font-bold mb-5">Daftar siswa</h1>
        </div>
        <?php if (!empty($successMessage)): ?>
            <div class="mb-5 px-4 py-2 bg-green-100 text-green-800 rounded border border-green-300">
                <?= $successMessage; ?>
            </div>
        <?php endif; ?>
        <div class="flex justify-between">
            <a href="/php-front/admin/siswa/tambah.php" type="button" class="mb-5 bg-blue-600 cursor-pointer rounded-md text-white px-4 py-2 hover:bg-blue-300">Tambah Siswa</a>
        </div>
        <?php if (empty($siswaData)): ?>
            <p>Tidak ada data siswa ditemukan.</p>
        <?php else: ?>
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Nisn</th>
                        <th class="px-4 py-2">Nis</th>
                        <th class="px-4 py-2">Nama siswa</th>
                        <th class="px-4 py-2">Kelas</th>
                        <th class="px-4 py-2">SPP</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>



                    <form action="aksi_logout.php" method="POST">

                        <?php foreach ($siswaData as $siswa): ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['nisn']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['nis']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['nama']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['nama_kelas']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($siswa['tahun']); ?></td>
                                <td class="px-4 py-2">
                                    <a href="edit.php?nisn=<?= $siswa['nisn']; ?>" class="text-blue-500 hover:underline">Edit</a>
                                    <a href="index.php?delete=<?= $siswa['nisn']; ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </form>
                </tbody>
            </table>

        <?php endif; ?>
    </div>

</body>

</html>