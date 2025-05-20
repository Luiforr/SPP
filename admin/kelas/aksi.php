<?php
include __DIR__ . '../../../database.php';


function getAllData($search = '', $limit = 10, $offset = 0) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM kelas
            WHERE kelas.kompetensi_keahlian LIKE :search OR kelas.nama_kelas LIKE :search
            ORDER BY kompetensi_keahlian DESC
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
    $sql = "SELECT COUNT(*) FROM kelas
        WHERE kelas.id_kelas LIKE :search OR kelas.nama_kelas LIKE :search";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
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
