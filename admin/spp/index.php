<?php
include "spp_aksi.php";
session_start();

$username = $_SESSION['username'];


if (isset($_POST['create'])) {
    createSpp($_POST['tahun'], $_POST['nominal']);
    header("Location: spp.php?success=create");
    exit;
}

if (isset($_GET['delete'])) {
    deleteSpp($_GET['delete']);
    header("Location: siswa.php?success=delete");
    exit;
}

$id_spp = $_GET['edit'] ?? null;

$sppData = getAllData();

if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'create':
            $successMessage = " Data spp berhasil ditambahkan.";
            break;
        case 'update':
            $successMessage = "Data spp berhasil diperbarui.";
            break;
        case 'delete':
            $successMessage = " Data spp berhasil dihapus.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Spp</title>
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
            <h1 class="text-3xl font-bold mb-5">Daftar spp</h1>
        </div>

        <!-- ✅ ALERT -->
        <?php if (!empty($successMessage)): ?>
            <div class="mb-5 px-4 py-2 bg-green-100 text-green-800 rounded border border-green-300">
                <?= $successMessage; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="mb-5 flex">
            <div class="flex mb-3">
                <input type="text" name="tahun" class="px-4 py-2 w-1/2 border rounded" placeholder="Tahun" required>
                <input type="text" name="nominal" class="px-4 py-2 w-1/2 ml-2 border rounded" placeholder=" Nominal" required>
                <button type="submit" name="create" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded ">Tambah SPP</button>
            </div>
        </form>
        <?php if (empty($sppData)): ?>
            <p>Tidak ada data spp ditemukan.</p>
        <?php else: ?>
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">ID Spp</th>
                        <th class="px-4 py-2">Tahun</th>
                        <th class="px-4 py-2">Nominal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sppData as $spp): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?= htmlspecialchars($spp['id_spp']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($spp['tahun']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($spp['nominal']); ?></td>
                            <td class="px-4 py-2">
                                <a href="edit.php?id=<?= $spp['id_spp']; ?>" class="text-blue-500 hover:underline">Edit</a>
                                <a href="index.php?delete=<?= $spp['id_spp']; ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="text-[#FF0000] font-medium hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>