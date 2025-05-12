<?php

/*************************************************************
 * Kap. 14 MC -> Dataviz 
 * unload.php
 **************************************************************/

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
    // SQL: Hole den letzten Eintrag für jeden sensor_id (1 bis 3)
    $sql = "
        SELECT s1.*
        FROM sensordata s1
        INNER JOIN (
            SELECT sensor_id, MAX(id) AS max_id
            FROM sensordata
            GROUP BY sensor_id
        ) s2 ON s1.sensor_id = s2.sensor_id AND s1.id = s2.max_id
        ORDER BY s1.sensor_id ASC
    ";

    $stmt = $pdo->prepare($sql);    
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error", "details" => $e->getMessage()]);
}