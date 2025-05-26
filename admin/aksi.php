<?php
include __DIR__ . '/../database.php';

function getDataPetugasId($id_petugas)
{
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM petugas
            WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_petugas]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data ?: null;
}



function getAllDataSiswa($limit = 5, $page = 1)
{
    $conn = getDatabaseConnection();
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM siswa
            JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            ORDER BY nisn DESC LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllSiswa()
{
    $conn = getDatabaseConnection();
    return $conn->query("SELECT COUNT(*) AS total FROM siswa")->fetch(PDO::FETCH_ASSOC)['total'];
}


function getAllDataPetugas($limit = 5, $page = 1)
{
    $conn = getDatabaseConnection();
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM petugas ORDER BY id_petugas DESC LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllPetugas()
{
    $conn = getDatabaseConnection();
    return $conn->query("SELECT COUNT(*) AS total FROM petugas")->fetch(PDO::FETCH_ASSOC)['total'];
}

function getAllDataKelas($limit = 5, $page = 1)
{
    $conn = getDatabaseConnection();
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM kelas ORDER BY id_kelas DESC LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllKelas()
{
    $conn = getDatabaseConnection();
    return $conn->query("SELECT COUNT(*) AS total FROM kelas")->fetch(PDO::FETCH_ASSOC)['total'];
}


function getAllDataSpp($limit = 5, $page = 1)
{
    $conn = getDatabaseConnection();
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM spp ORDER BY id_spp DESC LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllSpp()
{
    $conn = getDatabaseConnection();
    return $conn->query("SELECT COUNT(*) AS total FROM spp")->fetch(PDO::FETCH_ASSOC)['total'];
}
function getAllDataPembayaran($limit = 5, $page = 1)
{
    $conn = getDatabaseConnection();
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM pembayaran
            JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
            JOIN siswa ON pembayaran.nisn = siswa.nisn
            JOIN spp ON pembayaran.id_spp = spp.id_spp
            ORDER BY pembayaran.tgl_bayar DESC
            LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllPembayaran()
{
    $conn = getDatabaseConnection();
    return $conn->query("SELECT COUNT(*) AS total FROM pembayaran")->fetch(PDO::FETCH_ASSOC)['total'];
}

function deleteSpp($id_spp)
{
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM spp WHERE id_spp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_spp]);
    header("Location: dashboard.php");
    exit;
}

function deleteKelas($id_kelas)
{
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM kelas WHERE id_kelas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_kelas]);
    header("Location: dashboard.php");
    exit;
}

function deleteSiswa($nisn)
{
    $conn = getDatabaseConnection();
    $stmt1 = $conn->prepare("DELETE FROM pembayaran WHERE nisn = :nisn");
    $stmt1->execute([':nisn' => $nisn]);
    $stmt2 = $conn->prepare("DELETE FROM siswa WHERE nisn = :nisn");
    $stmt2->execute([':nisn' => $nisn]);
}

function deletePetugas($id_petugas)
{
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM petugas WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_petugas]);
    header("Location: dashboard.php");
    exit;
}

function countSiswa()
{
    $conn = getDatabaseConnection();
    $q = "SELECT COUNT(*) AS jumlah FROM siswa";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['jumlah'];
}


function countPetugas()
{
    $conn = getDatabaseConnection();
    $q = "SELECT COUNT(*) AS jumlah FROM petugas";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['jumlah'];
}

function countKelas()
{
    $conn = getDatabaseConnection();
    $q = "SELECT COUNT(*) AS jumlah FROM kelas";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['jumlah'];
}

function sumPembayaranBulanIni()
{
    $conn = getDatabaseConnection();
    $bulan = date('m');
    $tahun = date('Y');

    $sql = "SELECT SUM(jumlah_bayar) AS total FROM pembayaran 
            WHERE MONTH(tgl_bayar) = ? AND YEAR(tgl_bayar) = ?
            AND status = 'selesai'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$bulan, $tahun]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'] ?? 0; // jika null, kembalikan 0
}
