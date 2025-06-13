<section class="conten">

    <!-- Menú de navegación -->
    <div class="container mb-4">
        <div class="btn-group" role="group">
            <button class="btn btn-outline-primary" onclick="mostrarSeccion('seccionGeo')">API de Geolocalización</button>
            <button class="btn btn-outline-success" onclick="mostrarSeccion('seccionCanvas')">API de Dibujo</button>
        </div>
    </div>

    <!-- Sección de Geolocalización -->
    <div id="seccionGeo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">API de Geolocalización</h3>
                        </div>
                        <div class="card-body">
                            <p>Esta funcionalidad obtiene tu ubicación actual usando la API de Geolocalización del navegador.</p>

                            <button id="obtenerUbicacion" class="btn btn-primary">Obtener mi ubicación</button>

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
    </div>

    <!-- Sección de Canvas de dibujo -->
    <div id="seccionCanvas" style="display: none;">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">API de Dibujo en Canvas</h3>
                        </div>
                        <div class="card-body">
                            <p>Usa el mouse para dibujar sobre el lienzo. Puedes guardar tu dibujo como imagen JPG.</p>

                            <canvas id="canvasDibujo" width="800" height="400" style="border:1px solid #000;"></canvas>

                            <br /><br />
                            <button id="guardarDibujo" class="btn btn-success">Guardar dibujo en JPG</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para ambas APIs -->
    <script src="{{ asset('js/ErrorGeolizacion.min.js') }}" type="text/javascript"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Función para mostrar secciones
        function mostrarSeccion(id) {
            document.getElementById('seccionGeo').style.display = 'none';
            document.getElementById('seccionCanvas').style.display = 'none';
            document.getElementById(id).style.display = 'block';
        }

        // Geolocalización
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

        // Canvas de dibujo
        const canvas = document.getElementById("canvasDibujo");
        const ctx = canvas.getContext("2d");
        let dibujando = false;

        canvas.addEventListener("mousedown", () => dibujando = true);
        canvas.addEventListener("mouseup", () => dibujando = false);
        canvas.addEventListener("mouseout", () => dibujando = false);
        canvas.addEventListener("mousemove", function (event) {
            if (!dibujando) return;

            const rect = canvas.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            ctx.fillStyle = "black";
            ctx.beginPath();
            ctx.arc(x, y, 2, 0, Math.PI * 2);
            ctx.fill();
        });

        document.getElementById("guardarDibujo").addEventListener("click", function () {
            const enlace = document.createElement("a");
            enlace.download = "mi_dibujo.jpg";
            enlace.href = canvas.toDataURL("image/jpeg");
            enlace.click();
        });
    </script>
</section>
