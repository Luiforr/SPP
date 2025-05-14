<?php
include 'petugas_aksi.php';

$id_petugas = $_GET['id_petugas'];
$petugas = getPetugasById($id_petugas);
if (!$petugas) {
    echo "Data petugas tidak ditemukan.";
    exit;
}
if (isset($_POST['update'])) {
    updatePetugas( $_POST['username'], $_POST['nama_petugas'],  $_POST['level'], $id_petugas);
    header('Location: php-front/admin/petugas.php?success=update');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit petugas</title>
    <link href="../../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <?php
    include "../../componen/navbar.php"
    ?>
<div class="container mx-auto my-5 p-5 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-4">Edit Petugas</h1>
    <form action="" method="POST">
        <input type="hidden" name="id_petugas" value="<?= htmlspecialchars($petugas['id_petugas']); ?>">
        <div class="mb-3">
            <label class="block font-semibold">Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($petugas['username']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Nama Petugas</label>
            <input type="text" name="nama_petugas" value="<?= htmlspecialchars($petugas['nama_petugas']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Level</label>
            <input type="text" name="level" value="<?= htmlspecialchars($petugas['level']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="flex justify-end">
            <a href="/php-front/admin/petugas/index.php" class="mr-3 px-4 py-2 bg-red-600 rounded text-white">Batal</a>
            <button type="submit" name="update" class="px-4 py-2 bg-green-600 text-white rounded"
            onclick="return confirm('Yakin ingin update data ini?')"
            >Update</button>
        </div>
    </form>
</div>
</body>
</html>
