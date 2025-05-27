<?php
function getIdPetugasByUsername($username)
{
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("SELECT id_petugas FROM petugas WHERE username = ?");
    $stmt->execute([$username]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data ? $data['id_petugas'] : null;
}
if ($_SESSION['status'] != "petugas") {
    header("location:/php-front/login/index.php?pesan=belum_login");
}
?>
<nav class="bg-[#2D5074] sticky z-50 top-0">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <svg class="hidden block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                </button>
            </div>
            <div class="flex flex-1 items-start justify-start sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <a href="/php-front/petugas/dashboard.php" class="font-extrabold text-2xl sm:text-3xl text-white hover:text-gray-300 cursor-pointer">SPP</a>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <div class=" sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="/php-front/petugas/history/index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" aria-current="page">History</a>
                        <a href="/php-front/petugas/laporan/index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Laporan</a>
                    </div>
                </div>
                <form action="/php-front/admin/aksi_logout.php">
                    <button action="/php-front/admin/aksi_logout.php" class=" ml-5 px-2 py-1 w-23 bg-red-600 cursor-pointer text-white font-medium rounded-md hover:bg-red-400" type="submit">Logout</button>
                </form>
</nav>