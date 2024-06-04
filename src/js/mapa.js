if (document.querySelector("#mapa")) {
  const lat = -1.590884746567974;
  const ln = -78.99767876782497;
  const zoom = 16;

  const map = L.map("mapa").setView([lat, ln], zoom);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  L.marker([lat, ln])
    .addTo(map)
    .bindPopup(
      `<h2 class="mapa__heading">DevWebCamp</h2>
       <p class="mapa__texto">Guaranda, Ecuador</p>
    `
    )
    .openPopup();
}
