<?php
include "petugas_aksi.php";
session_start();

if (isset($_POST['create'])) {
  createPetugas( $_POST['username'], $_POST['nama_petugas'], $_POST['password'], $_POST['level']);
  header("Location: petugas.php?success=create");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="../output.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<?php
  include '../../componen/navbar.php';
  ?>

  <div class="flex justify-center items-center min-h-screen bg-blue-50 ">
    <form method="POST" action="" class=" shadow-xl p-4 grid grid-cols-1 w-full max-w-md space-y-3 rounded-2xl">
      <h2 class=" font-bold text-3xl text-center">Tambah Petugas</h2>
      <div>
        <label for="username" class="block text-md font-semibold ">Username</label>
        <input type=" text" name="username" id="username" class="w-full border rounded-md ">
      </div>
      <div>
        <label for="nama_petugas" class="block text-md font-semibold ">Nama Petugas</label>
        <input type=" text" name="nama_petugas" id="nama_petugas" class="w-full border rounded-md ">
      </div>
      <div>
        <label for="password" class="block text-md font-semibold ">Password</label>
        <input type=" text" name="password" id="password" class="w-full border rounded-md ">
      </div>
      <div>
        <label for="level" class="block text-md font-semibold ">Level</label>
        <input type=" text" name="level" id="level" class="w-full border rounded-md ">
      </div>
      <div class=" flex justify-between">
        <a href="/php-front/admin/petugas/index.php" type="button" class="bg-blue-500 cursor-pointer text-white px-4 py-2 rounded-md hover:bg-blue-300">Kembali</a>
        <button type="submit" name="create" class="bg-green-500 cursor-pointer text-white px-4 py-2 rounded-md hover:bg-green-300">Simpan</button>
      </div>
</body>

</html>