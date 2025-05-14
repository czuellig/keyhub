<?php
session_start();
$passwort = "8154";

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
    <title>KeyHub Status</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://use.typekit.net/omi5rsz.css" />
  </head>
  <body>
    <div class="container">
      <div class="content-box">
        <!-- <img src="/graphics/logo.png" alt="Logo" class="logo" /> -->
        <h1>Zuhause sind</h1>

        <div class="status-container" id="statusContainer">
          <p>Lade Daten...</p>
        </div>

        <a class="history-button" href="history2.php">Vergangene Einträge</a>
        <a class="statistics-button" href="statistik.php">Statistiken</a>

        <h2 style="margin-top: 40px;">Namen der Schalter ändern</h2>
        <form id="nameForm" class="name-form">
          <label for="sensor_id">Schalter auswählen:</label>
          <select name="sensor_id" id="sensor_id">
            <?php foreach ($sensorNames as $sensor): ?>
              <option value="<?= htmlspecialchars($sensor['id']) ?>">
                <?= htmlspecialchars($sensor['name']) ?> (ID <?= $sensor['id'] ?>)
              </option>
            <?php endforeach; ?>
          </select>
          <label for="new_name">Neuer Name:</label>
          <input type="text" name="new_name" id="new_name" required />
          <button type="submit">Namen ändern</button>
        </form>
        <p id="nameFeedback" class="feedback"></p>
      </div>
    </div>

    <script src="index3.js"></script>
  </body>
</html>

