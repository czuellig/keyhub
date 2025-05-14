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
    <script defer src="history.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="content-box">
        <!-- <img src="graphics/logo.png" alt="Logo" class="logo" /> -->
        <a class="back-button" href="index3.php">Zurück zur Live-Ansicht</a>
        <h1>Vergangene Einträge</h1>

        <!-- Dynamische Historie wird hier reingerendert -->
        <div id="historyContainer">
          <!-- JS fügt hier history-entry-Blöcke ein -->
        </div>
      </div>
    </div>
  </body>
</html>

