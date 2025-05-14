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
    <title>Magnetstatus Verlauf</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        padding: 40px;
        max-width: 800px;
        margin: 0 auto;
      }

      h1 {
        text-align: center;
        margin-bottom: 30px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }

      .magnet-on {
        color: green;
        font-weight: bold;
      }

      .magnet-off {
        color: red;
        font-weight: bold;
      }

      .back-button {
        display: block;
        margin: 30px auto 0;
        padding: 10px 20px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s;
      }

      .back-button:hover {
        background-color: #555;
      }
    </style>
  </head>
  <body>
    <h1>Verlauf der Magnet-Schalter</h1>

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

    <a class="back-button" href="index3.php">Zurück zur Live-Ansicht</a>

    <script>
      async function loadHistory() {
        try {
          const response = await fetch("abfrage.php");
          const result = await response.json();
          const history = result.history;

          const tbody = document
            .getElementById("historyTable")
            .querySelector("tbody");
          tbody.innerHTML = "";

          history.forEach((entry) => {
            const row = document.createElement("tr");

            const zeitCell = document.createElement("td");
            zeitCell.textContent = entry.zeit;

            const nameCell = document.createElement("td");
            nameCell.textContent = entry.name || `Sensor ${entry.sensor_id}`;

            const statusCell = document.createElement("td");
            const status =
              parseFloat(entry.wert) === 1.0 ? "Magnet erkannt" : "Kein Magnet";
            statusCell.textContent = status;
            statusCell.className =
              parseFloat(entry.wert) === 1.0 ? "magnet-on" : "magnet-off";

            row.appendChild(zeitCell);
            row.appendChild(nameCell);
            row.appendChild(statusCell);

            tbody.appendChild(row);
          });
        } catch (error) {
          console.error("Fehler beim Laden des Verlaufs:", error);
          const tbody = document
            .getElementById("historyTable")
            .querySelector("tbody");
          tbody.innerHTML =
            "<tr><td colspan='3'>Fehler beim Laden der Daten.</td></tr>";
        }
      }

      loadHistory();
    </script>
  </body>
</html>
