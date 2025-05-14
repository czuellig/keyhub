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
  