async function fetchStats() {
  try {
    const response = await fetch("stats_unload.php?from=statistics");
    const data = await response.json();

    // Pendler:in (nachtschwaermer-Box verwenden)
    const activations = data.mostActivations;
    if (activations && activations.activation_count > 0) {
      document.querySelector(".nachtschwaermer-header").textContent = "Pendler:in 🚂";
      document.querySelector(".nachtschwaermer-body").textContent =
        `${activations.name} hatte die meisten Aktivierungen.`;
      document.getElementById("nachtschwaermer-detail").textContent =
        `${activations.activation_count} Mal wurde der Schalter betätigt.`;
    } else {
      document.querySelector(".nachtschwaermer-header").textContent = "Pendler:in 🚂";
      document.querySelector(".nachtschwaermer-body").textContent = "Keine Aktivierungen gefunden.";
      document.getElementById("nachtschwaermer-detail").textContent = "";
    }

    // Couchpotato
    const active = data.mostActiveSensor;
    if (active && active.total_active_seconds > 0) {
      document.querySelector(".couchpotato-header").textContent = "Couchpotato 🛁";
      document.querySelector(".couchpotato-body").textContent =
        `${active.name} verbrachte am längsten Zeit zuhause.`;
      document.getElementById("couchpotato-detail").textContent =
        `Insgesamt ${Math.floor(active.total_active_seconds / 60)} Minuten.`;
    } else {
      document.querySelector(".couchpotato-header").textContent = "Couchpotato 🛁";
      document.querySelector(".couchpotato-body").textContent = "Keine Daten gefunden.";
      document.getElementById("couchpotato-detail").textContent = "";
    }

    // Nachtschwärmer
    const late = data.lateNightActivation;
    if (late && late.zeit) {
      document.querySelector(".pendler-header").textContent = "Nachtschwärmer 🌙";
      document.querySelector(".pendler-body").textContent =
        `${late.name} kam spät nach Hause.`;
      document.getElementById("pendler-detail").textContent =
        `Letzte Aktivierung um ${new Date(late.zeit).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}.`;
    } else {
      document.querySelector(".pendler-header").textContent = "Nachtschwärmer 🌙";
      document.querySelector(".pendler-body").textContent = "Keine späte Aktivierung gefunden.";
      document.getElementById("pendler-detail").textContent = "";
    }

    // Heatmap
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
          x: { stacked: true },
          y: { stacked: true, beginAtZero: true }
        }
      }
    });

  } catch (err) {
    console.error("Fehler beim Laden der Statistiken:", err);
  }
}

fetchStats();

  