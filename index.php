<?php
session_start();

require_once("db_config.php");
// Passwort für den Zugang zur Website

if (!isset($_SESSION["eingeloggt"])) {
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pw"])) {
    if ($_POST["pw"] === $passwort) {
      $_SESSION["eingeloggt"] = true;
      header("Location: index.php");
      exit;
    } else {
      $fehler = "Falsches Passwort.";
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="de">
    <head>
    <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Passwort erforderlich</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/omi5rsz.css">

    </head>
    <body>
      <div class="container">
        <div class="content-box">
          <h1>Passwort eingeben</h1>
          <form method="POST">
            <input type="password" name="pw" placeholder="Passwort" required />
            <button type="submit">Einloggen</button>
            <?php if (isset($fehler)) echo "<p class='fehler'>$fehler</p>"; ?>
          </form>
        </div>
      </div>
    </body>
  </html>
  <?php
  exit;
}

require_once("db_config.php");
$pdo = new PDO($dsn, $db_user, $db_pass, $options);
$stmt = $pdo->query("SELECT id, name FROM namen");
$sensorNames = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KeyHub Status</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://use.typekit.net/omi5rsz.css" />
  </head>
  <body>
    <div class="container">
      <div class="content-box">
        <img src="/graphics/logo.png" alt="Logo" class="logo" />
        <h1>Zuhause sind</h1>
        <div class="status-container" id="statusContainer">
          <p>Lade Daten...</p>
        </div>
        <a class="history-button" href="history.php">Vergangene Einträge</a>
        <a class="statistics-button" href="statistics.php">Statistiken</a>
        <a class="change_name-button" href="change_name.php">Name ändern</a>
      </div>
    </div>
    <script src="live_script.js"></script>
  </body>
</html>

