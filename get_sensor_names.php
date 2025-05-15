<?php
header('Content-Type: application/json');
require_once("db_config.php");

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options); 
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit;
}

try {
    $stmt = $pdo->query("SELECT id, name FROM namen ORDER BY id ASC");
    $sensors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "status" => "success",
        "sensors" => $sensors
    ]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Fehler beim Abrufen der Namen"]);
}