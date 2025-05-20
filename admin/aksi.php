<?php
include __DIR__ . '/../database.php';

function getAllDataSpp() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM spp ORDER BY id_spp desc LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}
function getAllDataKelas() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM kelas ORDER BY id_kelas desc LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function getAllDataSiswa() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM siswa,kelas where siswa.id_kelas = kelas.id_kelas  ORDER BY nisn desc LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function getAllDataPetugas() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM petugas ORDER BY id_petugas desc LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function getAllDataPembayaran() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp ORDER BY id_pembayaran desc LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function deleteSpp($id_spp) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM spp WHERE id_spp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_spp]);
    header("Location: dashboard.php");
    exit;
}

function deleteKelas($id_kelas) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM kelas WHERE id_kelas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_kelas]);
    header("Location: dashboard.php");
    exit;
}

function deleteSiswa($nisn) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM siswa WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    header("Location: dashboard.php");
    exit;
}

function deletePetugas($id_petugas) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM petugas WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_petugas]);
    header("Location: dashboard.php");
    exit;
}

function countSiswa() {
    $conn = getDatabaseConnection();
    $q = "SELECT COUNT(*) AS jumlah FROM siswa";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['jumlah'];
}


function countPetugas() {
    $conn = getDatabaseConnection();
    $q = "SELECT COUNT(*) AS jumlah FROM petugas";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['jumlah'];
}

function countKelas() {
    $conn = getDatabaseConnection();
    $q = "SELECT COUNT(*) AS jumlah FROM kelas";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['jumlah'];
}

?>