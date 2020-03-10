const token =
  "pk.eyJ1Ijoid2VsY29tZXdlcmtzdGF0dCIsImEiOiJjazcweG5pNm4wMTZrM2Vta20zbHQ0d2ZkIn0.1xbaL5gzWZQC-v-sw5NIhA";
const poiPos = [10.0220136, 53.5797959];
mapboxgl.accessToken = token;
const map = new mapboxgl.Map({
  container: "map",
  style: "mapbox://styles/mapbox/streets-v11",
  center: poiPos,
  zoom: 14
});

map.addControl(new mapboxgl.NavigationControl({ showCompass: false }));

const el = document.createElement("div");
el.className = "marker";

const mapIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>`;

const overlayContainer = document.createElement("div");
overlayContainer.className = "overlay";
overlayContainer.innerHTML = `\
<div>\
<h3 class="hideOnMobile">Welcome Werkstatt e.&nbspV.</h3>\
<p class="hideOnMobile">Bachstr.&nbsp98, 22083&nbspHamburg</p>\
<a href="https://g.page/WelcomeWerkstatt?share">Größere Karte ansehen</a>\
</div>\
<div class="mapIcon hideOnMobile">\
<a href="https://www.google.de/maps/dir//Welcome+Werkstatt+e.+V.,+Bachstraße+98,+22083+Hamburg/@53.5797132,10.0198713,17z/">\
${mapIcon}\
<div>Route</div>\
</a>\
</div>\
`;

const mapContainer = document.querySelector("#map");

mapContainer.appendChild(overlayContainer);

const marker = new mapboxgl.Marker({ element: el, anchor: "bottom" })
  .setLngLat(poiPos)
  .addTo(map);
