<?php
include __DIR__ . '../../../database.php';


function getAllData($search = '', $limit = 10, $offset = 0) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM spp
            WHERE spp.id_spp LIKE :search OR spp.tahun LIKE :search
            ORDER BY tahun DESC
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
    $sql = "SELECT COUNT(*) FROM spp
        WHERE spp.id_spp LIKE :search OR spp.tahun LIKE :search";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}


function getSppById($id_spp) {
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM spp WHERE id_spp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_spp]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: /php-front/admin/spp/index.php");
    exit;

}

function createSpp($tahun, $nominal) {
    $conn = getDatabaseConnection();
    $sql = "INSERT INTO spp (tahun, nominal) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$tahun, $nominal]);
    header("Location: /php-front/admin/spp/index.php");
    exit;
}

function updateSpp( $id_spp, $tahun, $nominal) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE spp SET tahun = ?, nominal = ? WHERE id_spp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$tahun, $nominal, $id_spp]);
    header("Location: /php-front/admin/spp/index.php");
    exit;
}



function deleteSpp($id_spp) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM spp WHERE id_spp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_spp]);
    header("Location: /php-front/admin/spp/index.php");
    exit;
}
?>
