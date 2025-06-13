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
                            <button id="confirmarLlegada" style="display: none;">Confirmar llegada de vehículo</button>

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

    <!-- Enlaces para usar el mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
 
    <!-- Scripts para las APIs -->
    <script src="{{ asset("js/mostrarSeccionesApis.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset('js/ErrorGeolizacion.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset("js/CanvasDibujo.min.js") }}" type="text/javascript"></script>

   

</section>
