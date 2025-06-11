<section class="conten">
    <!-- Espacio para la Geolocalización -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">API de Geolocalización</h3>
                    </div>
                    <div class="card-body">
                        <p>Esta funcionalidad obtiene tu ubicación actual usando la API de Geolocalización del
                            navegador.</p>

                        <button id="obtenerUbicacion" class="btn btn-primary">
                            Obtener mi ubicación
                        </button>

                        <div id="resultado" class="mt-3">
                            <p><strong>Latitud:</strong> <span id="latitud">No disponible</span></p>
                            <p><strong>Longitud:</strong> <span id="longitud">No disponible</span></p>
                        </div>

                        <div id="mapa" style="height: 400px; margin-top: 20px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/ErrorGeolizacion.min.js') }}" type="text/javascript"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        var mapa = L.map('mapa').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(mapa);

        var marcador;

        document.getElementById('obtenerUbicacion').addEventListener('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    document.getElementById('latitud').textContent = lat;
                    document.getElementById('longitud').textContent = lon;

                    if (marcador) {
                        mapa.removeLayer(marcador);
                    }

                    marcador = L.marker([lat, lon]).addTo(mapa)
                        .bindPopup('Tu ubicación actual.').openPopup();

                    mapa.setView([lat, lon], 13);

                }, function (error) {
                    console.error(error);
                    alert("Error al obtener la ubicación.");
                });
            } else {
                alert("La geolocalización no es compatible con este navegador.");
            }
        });
    </script>
</section>