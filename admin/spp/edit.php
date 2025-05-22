<?php
include 'spp_aksi.php';
session_start();

$id_spp = $_GET['id'];
$spp = getSppById($id_spp);


if (!$spp) {
    echo "Data spp tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    updateSpp($_POST['id_spp'], $_POST['tahun'], $_POST['nominal']);
    header('Location: ../spp.php?success=update');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit SPP</title>
    <link href="../../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <?php include '../../componen/navbar.php'; ?>
    <div class="container mx-auto my-5 p-5 bg-white rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">Edit Spp</h1>
        <form action="" method="POST">
            <input type="hidden" name="id_spp" value="<?= htmlspecialchars($spp['id_spp']); ?>">
            <div class="mb-3">
                <label class="block font-semibold">Tahun</label>
                <input type="text" name="tahun" value="<?= htmlspecialchars($spp['tahun']); ?>" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-3">
                <label class="block font-semibold">Nominal</label>
                <input type="text" name="nominal" value="<?= htmlspecialchars($spp['nominal']); ?>" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="flex justify-end">
                <a href="/php-front/admin/spp/index.php" class="mr-3 px-4 py-2 bg-red-600 text-white rounded">Batal</a>
                <button type="submit" name="update" class="px-4 py-2 bg-green-600 text-white rounded"
                    onclick="return confirm('Yakin ingin update data ini?')">Update</button>
            </div>
        </form>
    </div>
</body>

</html>