<?php
session_start();
include "../database.php";

function loginUser($username , $password )
{
    $conn = getDatabaseConnection();
    $reqst = $conn->prepare("SELECT * FROM petugas WHERE username = :username");
    $reqst->execute([':username' => $username]);
    $user = $reqst->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['username'] = $user ['username'];
        header("Location: /php-front/admin/kelas/index.php");
    }else{
        return "Gagal";
    }
}
?>

