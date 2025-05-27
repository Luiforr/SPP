<?php
include "../aksi.php";
session_start();

$nis = $_SESSION['nis'];
$siswa = getIdSiswaByNIS($nis);
$nisn = $siswa['nisn'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Dashboard</title>
    <link href="../output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
<?php include "../../componen/navsis.php" ?>
<div class="container mx-auto mt-10 p-5">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md p-5">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 ">Profil Siswa</h1>
        <div class="mb-5">
            <table class="w-full text-left  text-gray-700">
                <tbody>
                    <tr><td class="py-2 font-semibold">Nama</td><td class="text-gray-500">: <?= htmlspecialchars($siswa['nama']); ?></td></tr>
                    <tr><td class="py-2 font-semibold">NIS</td><td class="text-gray-500">: <?= htmlspecialchars($siswa['nis']); ?></td></tr>
                    <tr><td class="py-2 font-semibold">NISN</td><td class="text-gray-500">: <?= htmlspecialchars($siswa['nisn']); ?></td></tr>
                    <tr><td class="py-2 font-semibold">Telepon</td><td class="text-gray-500">: <?= htmlspecialchars($siswa['no_telp']); ?></td></tr>
                    <tr><td class="py-2 font-semibold">Kelas</td><td class="text-gray-500">: <?= htmlspecialchars($siswa['nama_kelas']); ?></td></tr>
                    <tr><td class="py-2 font-semibold">Alamat</td><td class="text-gray-500">: <?= htmlspecialchars($siswa['alamat']); ?></td></tr>
                    <tr><td class="py-2 font-semibold">SPP</td><td class="text-gray-500">: <?= htmlspecialchars($siswa['tahun']); ?></td></tr>
                </tbody>
            </table>
        </div>
        <a href="edit.php" class="flex justify-center bg-[#1F3B57] text-white px-4 py-2 rounded hover:bg-gray-600 cursor-pointer" >Edit Profile</a>
    </div>
</div>
</body>
</html>