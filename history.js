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
  