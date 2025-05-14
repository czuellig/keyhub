async function loadHistory() {
  try {
    const response = await fetch("abfrage.php");
    const result = await response.json();
    const history = result.history;

    const container = document.getElementById("historyContainer");
    container.innerHTML = "";

    history.forEach((entry) => {
      const entryBox = document.createElement("div");
      entryBox.classList.add("history-entry");

      const header = document.createElement("div");
      header.classList.add("history-header");
      header.innerHTML = `<h3>${entry.zeit}</h3>`;

      const body = document.createElement("div");
      body.classList.add("history-body");

      const name = entry.name || `Sensor ${entry.sensor_id}`;
      const status =
        parseFloat(entry.wert) === 1.0 ? "Magnet erkannt" : "Kein Magnet";

      body.innerHTML = `<h2>${name} – ${status}</h2>`;

      entryBox.appendChild(header);
      entryBox.appendChild(body);

      container.appendChild(entryBox);
    });
  } catch (error) {
    console.error("Fehler beim Laden des Verlaufs:", error);
    const container = document.getElementById("historyContainer");
    container.innerHTML =
      "<p style='padding: 20px;'>Fehler beim Laden der Daten.</p>";
  }
}

loadHistory();
