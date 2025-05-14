<?php
include __DIR__ . '../../../database.php';
$conn = getDatabaseConnection();
$stmt = $conn->query("SELECT nisn, nama FROM siswa");
$siswaList = $stmt->fetchAll(PDO::FETCH_ASSOC);


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}


function createLaporan($nisn, $tgl_bayar, $jumlah_bayar, $status) {

    $conn = getDatabaseConnection();

    if (!isset($_SESSION['id_petugas'])) {
        die("ID Petugas tidak ditemukan di session.");
    }
    $id_petugas = $_SESSION['id_petugas'];

    $stmtSpp = $conn->prepare("SELECT id_spp FROM siswa WHERE nisn = ?");
    $stmtSpp->execute([$nisn]);
    $sppData = $stmtSpp->fetch(PDO::FETCH_ASSOC);

    if (!$sppData) {
        die("Data SPP tidak ditemukan untuk NISN tersebut.");
    }

    $id_spp = $sppData['id_spp'];

    $tanggal = new DateTime($tgl_bayar);
    $bulan_dibayar = $tanggal->format('F'); 
    $tahun_dibayar = $tanggal->format('Y');

    $sql = "INSERT INTO pembayaran 
        (id_petugas, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $id_petugas,
        $nisn,
        $tgl_bayar,
        $bulan_dibayar,
        $tahun_dibayar,
        $id_spp,
        $jumlah_bayar,
        $status
    ]);

    header("Location: /petugas/laporan/index.php");
    exit;
}



// function createLaporan($id_petugas, $nisn, $tanggal_bayar, $bulan_dibayar, $tahun_dibayar, $id_spp, $jumlah_bayar, $status) {
//     $conn = getDatabaseConnection();
//     $sql = "INSERT INTO pembayaran ( id_petugas, nisn, tanggal_bayar, bulan_dibayar,
//      tahun_dibayar, id_spp, jumlah_bayar, status ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([ $id_petugas, $nisn, $tanggal_bayar, $bulan_dibayar, $tahun_dibayar, $id_spp, $jumlah_bayar, $status]);
//     header("Location: /petugas/laporan/index.php");
//     exit;
// }

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
