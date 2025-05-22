<?php
include __DIR__ . '../../../database.php';
$conn = getDatabaseConnection();
$stmt = $conn->query("SELECT nisn, nama FROM siswa");
$siswaList = $stmt->fetchAll(PDO::FETCH_ASSOC);


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp order by id_pembayaran desc";
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
    $bulan_dibayar = $tanggal->format('m'); 
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

    header("Location: /php-front/admin/dashboard.php");
    exit;
}

?>
