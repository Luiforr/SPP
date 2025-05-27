<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>

<body class="bg-[#1F3B57] text-white min-h-screen flex flex-col">

  <?php include "./componen/navin.php"; ?>

  <main class="flex-grow px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-10 md:gap-20 fade-in">

    <section class="w-full md:w-1/2">
      <h1 class="text-5xl font-bold mb-6 leading-tight capitalize tracking-wide">
        Welcome to Our Website
      </h1>
      <p class="text-lg text-gray-200 mb-8 leading-relaxed">
        Kami adalah platform digital yang membantu sekolah dan orang tua mengelola keuangan pendidikan dengan lebih baik melalui sistem yang praktis, transparan, dan aman.
      </p>

      <div class="flex flex-wrap gap-4">
        <a href="login/siswa.php" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition duration-300">
          <i class="fas fa-sign-in-alt mr-2"></i> Login Siswa
        </a>
        <a href="?go=about" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition duration-300">
          <i class="fas fa-info-circle mr-2"></i> Tentang Kami
        </a>
      </div>
      <div class="mt-10 bg-white text-blue-800 p-8 rounded-xl shadow-lg">
        <?php if (isset($_GET['go']) && $_GET['go'] === 'about'): ?>
          <h2 class="text-3xl font-semibold mb-4">Tentang Kami</h2>
          <p class="leading-relaxed">
            Kami berdedikasi untuk memberikan layanan terbaik. Misi kami adalah menginovasi dan menginspirasi, dengan menjunjung tinggi integritas dan inklusivitas.
          </p>
        <?php else: ?>
          <h2 class="text-3xl font-semibold mb-4"> SPP</h2>
          <p class="leading-relaxed">
          Di situs ini anda dapat merekam/mendata transaksi yang sudah dilakukan
          </p>
        <?php endif; ?>
      </div>
    </section>
    <section class="w-full md:w-1/2 flex justify-center">
      <img
        src="./componen/gambar.png"
        alt="Digital dashboard illustration"
        class="max-w-sm w-full h-auto rounded-xl shadow-2xl border-2 border-white"
      />
    </section>
  </main>

  <?php include "./componen/footer.php"; ?>

</body>

</html>
