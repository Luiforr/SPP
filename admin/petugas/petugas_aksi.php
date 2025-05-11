<?php
include __DIR__ . '../../../database.php';


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM petugas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function getPetugasById($id_petugas) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM petugas WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_petugas]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: /php-front/admin/petugas/index.php");
    exit;

}

function createPetugas(  $username, $nama_petugas,  $password, $level) {
    $conn = getDatabaseConnection();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO petugas (  username, nama_petugas, password, level) VALUES ( ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([  $username, $nama_petugas, $password, $level]);
    header("Location: /php-front/admin/petugas/index.php");
    exit;
}

function updatePetugas($username, $nama_petugas, $level, $id_petugas) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE petugas SET  username= ?, nama_petugas = ?, level = ? WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([ $username, $nama_petugas, $level, $id_petugas]);
    header("Location: /php-front/admin/petugas/index.php");
    exit;
}

function deletePetugas($id_petugas) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM petugas WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_petugas]);
    header("Location: /php-front/admin/petugas/index.php");
    exit;
}

?>