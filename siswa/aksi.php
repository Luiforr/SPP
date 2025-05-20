<?php
include __DIR__ . '/../database.php';



// function getAllData() {
//     $conn = getDatabaseConnection();
//     $sql = "SELECT * FROM pembayaran,petugas,siswa,spp where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     exit;
// }

function getIdSiswaByNIS($nis) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM siswa,kelas,spp,pembayaran WHERE siswa.id_kelas = kelas.id_kelas and siswa.nisn = pembayaran.nisn and siswa.id_spp = spp.id_spp and  nis = ?");
    $stmt->execute([$nis]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data ?: null;
  }

function getLaporanByNisn($nisn) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: /admin/laporan/index.php");
    exit;

}

function getAllData($nisn) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp and pembayaran.nisn = ? order by id_pembayaran desc limit 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function getLaporanById($id_pembayaran) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran WHERE id_pembayaran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_pembayaran]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: /admin/laporan/index.php");
    exit;

}


?>
