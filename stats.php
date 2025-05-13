<?php
header('Content-Type: application/json');
require_once("db_config.php");

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit;
}

try {
    // 1. Späteste Aktivierung vor 06:00 Uhr in den letzten 7 Tagen
    $sqlLateNight = "
        SELECT s.sensor_id, n.name, s.zeit 
        FROM sensordata s
        LEFT JOIN namen n ON s.sensor_id = n.id
        WHERE s.wert = 1 
          AND s.zeit >= NOW() - INTERVAL 7 DAY
          AND TIME(s.zeit) < '06:00:00'
        ORDER BY s.zeit DESC
        LIMIT 1
    ";
    $stmtLate = $pdo->prepare($sqlLateNight);
    $stmtLate->execute();
    $lateNightResult = $stmtLate->fetch(PDO::FETCH_ASSOC);

    // 2. Sensor mit längster Aktivierungszeit (wert=1) in den letzten 7 Tagen
   $sqlActiveTime = "
    SELECT sensor_id, name, SUM(duration) AS total_active_seconds FROM (
        SELECT 
            s.sensor_id,
            n.name,
            s.zeit AS zeitpunkt,
            LEAD(s.zeit) OVER (PARTITION BY s.sensor_id ORDER BY s.zeit) AS next_time,
            s.wert,
            TIMESTAMPDIFF(SECOND, s.zeit, LEAD(s.zeit) OVER (PARTITION BY s.sensor_id ORDER BY s.zeit)) AS duration
        FROM sensordata s
        LEFT JOIN namen n ON s.sensor_id = n.id
        WHERE s.zeit >= NOW() - INTERVAL 7 DAY
    ) AS t
    WHERE wert = 1 AND duration IS NOT NULL
    GROUP BY sensor_id
    ORDER BY total_active_seconds DESC
    LIMIT 1
";
    $stmtActive = $pdo->prepare($sqlActiveTime);
    $stmtActive->execute();
    $activeResult = $stmtActive->fetch(PDO::FETCH_ASSOC);

    // 3. Meiste Umschaltungen in den letzten 7 Tagen
    $sqlToggleCounts = "
        SELECT name, sensor_id, COUNT(*) AS toggles FROM (
            SELECT 
                s.sensor_id,
                n.name,
                s.wert,
                LAG(s.wert) OVER (PARTITION BY s.sensor_id ORDER BY s.zeit) AS prev_wert
            FROM sensordata s
            LEFT JOIN namen n ON s.sensor_id = n.id
            WHERE s.zeit >= NOW() - INTERVAL 7 DAY
        ) AS t
        WHERE t.prev_wert IS NOT NULL AND t.wert != t.prev_wert
        GROUP BY sensor_id
        ORDER BY toggles DESC
        LIMIT 1
    ";
    $stmtToggles = $pdo->prepare($sqlToggleCounts);
    $stmtToggles->execute();
    $toggleResult = $stmtToggles->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "lateNightActivation" => $lateNightResult,
        "mostActiveSensor" => $activeResult,
        "mostToggles" => $toggleResult
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error", "details" => $e->getMessage()]);
}
?>
