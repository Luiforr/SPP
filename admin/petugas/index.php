<?php
include "petugas_aksi.php";

session_start();

$username = $_SESSION['username'];
if (isset($_POST['create'])) {
    createPetugas($_POST['id_petugas'], $_POST['nama_petugas'], $_POST['username'], $_POST['password'], $_POST['level']);
    header("Location: petugas.php?success=create");
    exit;
}
if (isset($_GET['delete'])) {
    deletePetugas($_GET['delete']);
    header("Location: petugas.php?success=delete");
    exit;
}

$petugas = $_GET['edit'] ?? null;


$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$petugasData = getAllData($search, $limit, $offset);
$totalData = countAllData($search);
$totalPages = ceil($totalData / $limit);

// if (isset($_GET['success'])) {
//     switch ($_GET['success']) {
//         case 'create':
//             $successMessage = " Data petugas berhasil ditambahkan.";
//             break;
//         case 'update':
//             $successMessage = "Data petugas berhasil diperbarui.";
//             break;
//         case 'delete':
//             $successMessage = " Data petugas berhasil dihapus.";
//             break;
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Petugas</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <?php
    include "../../componen/navbar.php"
    ?>  
    <div class="container mx-auto  my-5 p-5  rounded  text-center">
        <div class="flex justify-between mb-4 ">
            <h1 class="text-3xl font-bold mb-5">Daftar Petugas</h1>
        </div>
        <?php if (!empty($successMessage)): ?>
            <div class="mb-5 px-4 py-2 bg-green-100 text-green-800 rounded border border-green-300">
                <?= $successMessage; ?>
            </div>
        <?php endif; ?>
        <div class="flex justify-between">
        
        <form method="GET" action="" class="mb-4 flex gap-2">
            <input type="text" name="search" placeholder="Level atau Nama" value="<?= htmlspecialchars($search) ?>" class="px-3 py-1 border rounded w-full">
            <button type="submit" class="bg-[#2D5074] text-white px-4 py-1 rounded w-38 font-semibold cursor-pointer hover:bg-slate-300 ">Cari</button>
        </form><a href="/php-front/admin/petugas/tambah.php" type="button" class="mb-5 font-semibold bg-green-500 rounded-md text-white px-4 py-2 hover:bg-green-300 ">+ Petugas</a>
        </div>
            <?php if (empty($petugasData)): ?>
                <p>Tidak ada data petugas ditemukan.</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse shadow-md bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">ID Petugas</th>
                            <th class="px-4 py-2">Username</th>
                            <th class="px-4 py-2">Nama Petugas</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="aksi_logout.php" method="POST">
                            <?php foreach ($petugasData as $petugas): ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2"><?= htmlspecialchars($petugas['id_petugas']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($petugas['username']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($petugas['nama_petugas']); ?></td>
                                    <td class="px-4 py-2">
                                        <a href="edit.php?id_petugas=<?= $petugas['id_petugas']; ?>" class="text-[#00FF33] hover:underline">Edit</a>
                                        <a href="index.php?delete=<?= $petugas['id_petugas']; ?>"
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