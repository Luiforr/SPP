<?php
include '../aksi.php';

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];
$kelas = getKelasById($id);

if (!$kelas) {
    echo "Data kelas tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    updateKelas($_POST['id_kelas'], $_POST['nama_kelas'], $_POST['kompetensi_keahlian']);
    header('Location: ../index.php?success=update');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Kelas</title>
    <link href="../../output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
<div class="container mx-auto my-5 p-5 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-4">Edit Kelas</h1>
    <form action="" method="POST">
        <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']; ?>">
        <div class="mb-3">
            <label class="block font-semibold">Nama Kelas</label>
            <input type="text" name="nama_kelas" value="<?= htmlspecialchars($kelas['nama_kelas']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block font-semibold">Kompetensi Keahlian</label>
            <input type="text" name="kompetensi_keahlian" value="<?= htmlspecialchars($kelas['kompetensi_keahlian']); ?>" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="flex justify-end">
            <a href="../index.php" class="mr-3 px-4 py-2 bg-gray-300 rounded">Batal</a>
            <button type="submit" name="update" class="px-4 py-2 bg-blue-600 cursor-pointer text-white rounded">Update</button>
        </div>
    </form>
</div>
</body>
</html>
