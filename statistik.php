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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        padding: 30px;
        max-width: 900px;
        margin: auto;
      }

      h1 {
        text-align: center;
        margin-bottom: 40px;
      }
      
      .stat-container {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 25px 30px;
        margin-bottom: 25px;
      }

      .stat-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
      }

      .stat-value {
        font-size: 18px;
        color: #333;
      }

      canvas {
        max-width: 100%;
        margin-top: 20px;
      }

      button {
        margin-top: 30px;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        background-color: #4caf50;
        color: white;
        font-size: 16px;
        cursor: pointer;
      }

      button:hover {
        background-color: #45a049;
      }
    </style>
  </head>
  <body>
    <h1>Statistiken der letzten 7 Tage</h1>

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
      <canvas id="heatmapChart" height="200"></canvas>
    </div>

    <button onclick="window.location.href='index3.php'">
      Zurück zur Übersicht
    </button>

    <script>
      async function fetchStats() {
        try {
          const response = await fetch("stats.php?from=statistik");
          const data = await response.json();

          const late = data.lateNightActivation;
          document.getElementById("lateNight").textContent =
            late && late.zeit
              ? `${late.name} um ${new Date(late.zeit).toLocaleTimeString()}`
              : "Keine späte Aktivierung gefunden.";

          const active = data.mostActiveSensor;
          document.getElementById("mostActive").textContent =
            active && active.total_active_seconds > 0
              ? `${active.name} – ${Math.floor(active.total_active_seconds / 60)} Minuten`
              : "Keine aktive Zeit gefunden.";

          const activations = data.mostActivations;
          document.getElementById("mostActivations").textContent =
            activations && activations.activation_count > 0
              ? `${activations.name} wurde ${activations.activation_count} mal aktiviert.`
              : "Keine Aktivierungen gefunden.";

          const hourly = data.hourlyHeatmap;
          const labels = [...Array(24).keys()].map(h => `${h}:00`);
          const sensorMap = {};

          hourly.forEach(entry => {
            const hour = parseInt(entry.stunde);
            const name = entry.name;
            const count = parseInt(entry.anzahl);

            if (!sensorMap[name]) {
              sensorMap[name] = new Array(24).fill(0);
            }
            sensorMap[name][hour] = count;
          });

          const datasets = Object.entries(sensorMap).map(([name, values], index) => ({
            label: name,
            data: values,
            backgroundColor: `hsl(${index * 100}, 70%, 60%)`
          }));

          const ctx = document.getElementById("heatmapChart").getContext("2d");
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels,
              datasets
            },
            options: {
              responsive: true,
              plugins: {
                tooltip: {
                  mode: 'index',
                  intersect: false
                }
              },
              scales: {
                x: {
                  stacked: true
                },
                y: {
                  stacked: true,
                  beginAtZero: true
                }
              }
            }
          });
        } catch (err) {
          console.error("Fehler beim Laden der Statistiken:", err);
          document.querySelectorAll(".stat-value").forEach(el => el.textContent = "Fehler beim Laden.");
        }
      }
      fetchStats();
    </script>
  </body>
</html>