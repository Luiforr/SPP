<?php
include __DIR__ . '../../../database.php';


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp order by id_pembayaran desc";
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



function deletePembayaran($id_pembayaran) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM pembayaran WHERE id_pembayaran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_pembayaran]);
    header("Location: /admin/laporan/index.php");
    exit;
}
?>
