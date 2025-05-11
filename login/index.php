<?php
include "aksi_login.php";

$result = null;

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';
    $result = loginUser($username, $password);

    if($result) {
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../output.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>

<div class="flex justify-center items-center min-h-screen ">
<form method="POST" class=" shadow-xl p-10 grid grid-cols-1 gap-2  w-full max-w-md space-y-1 rounded-lg border-1 border-black">
<h2 class=" font-bold text-4xl text-center mb-8">Login Admin</h2>
<div>
    <label class="font-semibold ">Username</label>
    <input type="text" name="username" required placeholder="username" class="w-full h-12 px-4 py-2 rounded-xl focus:outline-none focus:ring-2 outline-1 focus:ring-[#2D5074] bg-[#D1CECA]  placeholder-[#123458]">
    </div>

    <div>
    <label class="font-semibold">Password</label>
    <input type="password" name="password" required placeholder="password" class="w-full h-12 px-4 py-2 rounded-xl focus:outline-none focus:ring-2 outline-1 focus:ring-[#2D5074] bg-[#D1CECA]  placeholder-[#123458]">
    </div>

    <button class =" px-6 py-3 rounded-xl  bg-[#2D5074] text-white font-semibold transition hover:scale-110 hover:shadow-xl 
    focus:ring-3 focus:outline-hidden cursor-pointer w-full mt-2" type="submit">Login</button>
</form>
</div>
</body>
</html>