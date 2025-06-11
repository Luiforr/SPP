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

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$sppData = getAllData($search, $limit, $offset);
$totalData = countAllData($search);
$totalPages = ceil($totalData / $limit);
$no = ($page - 1) * $limit + 1;

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
    <title>Daftar SPP</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <?php
    include '../../componen/navbar.php';
    ?>
   
    <div class="container mx-auto  my-5 p-5  text-center">
        <div class="flex justify-between mb-4 ">
            <h1 class="text-3xl font-bold mb-5">Daftar spp</h1>
            <form method="GET" action="" class="mb-4 flex gap-2">
                <input type="text" name="search" placeholder="Cari Tahun" value="<?= htmlspecialchars($search) ?>" class="px-3 py-1 border rounded w-full">
                <button type="submit" class="bg-[#2D5074] text-white px-4 py-1 rounded w-38 font-semibold cursor-pointer hover:bg-slate-300">Cari</button>
            </form>
        </div>

        <!-- ✅ ALERT -->
        <?php if (!empty($successMessage)): ?>
            <div class="mb-5 px-4 py-2 bg-green-100 text-green-800 rounded border border-green-300">
                <?= $successMessage; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="mb-5">
                <div class="flex mb-3">
                    <input type="text" name="tahun" class="px-4 py-2 w-1/2 border rounded" placeholder="Tahun" required>
                    <input type="text" name="nominal" class="px-4 py-2 w-1/2 ml-2 border rounded" placeholder="nominal" required>
                    <button type="submit" name="create" class="  ml-2 px-4 text-sm bg-green-500 text-white rounded cursor-pointer font-semibold w-30 hover:bg-green-300 ">+ SPP </button>
                </div>
            </form>
        <?php if (empty($sppData)): ?>
            <p>Tidak ada data spp ditemukan.</p>
        <?php else: ?>
            <table class="min-w-full table-auto border-collapse bg-white shadow-md">
                <thead>
                    <tr class="bg-gray-200">
                    <th class="px-4 py-2">NO</th>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Tahun</th>
                        <th class="px-4 py-2">Nominal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sppData as $spp): ?>
                        <tr class="border-t">
                        <td class="px-4 py-2"><?= htmlspecialchars($no++); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($spp['id_spp']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($spp['tahun']); ?></td>
                            <td class="px-4 py-2">RP <?php echo number_format($spp['nominal'], 0, ',', '.');?></td>
                            <td class="px-4 py-2">
                                <a href="edit.php?id=<?= $spp['id_spp']; ?>" class="text-[#00FF33] hover:underline">Edit</a>
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
<?php include "../../componen/footer.php"  ?>
</html>