<?php
include __DIR__ . '/../database.php';


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp 
    where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp 
     ORDER BY pembayaran.tgl_bayar DESC limit 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
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

function countSiswa() {
    $conn = getDatabaseConnection();
    $q = "SELECT COUNT(*) AS jumlah FROM siswa";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['jumlah'];
}



function deletePembayaran($id_pembayaran) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM pembayaran WHERE id_pembayaran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_pembayaran]);
    header("Location: /admin/laporan/index.php");
    exit;
}

function sumPembayaranBulanIni() {
    $conn = getDatabaseConnection();
    $bulan = date('m');
    $tahun = date('Y');

    $sql = "SELECT SUM(jumlah_bayar) AS total FROM pembayaran 
            WHERE MONTH(tgl_bayar) = ? AND YEAR(tgl_bayar) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$bulan, $tahun]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result['total'] ?? 0; // jika null, kembalikan 0
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
 