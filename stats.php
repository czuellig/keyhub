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

    // 2. Sensor mit längster Aktivierungszeit
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

    // 3. Meiste Aktivierungen (0 -> 1)
    $sqlActivations = "
        SELECT t.sensor_id, n.name, COUNT(*) AS activation_count
        FROM (
            SELECT 
                s.sensor_id,
                s.wert,
                LAG(s.wert) OVER (PARTITION BY s.sensor_id ORDER BY s.zeit) AS previous_wert
            FROM sensordata s
            WHERE s.zeit >= NOW() - INTERVAL 7 DAY
        ) t
        JOIN namen n ON t.sensor_id = n.id
        WHERE t.previous_wert = 0 AND t.wert = 1
        GROUP BY t.sensor_id, n.name
        ORDER BY activation_count DESC
        LIMIT 1
    ";
    $stmtActivations = $pdo->prepare($sqlActivations);
    $stmtActivations->execute();
    $activationResult = $stmtActivations->fetch(PDO::FETCH_ASSOC);

// 4. Aktivierungen pro Stunde und Sensor (für gestapelte Heatmap)
$sqlHourly = "
    SELECT 
        HOUR(s.zeit) AS stunde,
        s.sensor_id,
        n.name,
        COUNT(*) AS anzahl
    FROM (
        SELECT 
            sensor_id,
            zeit,
            wert,
            LAG(wert) OVER (PARTITION BY sensor_id ORDER BY zeit) AS vorher
        FROM sensordata
        WHERE zeit >= NOW() - INTERVAL 7 DAY
    ) s
    JOIN namen n ON s.sensor_id = n.id
    WHERE s.vorher = 0 AND s.wert = 1
    GROUP BY HOUR(s.zeit), s.sensor_id, n.name
    ORDER BY stunde ASC
";
$stmtHourly = $pdo->prepare($sqlHourly);
$stmtHourly->execute();
$hourlyData = $stmtHourly->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "lateNightActivation" => $lateNightResult,
        "mostActiveSensor" => $activeResult,
        "mostActivations" => $activationResult,
        "hourlyHeatmap" => $hourlyData
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error", "details" => $e->getMessage()]);
}
?>
