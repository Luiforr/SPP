<?php
include __DIR__ . '../../../database.php';


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp";
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

function createLaporan($id_petugas, $nisn, $tanggal_bayar, $bulan_dibayar, $tahun_dibayar, $id_spp, $jumlah_bayar, $status) {
    $conn = getDatabaseConnection();
    $sql = "INSERT INTO pembayaran ( id_petugas, nisn, tanggal_bayar, bulan_dibayar,
     tahun_dibayar, id_spp, jumlah_bayar, status ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([ $id_petugas, $nisn, $tanggal_bayar, $bulan_dibayar, $tahun_dibayar, $id_spp, $jumlah_bayar, $status]);
    header("Location: /admin/laporan/index.php");
    exit;
}

// function updateSiswa($nis, $nama, $id_kelas) {
//     $conn = getDatabaseConnection();
//     $sql = "UPDATE siswa SET nis = ?, nama = ?, id_kelas = ? WHERE nisn = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([$nis, $nama, $id_kelas]);
//     header("Location: /admin/siswa.php");
//     exit;
// }


function deletePembayaran($id_pembayaran) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM pembayaran WHERE id_pembayaran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_pembayaran]);
    header("Location: /admin/laporan/index.php");
    exit;
}
?>
