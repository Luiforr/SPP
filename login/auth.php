<?php
include '../database.php';
session_start();

function register($table, $username, $password) {
    $conn = getDataBaseConnection();

    $res = $conn->prepare("SELECT * FROM $table WHERE username = :username");
    $res->execute([':username' => $username]);

    if($res->rowCount() > 0) {
        return "Username sudah terdaftar";
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $res = $conn->prepare("INSERT INTO $table (username, password) VALUES (:username, :password)");
    $res->execute([
        ':username' => $username,
        ':password' => $hashedPassword
    ]);
    return true;
}

function login ($tipe, $username, $password){
    $conn = getDatabaseConnection();
    $res = $conn->prepare("SELECT * FROM $tipe WHERE username = :username");
    $res->execute([$username]);
    $data = $res->fetch(PDO ::FETCH_ASSOC);

    if($data && password_verify($password, $data['password'])){
        $_SESSION ['user'] = $data;
        $_SESSION ['tipe'] = $tipe;
        return "Berhasil Login";
    }

    return "Gagal Login";
}



?>