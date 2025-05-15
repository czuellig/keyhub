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
  <title>Schalternamen ändern</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://use.typekit.net/omi5rsz.css" />
</head>
<body>        
<div class="container">
      <div class="content-box">
        <img src="graphics/logo.png" alt="Logo" class="logo" />
        <a class="back-button" href="index.php">Zurück zur Live-Ansicht</a>
        <h1>Name ändern</h1>
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

  <script src="change_name.js"></script>
</body>
</html>
