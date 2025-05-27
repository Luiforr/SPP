
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav class="bg-[#1F3B57] sticky z-50 top-0" x-data="{ dropdownOpen: false }">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="flex flex-1 items-center justify-start sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <a href="/php-front/index.php" class="font-extrabold text-2xl sm:text-3xl text-white hover:text-gray-300 cursor-pointer">SPP</a>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <a href="/php-front/siswa/history/index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" aria-current="page">History</a>
            <a href="/php-front/siswa/akun/index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Account</a>
          </div>
        </div>
        <div class="flex flex-1  items-center sm:hidden">
           <button @click="dropdownOpen = !dropdownOpen"
                   class="rounded-md px-5 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
             Aksi
             <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
             </svg>
           </button>
           <div x-show="dropdownOpen"
                @click.away="dropdownOpen = false"
                x-transition
                class="absolute right-2 top-16 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-md z-50">
             <a href="/php-front/siswa/history/index.php"
                class="block px-4 py-2 text-sm hover:bg-gray-700 hover:text-white">History</a>
             <a href="/php-front/siswa/akun/index.php"
                class="block px-4 py-2 text-sm hover:bg-gray-700 hover:text-white">Account</a>
           </div>
         </div>
        <a href="login/siswa.php"  class="text-center ml-5 px-2 py-1 w-24 bg-green-600 cursor-pointer text-white font-medium rounded-md hover:bg-green-400" >Login</a>
      </div>
    </div>
  </div>
</nav>
