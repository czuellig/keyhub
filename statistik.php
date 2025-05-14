<?php
session_start();
if (!isset($_SESSION["eingeloggt"])) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <title>Statistik der Schalter</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://use.typekit.net/omi5rsz.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="statistics.js"></script>
  </head>
  <body>
    <div class="container">
      
      <div class="content-box">
        <h1>Statistiken der letzten 7 Tage</h1>
        <a href="index3.php" class="back-button">Zurück zur Übersicht</a>

        <div class="stat-container">
          <div class="stat-title">🌙 Späteste Aktivierung vor 06:00 Uhr</div>
          <div id="lateNight" class="stat-value">Lade...</div>
        </div>

        <div class="stat-container">
          <div class="stat-title">⏱️ Längste Aktivität</div>
          <div id="mostActive" class="stat-value">Lade...</div>
        </div>

        <div class="stat-container">
          <div class="stat-title">🔁 Meiste Aktivierungen</div>
          <div id="mostActivations" class="stat-value">Lade...</div>
        </div>

        <div class="stat-container">
          <div class="stat-title">🔥 Aktivierungen nach Stunde (gestapelte Heatmap)</div>
          <canvas id="heatmapChart" height="100"></canvas>
        </div>

      </div>
    </div>
  </body>
</html>
