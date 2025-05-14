async function fetchStatus() {
  try {
    const response = await fetch("abfrage.php");
    const result = await response.json();
    const data = result.latest;

    const container = document.getElementById("statusContainer");
    container.innerHTML = "";

    data.forEach((sensor) => {
      const wert = parseFloat(sensor.wert);
      const zeit = sensor.zeit;
      const name = sensor.name || `Sensor ${sensor.sensor_id}`;

      const box = document.createElement("div");
      box.className = "status-box " + (wert === 1.0 ? "status-on" : "status-off");

      box.innerHTML = `
        <div class="sensor-title">${name}</div>
        <div class="status-text">${wert === 1.0 ? "Magnet erkannt" : "Kein Magnet"}</div>
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

document.getElementById("nameForm").addEventListener("submit", async function (e) {
  e.preventDefault();
  const formData = new FormData(this);
  const response = await fetch("update_name.php", {
    method: "POST",
    body: formData
  });
  const result = await response.json();
  const feedback = document.getElementById("nameFeedback");
  feedback.textContent = result.message;
  feedback.style.color = result.status === "success" ? "green" : "red";
});
