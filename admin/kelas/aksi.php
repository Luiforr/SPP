<?php
include __DIR__ . '../../../database.php';


function getAllData() {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM kelas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    exit;
}

function getKelasById($id_kelas) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM kelas WHERE id_kelas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_kelas]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: /php-front/admin/kelas/index.php");
    exit;

}

function createKelas($nama_kelas, $kompetensi_keahlian) {
    $conn = getDatabaseConnection();
    $sql = "INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nama_kelas, $kompetensi_keahlian]);
    header("Location: /php-front/admin/kelas/index.php");
    exit;
}

function updateKelas($id_kelas, $nama_kelas, $kompetensi_keahlian) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE kelas SET nama_kelas = ?, kompetensi_keahlian = ? WHERE id_kelas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nama_kelas, $kompetensi_keahlian, $id_kelas]);
    header("Location: /php-front/admin/kelas/index.php");
    exit;
}


function deleteKelas($id_kelas) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM kelas WHERE id_kelas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_kelas]);
    header("Location: /php-front/admin/kelas/index.php");
    exit;
}
?>
