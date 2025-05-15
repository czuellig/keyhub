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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Statistik der Schalter</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://use.typekit.net/omi5rsz.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="statistics.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="content-box">
        <img src="/graphics/logo.png" alt="Logo" class="logo" />
        <a href="index.php" class="back-button">Zurück zur Live-Ansicht</a>
        <h1>Statistiken</h1>
        <h6>Der letzten sieben Tage.</h6>

<!-- PENDLER:IN -->
<div class="stats">
  <div class="nachtschwaermer-header"></div>
  <div class="nachtschwaermer-body"></div>
</div>
<h6 id="nachtschwaermer-detail" class="stat-detail"></h6>

<!-- COUCHPOTATO -->
<div class="stats">
  <div class="couchpotato-header"></div>
  <div class="couchpotato-body"></div>
</div>
<h6 id="couchpotato-detail" class="stat-detail"></h6>

<!-- NACHTSCHWÄRMER -->
<div class="stats">
  <div class="pendler-header"></div>
  <div class="pendler-body"></div>
</div>
<h6 id="pendler-detail" class="stat-detail"></h6>


        <!-- Heatmap -->
        <div class="stat-container">
          <h1>Aktivierungen nach Stunde</h1>
          <canvas id="heatmapChart"></canvas>
        </div>

      </div>
    </div>
  </body>
</html>

