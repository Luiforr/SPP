<?php
include __DIR__ . '../../../database.php';

function getDataPetugasByUsername($username) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM petugas 
    WHERE username = ?");
    $stmt->execute([$username]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data ?: null;
  }

  function getGenerateByTanggal($bulan = null)
  {
      $conn = getDatabaseConnection();
  
      if ($bulan) {
          $sql = "SELECT * FROM pembayaran 
                  JOIN siswa ON pembayaran.nisn = siswa.nisn
                  JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
                  JOIN spp ON pembayaran.id_spp = spp.id_spp
                  WHERE DATE_FORMAT(pembayaran.tgl_bayar, '%Y-%m') = ?
                  ORDER BY pembayaran.tgl_bayar DESC";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$bulan]);
      } else {
          $sql = "SELECT * FROM pembayaran 
                  JOIN siswa ON pembayaran.nisn = siswa.nisn
                  JOIN spp ON pembayaran.id_spp = spp.id_spp
                  JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
                  ORDER BY pembayaran.tgl_bayar DESC";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
      }
  
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  

function getPembayaranByTanggal($bulan = null, $limit = 5, $offset = 0)
{
    $conn = getDatabaseConnection();

    if ($bulan) {
        $sql = "SELECT * FROM pembayaran 
                JOIN siswa ON pembayaran.nisn = siswa.nisn
                JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
                JOIN spp ON pembayaran.id_spp = spp.id_spp
                WHERE DATE_FORMAT(pembayaran.tgl_bayar, '%Y-%m') = ?
                ORDER BY pembayaran.tgl_bayar DESC
                LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $bulan, PDO::PARAM_STR);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
    } else {
        $sql = "SELECT * FROM pembayaran 
                JOIN siswa ON pembayaran.nisn = siswa.nisn
                JOIN spp ON pembayaran.id_spp = spp.id_spp
                JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
                ORDER BY pembayaran.tgl_bayar DESC
                LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$offset, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countPagePembayaran($bulan = null) {
    $conn = getDatabaseConnection();
    if ($bulan) {
        $sql = "SELECT COUNT(*) FROM pembayaran 
                WHERE DATE_FORMAT(tgl_bayar, '%Y-%m') = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$bulan]);
    } else {
        $sql = "SELECT COUNT(*) FROM pembayaran";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    return $stmt->fetchColumn(); 
}

function sumPembayaranSelesai($bulan = null)
{
    $conn = getDatabaseConnection();
    if ($bulan) {
        $sql = "SELECT SUM(jumlah_bayar) AS total FROM pembayaran 
                 WHERE DATE_FORMAT(tgl_bayar, '%Y-%m') = ?
                AND status = 'selesai'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$bulan]);
    } else {
        $sql = "SELECT SUM(jumlah_bayar) AS total FROM pembayaran 
       WHERE status = 'selesai'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
}

function sumPembayaranBelum($bulan = null)
{
    $conn = getDatabaseConnection();
    if ($bulan) {
        $sql = "SELECT SUM(jumlah_bayar) AS total FROM pembayaran 
            WHERE DATE_FORMAT(tgl_bayar, '%Y-%m') = ?
            AND status = 'belum'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$bulan]);
    } else {
        $sql = "SELECT SUM(jumlah_bayar) AS total FROM pembayaran 
            WHERE status = 'belum'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
}
