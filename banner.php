<div class="container-fluid text-center my-3">
  <img src="./images/official_logo_@bc_transparent.png"
       class="logo m-auto"
       id="logo"
       alt="Logo Artful Batina Creative Studios">
  <h2 class="slogan text-center small mt-2 mb-2">La communication est la clé.</h2>
</div>
<div class="container-fluid m-auto mb-2">
  <h3 class="text-center text-primary">
    <strong>@rtful Batina Creative Studios est une agence de communication et de marketing numérique à Gradignan</strong>
  </h3>
</div>
<p class="creation_date text-center mb-2" aria-live="polite">
  <span id="realtime-clock"></span>
</p>
<hr>

<script>
function formatFrenchDate(date) {
  // Noms des mois en français
  const months = [
    'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
    'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
  ];
  const days = [
    'dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'
  ];
  const d = date.getDate().toString().padStart(2, '0');
  const m = months[date.getMonth()];
  const y = date.getFullYear();
  const dayName = days[date.getDay()];
  const h = date.getHours().toString().padStart(2, '0');
  const min = date.getMinutes().toString().padStart(2, '0');
  const s = date.getSeconds().toString().padStart(2, '0');
  return `Aujourd'hui le ${d} ${m} ${y}. Il est ${h}h${min}:${s}`;
}

function updateClock() {
  const now = new Date();
  document.getElementById('realtime-clock').textContent = formatFrenchDate(now);
}
setInterval(updateClock, 1000);
updateClock();
</script>
