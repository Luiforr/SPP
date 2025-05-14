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
        $_SESSION['username']= $user ['username'];
        $_SESSION['id_petugas']= $user ['id_petugas'];
        $_SESSION['status']= "admin";
        if ($user ['level'] == 'admin') {
            header("Location: /php-front/admin/dashboard.php");
        }else{
            header("Location: /php-front/petugas/dashboard.php");
        }
    }else{
        return "Gagal";
    }
}


function loginSiswa($nis, $password )
{
    $conn = getDatabaseConnection();
    $reqst = $conn->prepare("SELECT * FROM siswa WHERE nis = :nis");
    $reqst->execute([':nis' => $nis]);
    $user = $reqst->fetch(PDO::FETCH_ASSOC);
    
    if($user && password_verify($password, $user['password'])){
        $_SESSION['nis'] = $user ['nis'];
        $_SESSION['status']= "login";
        header("Location: /php-front/siswa/dashboard.php");
    }else{
        return "Gagal";
    }
}
?>


