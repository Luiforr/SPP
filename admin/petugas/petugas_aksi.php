<?php
include __DIR__ . '../../../database.php';


function getAllData($search = '', $limit = 10, $offset = 0) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM petugas
            WHERE petugas.level LIKE :search OR petugas.nama_petugas LIKE :search
            ORDER BY id_petugas DESC
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
    $sql = "SELECT COUNT(*) FROM petugas
            WHERE petugas.id_petugas LIKE :search OR petugas.nama_petugas LIKE :search";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}
function getPetugasById($id_petugas) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM petugas WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_petugas]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: /php-front/admin/petugas/index.php");
    exit;

}

function createPetugas(  $username, $nama_petugas,  $password, $level) {
    $conn = getDatabaseConnection();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO petugas (  username, nama_petugas, password, level) VALUES ( ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([  $username, $nama_petugas, $password, $level]);
    header("Location: /php-front/admin/petugas/index.php");
    exit;
}

function updatePetugas($username, $nama_petugas, $level, $id_petugas) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE petugas SET  username= ?, nama_petugas = ?, level = ? WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([ $username, $nama_petugas, $level, $id_petugas]);
    header("Location: /php-front/admin/petugas/index.php");
    exit;
}

function deletePetugas($id_petugas) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM petugas WHERE id_petugas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_petugas]);
    header("Location: /php-front/admin/petugas/index.php");
    exit;
}

?>