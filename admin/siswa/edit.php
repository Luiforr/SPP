<?php
include 'siswa_aksi.php';
session_start();

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
  <?php include '../../componen/navbar.php'; ?>
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
          <select name="id_kelas" id="id_kelas" required class="w-full border px-2 py-1 rounded-md">
          <option value="<?= $siswa['id_kelas']; ?>">-- <?= htmlspecialchars($siswa['nama_kelas']) ; ?> --</option>
          <?php foreach ($kelasList as $kelas): ?>
            <option value="<?= htmlspecialchars($kelas['id_kelas']) ?>">
              <?= htmlspecialchars($kelas['nama_kelas']) ?> (<?= $kelas['id_kelas'] ?>)
            </option>
          <?php endforeach; ?>
        </select>  
        </div>
        <div class="mb-3">
        <select name="id_spp" id="id_spp" required class="w-full border px-2 py-1 rounded-md">
          <option value="<?= $siswa['id_spp']; ?>">-- <?= htmlspecialchars($siswa['tahun']) ; ?> --</option>
          <?php foreach ($sppList as $spp): ?>
            <option value="<?= htmlspecialchars($spp['id_spp']) ?>">
              <?= htmlspecialchars($spp['tahun']) ?> (<?= $spp['id_spp'] ?>)
            </option>
          <?php endforeach; ?>
        </select>  
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
