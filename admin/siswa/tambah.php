<?php
include 'siswa_aksi.php';

session_start();

if (isset($_POST['create'])) {
  createSiswa($_POST['nisn'], $_POST['nis'], $_POST['nama'], $_POST['id_kelas'], $_POST['id_spp'], $_POST['password']);

  header('Location: php-front/admin/siswa.php?success=update');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
  <link href="../output.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>



<body class="bg-blue-50">

  <!-- NAVBAR -->
  <!-- <nav class="bg-[#4692AF] sticky z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center text-white">
      <div class="text-lg font-bold">SPP Admin</div>
      <div class="flex space-x-4">
        <a href="#" class="hover:underline">Dashboard</a>
        <a href="#" class="hover:underline">Petugas</a>
        <a href="#" class="hover:underline font-bold">Siswa</a>
        <a href="#" class="hover:underline">Kelas</a>
        <a href="#" class="hover:underline">Laporan</a>
        <a href="#" class="bg-red-500 px-2 py-1 rounded hover:bg-red-400">Logout</a>
      </div>
    </div>
  </nav> -->


  <?php
  include '../../componen/navbar.php';
  ?>

  <!-- FORM TAMBAH -->
  <div class="flex justify-center items-center min-h-screen">
    <form method="POST" action="" class="bg-white shadow-xl p-6 rounded-xl w-full max-w-md space-y-4">
      <h2 class="text-2xl font-bold text-center">Tambah Siswa</h2>

      <div>
        <label for="nisn" class="block font-semibold">Nisn</label>
        <input type="text" id="nisn" name="nisn" required class="w-full border px-2 py-1 rounded-md">
      </div>

      <div>
        <label for="nis" class="block font-semibold">Nis</label>
        <input type="text" id="nis" name="nis" required class="w-full border px-2 py-1 rounded-md">
      </div>

      <div>
        <label for="nama" class="block font-semibold">Nama</label>
        <input type="text" id="nama" name="nama" required class="w-full border px-2 py-1 rounded-md">
      </div>

      <div>
        <select name="id_kelas" id="id_kelas" required class="w-full border px-2 py-1 rounded-md">
          <option value="">-- Pilih Kelas --</option>
          <?php foreach ($kelasList as $kelas): ?>
            <option value="<?= htmlspecialchars($kelas['id_kelas']) ?>">
              <?= htmlspecialchars($kelas['nama_kelas']) ?> (<?= $kelas['id_kelas'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label for="password" class="block font-semibold">Password</label>
        <input type="password" id="password" name="password" required class="w-full border px-2 py-1 rounded-md">
      </div>
      <div>
      <select name="id_spp" id="id_spp" required class="w-full border px-2 py-1 rounded-md">
          <option value="">-- Pilih SPP --</option>
          <?php foreach ($sppList as $spp): ?>
            <option value="<?= htmlspecialchars($spp['id_spp']) ?>">
              <?= htmlspecialchars($spp['tahun']) ?> (<?= $spp['id_spp'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="flex justify-end gap-2">
        <a href="../siswa/index.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-400 ">Kembali</a>
        <button type="submit" name="create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-400">Simpan</button>
      </div>
    </form>
  </div>

</body>

</html>