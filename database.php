<?php


function getDatabaseConnection() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "spp";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("Koneksi gagal: " . $e->getMessage());
    }
}
?>
