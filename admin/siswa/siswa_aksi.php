<?php
include __DIR__ . '/../../database.php';


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM siswa,spp,kelas where siswa.id_spp = spp.id_spp and siswa.id_kelas = kelas.id_kelas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function getSiswaById($nisn) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM siswa WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;

}

function createSiswa($nisn, $nis, $nama, $id_kelas, $id_spp, $password) {
    $conn = getDatabaseConnection();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO siswa (nisn, nis, nama, id_kelas, id_spp, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn, $nis, $nama, $id_kelas, $id_spp, $password]);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;
}
function updateSiswa( $nis, $nama, $id_kelas, $id_spp, $nisn) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE siswa SET nis = ?, nama = ?, id_kelas = ?, id_spp = ? WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([ $nis, $nama, $id_kelas, $id_spp, $nisn]);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;
}



function deleteSiswa($nisn) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM siswa WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;
}
?>
