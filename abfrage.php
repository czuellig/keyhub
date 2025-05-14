<?php

header('Content-Type: application/json');

// Datenbankverbindung einbinden
require_once("db_config.php");

###################################### connect to db
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options); 
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit;
}

try {
    // ALLE EINTRÄGE DER LETZTEN 30 TAGE MIT NAMEN
    $sqlAll = "
        SELECT 
            s.id,
            s.wert,
            s.zeit,
            s.sensor_id,
            n.name AS name
        FROM 
            sensordata s
        LEFT JOIN 
            namen n ON s.sensor_id = n.id
        WHERE 
            s.zeit >= NOW() - INTERVAL 30 DAY
        ORDER BY 
            s.zeit DESC
    ";
    $stmtAll = $pdo->prepare($sqlAll);
    $stmtAll->execute();
    $allData = $stmtAll->fetchAll(PDO::FETCH_ASSOC);

    // LETZTER EINTRAG PRO SENSOR_ID MIT NAMEN
    $sqlLatest = "
        SELECT 
            s1.id,
            s1.wert,
            s1.zeit,
            s1.sensor_id,
            n.name AS name
        FROM 
            sensordata s1
        INNER JOIN (
            SELECT sensor_id, MAX(id) AS max_id
            FROM sensordata
            GROUP BY sensor_id
        ) s2 ON s1.sensor_id = s2.sensor_id AND s1.id = s2.max_id
        LEFT JOIN 
            namen n ON s1.sensor_id = n.id
        ORDER BY 
            s1.sensor_id ASC
    ";
    $stmtLatest = $pdo->prepare($sqlLatest);
    $stmtLatest->execute();
    $latestData = $stmtLatest->fetchAll(PDO::FETCH_ASSOC);

    // JSON-Ausgabe
    echo json_encode([
        "latest" => $latestData,
        "history" => $allData
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error", "details" => $e->getMessage()]);
}