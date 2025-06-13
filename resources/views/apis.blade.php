@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

@section('content')
<section class="conten">

    <!-- Menú de navegación -->
    <div class="container mb-4 mt-5 d-flex justify-content-center">
        <div class="btn-group" role="group">
            <button class="btn btn-outline-primary" onclick="mostrarSeccion('seccionGeo')">API de Geolocalización</button>
            <button class="btn btn-outline-success" onclick="mostrarSeccion('seccionCanvas')">API de Dibujo</button>
            <button class="btn btn-outline-danger" onclick="mostrarSeccion('seccionVideo')">API de Video</button>
        </div>
    </div>

    <!-- Sección de Geolocalización -->
    <div id="seccionGeo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            <h3 class="m-0">API de Geolocalización</h3>
                        </div>
                        <div class="card-body">
                            <p>Esta funcionalidad obtiene tu ubicación actual usando la API de Geolocalización del navegador.</p>
                            <button id="obtenerUbicacion" class="btn btn-primary">Obtener mi ubicación</button>
                            <button id="confirmarLlegada" style="display: none;" class="btn btn-warning mt-2">Confirmar llegada de vehículo</button>
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
                        <div class="card-header bg-success text-white text-center">
                            <h3 class="m-0">API de Dibujo en Canvas</h3>
                        </div>
                        <div class="card-body text-center" style="font-family: Calibri; font-size: 18px;">
                            <p class="text-start">
                                Elige una herramienta y color para dibujar.<br>
                                - Arrastra el mouse para definir el tamaño.<br>
                                - Haz clic sobre una figura para moverla.<br>
                                - Usa su esquina inferior derecha para cambiar su tamaño.<br>
                                - Puedes borrar, deshacer o guardar el dibujo en JPG.
                            </p>
                            <div class="container mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-start d-flex align-items-center gap-2 mb-2 mb-md-0">
                                        <label for="colorPicker" class="me-2">Color:</label>
                                        <input type="color" id="colorPicker" class="form-control form-control-color" value="#000000" style="width: 50px; height: 35px;">
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center gap-2 mb-2 mb-md-0">
                                        <label for="herramienta" class="me-2">Herramienta:</label>
                                        <select id="herramienta" class="form-select" style="width: 160px;">
                                            <option value="pincel">Pincel</option>
                                            <option value="rect">Rectángulo</option>
                                            <option value="circle">Círculo</option>
                                            <option value="triangle">Triángulo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 d-flex justify-content-end gap-3">
                                        <button id="borrarLienzo" class="btn btn-danger" style="min-width: 150px;">Borrar lienzo</button>
                                        <button id="deshacer" class="btn btn-secondary" style="min-width: 150px;">Deshacer</button>
                                    </div>
                                </div>
                            </div>
                                <canvas id="canvasDibujo" width="800" height="400" style="border:1px solid #000;"></canvas>
                            <br><br>
                                <button id="guardarDibujo" class="btn btn-success mt-3">Guardar dibujo en JPG</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de API de Video -->
        <div id="seccionVideo" style="display: none;">
            <div class="container-fluid mt-4">
                <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                             <div class="card-header bg-danger text-white text-center">
                             <h3 class="m-0">API de Video</h3>
                              </div>
                             <div class="card-body text-center">
                              <p>Esta funcionalidad accede a tu cámara, permite tomar fotos y grabar videos.</p>

                         <!-- Cámara en vivo -->
                        <video id="video" width="640" height="480" autoplay muted style="border: 1px solid #000;"></video>
                        <br><br>

                        <!-- Botones de acción -->
                        <div style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <button id="capturarFoto" class="btn btn-danger" style="margin-right: 10px;">Tomar Foto</button>
                            <button id="reintentarFoto" class="btn btn-secondary" style="margin-right: 10px;">Reintentar Foto</button>
                            <button id="iniciarGrabacion" class="btn btn-success" style="margin-right: 10px;">Grabar Video</button>
                             <button id="detenerGrabacion" class="btn btn-warning" disabled>Detener Grabación</button>
                        </div>

                        <canvas id="fotoCanvas" width="640" height="480" class="mt-4" style="border: 1px solid #000;"></canvas>
                        <br>
                        <a id="descargarFoto" class="btn btn-dark mt-2" style="display: none;" download="captura.jpg">Descargar Foto</a>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <video id="videoGrabado" controls style="display:none; border:1px solid #000;" width="640" height="480" class="mt-4"></video>
                        </div>
                        <div class="d-flex justify-content-center">
                             <a id="descargarVideo" class="btn btn-primary mt-2" style="display: none;">Descargar Video</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</section>
@endsection

@section('archivos-js')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/mostrarSeccionesApis.min.js') }}"></script>
    <script src="{{ asset('js/ErrorGeolizacion.min.js') }}"></script>
    <script src="{{ asset('js/CanvasDibujo.min.js') }}"></script>
    <script src="{{ asset('js/VideoCamara.min.js') }}"></script>
@endsection
