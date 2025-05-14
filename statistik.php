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
        <a href="index3.php" class="back-button">Zurück zur Übersicht</a>
        <h1>Statistiken</h1>
        <h6>Der letzten sieben Tage.</h6>

        <!-- Nachtschwärmer -->
        <div class="stats">
          <div class="nachtschwaermer-header">
            <h4>Nachtschwärmer 🌙</h4>
          </div>
          <div class="nachtschwaermer-body">
            <h2 id="lateNight">Lade...</h2>
          </div>
        </div>
        <h5>... kam vor 06:00 Uhr nach Hause.</h5>

        <!-- Couchpotato -->
        <div class="stats">
          <div class="couchpotato-header">
            <h4>Couchpotato 🛁</h4>
          </div>
          <div class="couchpotato-body">
            <h2 id="mostActive">Lade...</h2>
          </div>
        </div>
        <h5>... verbrachte am längsten Zeit zuhause.</h5>

        <!-- Pendler:in -->
        <div class="stats">
          <div class="pendler-header">
            <h4>Pendler:in 🚂</h4>
          </div>
          <div class="pendler-body">
            <h2 id="mostActivations">Lade...</h2>
          </div>
        </div>
        <h5>... hatte die meisten Aktivierungen.</h5>

        <!-- Heatmap -->
        <div class="stat-container">
          <h1>Aktivierungen nach Stunde</h1>
          <canvas id="heatmapChart"></canvas>
        </div>

      </div>
    </div>
  </body>
</html>

