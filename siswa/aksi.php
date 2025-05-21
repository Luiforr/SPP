<?php
include __DIR__ . '/../database.php';

function getPembayaranSiswa($nisn, $bulan = null, $limit = 5, $offset = 0) {
    $conn = getDatabaseConnection();

    if ($bulan) {
        $sql = "SELECT * FROM pembayaran 
                JOIN siswa ON pembayaran.nisn = siswa.nisn
                JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
                WHERE pembayaran.nisn = ? AND DATE_FORMAT(pembayaran.tgl_bayar, '%Y-%m') = ?
                ORDER BY pembayaran.tgl_bayar DESC
                LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $nisn, PDO::PARAM_STR);
        $stmt->bindValue(2, $bulan, PDO::PARAM_STR);
        $stmt->bindValue(3, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(4, (int)$offset, PDO::PARAM_INT);
    } else {
        $sql = "SELECT * FROM pembayaran 
                JOIN siswa ON pembayaran.nisn = siswa.nisn
                JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
                WHERE pembayaran.nisn = ?
                ORDER BY pembayaran.tgl_bayar DESC
                LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $nisn, PDO::PARAM_STR);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function countPembayaranSiswa($nisn, $bulan = null) {
    $conn = getDatabaseConnection();
    if ($bulan) {
        $sql = "SELECT COUNT(*) FROM pembayaran 
                WHERE nisn = ? AND DATE_FORMAT(tgl_bayar, '%Y-%m') = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nisn, $bulan]);
    } else {
        $sql = "SELECT COUNT(*) FROM pembayaran WHERE nisn = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nisn]);
    }

    return $stmt->fetchColumn();
}

function getIdSiswaByNIS($nis) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM siswa,kelas,spp WHERE siswa.id_kelas = kelas.id_kelas and siswa.id_spp = spp.id_spp and  nis = ?");
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
    $sql = "SELECT * FROM pembayaran,petugas,siswa,spp 
    where pembayaran.id_petugas= petugas.id_petugas and pembayaran.nisn = siswa.nisn and pembayaran.id_spp = spp.id_spp and pembayaran.nisn = ?  
    ORDER BY pembayaran.tgl_bayar DESC limit 5";
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

function getTotalPembayaranByStatus($nisn) {
    $conn = getDatabaseConnection();

    $sql = "SELECT status, jumlah_bayar FROM pembayaran WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalSelesai = 0;
    $totalBelum = 0;

    foreach ($rows as $row) {
        $jumlah = (int) $row['jumlah_bayar'];
        $status = strtolower(trim($row['status']));

        if ($status === 'selesai') {
            $totalSelesai += $jumlah;
        } elseif ($status === 'belum') {
            $totalBelum += $jumlah;
        }
    }

    return [
        'total_selesai' => $totalSelesai,
        'total_belum' => $totalBelum
    ];
}

?>
