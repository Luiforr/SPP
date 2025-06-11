<?php
include "../aksi.php";
session_start();

$nis = $_SESSION['nis'];
$user = getIdSiswaByNIS($nis);
$success_message = "";
$nisn = $user['nisn'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $password = trim($_POST['password']);

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $success = updateSiswaAkun($nisn, $alamat, $no_telp, $hashed_password);
    } else {
        $success = updateSiswaAkun($nisn, $alamat, $no_telp);
    }

    if ($success) {
        $success_message = "Data berhasil diperbarui!";
        $user = getIdSiswaByNIS($nis);
    } else {
        $success_message = "Terjadi kesalahan saat memperbarui data.";
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full relative">
        <div class="absolute top-4 left-4">
            <a href="index.php" class="text-red-500  hover:text-red-700 text-sm ">← Kembali</a>
        </div>
        <div class="flex flex-col items-center mb-6">
            <h1 class="text-xl font-bold text-gray-800">Edit Akun Siswa</h1>
            <?php if ($success_message): ?>
                <p class="text-green-500 mt-2"><?= htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
        </div>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium" for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($user['alamat']); ?>"
                    class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium" for="no_telp">Nomor Telepon</label>
                <input type="text" id="no_telp" name="no_telp" value="<?= htmlspecialchars($user['no_telp']); ?>"
                    class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium" for="password">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="********">
            </div>

            <button type="submit"
                class="w-full bg-[#1F3B57] text-white px-4 py-2 rounded-lg shadow hover:bg-gray-400 transition">Simpan Perubahan</button>

        </form>
    </div>
</body>

</html>