<?php

function getIdPetugasByUsername($username)
{
  $conn = getDatabaseConnection();
  $stmt = $conn->prepare("SELECT id_petugas FROM petugas WHERE username = ?");
  $stmt->execute([$username]);

  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data ? $data['id_petugas'] : null;
}
if ($_SESSION['status'] != "admin") {
  header("location:/php-front/login/index.php?pesan=belum_login");
}
?>

<nav class="bg-[#2D5074] sticky z-50 top-0" x-data="{ dropdownOpen: false }">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="flex flex-1 items-center justify-start sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <a href="/php-front/admin/dashboard.php" class="font-extrabold text-2xl sm:text-3xl text-white hover:text-gray-300 cursor-pointer">SPP</a>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <div class="relative" x-data="{ dropdownOpen: false }">
              <button @click="dropdownOpen = !dropdownOpen" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                CRUD
                <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-md z-50">
                <a href="/php-front/admin/spp/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">SPP</a>
                <a href="/php-front/admin/petugas/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Petugas</a>
                <a href="/php-front/admin/kelas/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Kelas</a>
                <a href="/php-front/admin/siswa/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Siswa</a>
                <a href="/php-front/admin/transaksi/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Transaksi</a>
              </div>
            </div>
            <a href="/php-front/admin/history/index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">History</a>
            <a href="/php-front/admin/laporan/index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Laporan</a>
          </div>
        </div>
             <div class="relative sm:hidden" x-data="{ dropdownOpen: false }">
              <button @click="dropdownOpen = !dropdownOpen" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                CRUD
                <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-md z-50">
                 <a href="/php-front/admin/history/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">History</a>
                  <a href="/php-front/admin/laporan/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Laporan</a>
                <a href="/php-front/admin/spp/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">SPP</a>
                <a href="/php-front/admin/petugas/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Petugas</a>
                <a href="/php-front/admin/kelas/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Kelas</a>
                <a href="/php-front/admin/siswa/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Siswa</a>
                <a href="/php-front/admin/transaksi/index.php" class="block rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-gray-700 hover:text-white">Transaksi</a>
              </div>
            </div>
        <form action="/php-front/admin/aksi_logout.php">
          <button action="/php-front/admin/aksi_logout.php" class=" ml-5 px-2 py-1 w-23 bg-red-600 cursor-pointer text-white font-medium rounded-md hover:bg-red-400" type="submit">Logout</button>
        </form>
      </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>