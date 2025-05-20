
 <?php
// include 'spp_aksi.php';
// include '../../componen/navbar.php';
// session_start();

// if (isset($_POST['create'])) {
//   createSpp( $_POST['tahun'], $_POST['nominal']);
//   header('Location: /php-front/index.php?success=update');
//   exit;
// }
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
  <div class="flex justify-center items-center min-h-screen bg-blue-50 ">
    <form method="POST" action="" class=" shadow-xl p-4 grid grid-cols-1 w-full max-w-md space-y-2 rounded-2xl">
      <h2 class=" font-bold text-3xl text-center">Tambah Spp</h2>
      <div>
        <label for="tahun" name="tahun" class="block text-md font-semibold ">Tahun</label>
        <input type="text" name="tahun" id="tahun" class="w-full border rounded-md ">
      </div>
      <div>
        <label for="nominal" class="block text-md font-semibold ">Nominal</label>
        <input type="text" id="nominal" name="nominal" class="w-full border rounded-md ">
      </div>
      <div class=" flex justify-between">
        <a href="/php-front/admin/spp.php" type="button" class="bg-blue-500 cursor-pointer text-white px-4 py-2 rounded-md hover:bg-blue-300">Kembali</a>
        <button type="submit" name="create" class="bg-green-500 cursor-pointer text-white px-4 py-2 rounded-md hover:bg-green-300">Simpan</button>
      </div>
</body>

</html>