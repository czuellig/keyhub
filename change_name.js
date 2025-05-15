// Sensor-Namen ins Dropdown laden
async function loadSensorNames() {
  try {
    const response = await fetch("get_sensor_names.php");
    const result = await response.json();

    if (result.status === "success") {
      const select = document.getElementById("sensor_id");
      result.sensors.forEach(sensor => {
        const option = document.createElement("option");
        option.value = sensor.id;
        option.textContent = `${sensor.name} (ID ${sensor.id})`;
        select.appendChild(option);
      });
    } else {
      console.error("Fehler beim Laden der Sensor-Namen:", result.message);
    }
  } catch (error) {
    console.error("Verbindungsfehler:", error);
  }
}

loadSensorNames();

// Formular abschicken
document.getElementById("nameForm").addEventListener("submit", async function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  try {
    const response = await fetch("update_name.php", {
      method: "POST",
      body: formData
    });

    const result = await response.json();
    const feedback = document.getElementById("nameFeedback");
    feedback.textContent = result.message;
    feedback.style.color = result.status === "success" ? "green" : "red";
  } catch (error) {
    console.error("Fehler beim Senden:", error);
  }
});