<?php
include 'siswa_aksi.php';
include '../../componen/admin.php';
if (!isset($_GET['nisn'])) {
    header('Location: ../index.php');
    exit;
}

$nisn = $_GET['nisn'];
$siswa = getSiswaById($nisn);

if (!$siswa) {
    echo "Data siswa tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    updateSiswa($_POST['nis'], $_POST['nama'], $_POST['id_kelas'], $_POST['id_spp'], $nisn);
    header('Location:  php-front/admin/siswa/index.php?success=update');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <link href="../../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-gray-100">
<div class="container mx-auto my-5 p-5 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-4">Edit Siswa</h1>
    <form action="" method="POST">
        <input type="hidden" name="nisn" value="<?= htmlspecialchars($nisn); ?>" />
        <div class="mb-3">
            <label class="block font-semibold">NIS</label>
            <input type="text" name="nis" value="<?= htmlspecialchars($siswa['nis']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Nama Siswa</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Kelas</label>
            <input type="text" name="id_kelas" value="<?= htmlspecialchars($siswa['id_kelas']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Id SPP</label>
            <input type="text" name="id_spp" value="<?= htmlspecialchars($siswa['id_spp']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="flex justify-end">
            <a href="../siswa/index.php" class="mr-3 px-4 py-2 bg-red-600 rounded text-white">Batal</a>
            <button type="submit" name="update" class="px-4 py-2 bg-green-600 text-white rounded"
            onclick="return confirm('Yakin ingin update data ini?')"
            >Update</button>
        </div>
    </form>
</div>
</body>
</html>
