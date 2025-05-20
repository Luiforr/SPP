<?php
include __DIR__ . '/../../database.php';
$conn = getDatabaseConnection();
$stmt = $conn->query("SELECT id_kelas, nama_kelas FROM kelas");
$kelasList = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = getDatabaseConnection();
$stmt = $conn->query("SELECT id_spp, tahun FROM spp");
$sppList = $stmt->fetchAll(PDO::FETCH_ASSOC);



function getAllData($search = '', $limit = 10, $offset = 0) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM siswa
            JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            JOIN spp ON siswa.id_spp = spp.id_spp
            WHERE siswa.nis LIKE :search OR siswa.nama LIKE :search
            ORDER BY nisn DESC
            LIMIT :limit OFFSET :offset";

    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllData($search = '') {
    $conn = getDatabaseConnection();
    $sql = "SELECT COUNT(*) FROM siswa
            WHERE siswa.nis LIKE :search OR siswa.nama LIKE :search";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}


function getSiswaById($nisn) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM siswa,spp,kelas where siswa.id_spp = spp.id_spp and siswa.id_kelas = kelas.id_kelas and nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;

}

function createSiswa($nisn, $nis, $nama, $id_kelas, $id_spp, $password) {
    $conn = getDatabaseConnection();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO siswa (nisn, nis, nama, id_kelas, id_spp, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn, $nis, $nama, $id_kelas, $id_spp, $password]);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;
}
function updateSiswa( $nis, $nama, $id_kelas, $id_spp, $nisn) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE siswa SET nis = ?, nama = ?, id_kelas = ?, id_spp = ? WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([ $nis, $nama, $id_kelas, $id_spp, $nisn]);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;
}



function deleteSiswa($nisn) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM siswa WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nisn]);
    header("Location:  /php-front/admin/siswa/index.php");
    exit;
}
?>
