<?php
session_start();
if (!isset($_SESSION["eingeloggt"])) {
  header("Location: index3.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magnetstatus Verlauf</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://use.typekit.net/omi5rsz.css"> 
    <script src="history.js"></script> <!-- Einmaliger Verweis auf das Skript -->
  </head>
  <body>
    <div class="container">
      <div class="content-box">
        <h1>Verlauf der Magnet-Schalter</h1>
        <a class="back-button" href="index3.php">Zurück zur Live-Ansicht</a>
        <table id="historyTable">
          <thead>
            <tr>
              <th>Zeitpunkt</th>
              <th>Sensor</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <!-- Inhalte werden per JavaScript geladen -->
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
