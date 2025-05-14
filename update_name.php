<?php
require_once("db_config.php");

header("Content-Type: application/json");

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "DB-Verbindung fehlgeschlagen."]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sensor_id = isset($_POST["sensor_id"]) ? (int)$_POST["sensor_id"] : null;
    $new_name = isset($_POST["new_name"]) ? trim($_POST["new_name"]) : "";

    if ($sensor_id !== null && $new_name !== "") {
        $stmt = $pdo->prepare("UPDATE namen SET name = :name WHERE id = :id");
        $stmt->execute([
            ":name" => $new_name,
            ":id" => $sensor_id
        ]);
        echo json_encode(["status" => "success", "message" => "Name erfolgreich geändert."]);
    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Ungültige Eingaben."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Nur POST erlaubt."]);
}
?>
