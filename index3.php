<?php
session_start();
$passwort = "8154"; // HIER Passwort ändern

// Passwortprüfung
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
      <style>
        body {
          font-family: Arial, sans-serif;
          background-color: #f2f2f2;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          height: 100vh;
        }
        form {
          background-color: white;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        input[type="password"] {
          padding: 10px;
          font-size: 16px;
          margin-top: 10px;
          margin-bottom: 20px;
          width: 100%;
        }
        button {
          padding: 10px 20px;
          font-size: 16px;
        }
        .fehler {
          color: red;
        }
      </style>
    </head>
    <body>
      <form method="POST">
        <h2>Passwort eingeben</h2>
        <input type="password" name="pw" placeholder="Passwort" required />
        <br />
        <button type="submit">Einloggen</button>
        <?php if (isset($fehler)) echo "<p class='fehler'>$fehler</p>"; ?>
      </form>
    </body>
  </html>
  <?php
  exit;
}

// DB-Verbindung laden
require_once("db_config.php");
$pdo = new PDO($dsn, $db_user, $db_pass, $options);

// Aktuelle Namen abrufen
$stmt = $pdo->query("SELECT id, name FROM namen");
$sensorNames = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <title>Magnetstatus Anzeige – 3 Schalter</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
      }

      .status-container {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 40px;
      }

      .status-box {
        padding: 30px 50px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        transition: background-color 0.5s;
        width: 240px;
      }

      .status-on {
        background-color: #4caf50;
        color: white;
      }

      .status-off {
        background-color: #f44336;
        color: white;
      }

      .sensor-title {
        margin-bottom: 10px;
        font-size: 20px;
      }

      .time {
        margin-top: 10px;
        font-size: 14px;
        color: #666;
      }

      .history-button {
        margin: 10px;
        padding: 12px 24px;
        font-size: 16px;
        border: none;
        background-color: #333;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
      }

      .history-button:hover {
        background-color: #555;
      }
    </style>
  </head>
  <body>
    <h1>Status der drei Magnet-Schalter</h1>

    <div class="status-container" id="statusContainer">Lade Daten...</div>

    <button class="history-button" onclick="window.location.href='history2.php'">Verlauf anzeigen</button>
    <button class="history-button" onclick="window.location.href='statistik.php'">Statistiken anzeigen</button>

    <h2 style="margin-top: 50px;">Namen der Schalter ändern</h2>
    <form id="nameForm" style="margin-top: 20px; text-align: center;">
      <label for="sensor_id">Schalter auswählen:</label>
      <select name="sensor_id" id="sensor_id" style="margin-left: 10px; padding: 6px;">
        <?php foreach ($sensorNames as $sensor): ?>
          <option value="<?= htmlspecialchars($sensor['id']) ?>">
            <?= htmlspecialchars($sensor['name']) ?> (ID <?= $sensor['id'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
      <br /><br />
      <label for="new_name">Neuer Name:</label>
      <input type="text" name="new_name" id="new_name" style="padding: 6px; margin-left: 10px;" required />
      <br /><br />
      <button type="submit" style="padding: 10px 20px;">Namen ändern</button>
    </form>
    <p id="nameFeedback" style="color: green; margin-top: 10px;"></p>

    <script>
      async function fetchStatus() {
        try {
          const response = await fetch("abfrage.php");
          const result = await response.json();
          const data = result.latest;

          const container = document.getElementById("statusContainer");
          container.innerHTML = ""; // alte Inhalte entfernen

          data.forEach((sensor) => {
            const wert = parseFloat(sensor.wert);
            const zeit = sensor.zeit;
            const name = sensor.name || `Sensor ${sensor.sensor_id}`;

            const box = document.createElement("div");
            box.className =
              "status-box " + (wert === 1.0 ? "status-on" : "status-off");

            box.innerHTML = `
              <div class="sensor-title">${name}</div>
              <div class="status-text">${
                wert === 1.0 ? "Magnet erkannt" : "Kein Magnet"
              }</div>
              <div class="time">Letzte Messung: ${zeit}</div>
            `;

            container.appendChild(box);
          });
        } catch (error) {
          console.error("Fehler beim Laden:", error);
          document.getElementById("statusContainer").innerHTML =
            "<p>Fehler beim Laden der Daten.</p>";
        }
      }

      fetchStatus();
      setInterval(fetchStatus, 1000);

      // Formular zur Namensänderung
      document.getElementById("nameForm").addEventListener("submit", async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const response = await fetch("update_name.php", {
          method: "POST",
          body: formData
        });
        const result = await response.json();
        const feedback = document.getElementById("nameFeedback");
        feedback.style.color = result.status === "success" ? "green" : "red";
        feedback.textContent = result.message;
      });
    </script>
  </body>
</html>
