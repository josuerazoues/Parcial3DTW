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
                        <p>Esta funcionalidad obtiene tu ubicación actual usando la API de Geolocalización del navegador.</p>
                        
                        <button id="obtenerUbicacion" class="btn btn-primary">
                            Obtener mi ubicación
                        </button>
                        
                        <div id="resultado" class="mt-3">
                            <p><strong>Latitud:</strong> <span id="latitud">No disponible</span></p>
                            <p><strong>Longitud:</strong> <span id="longitud">No disponible</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/ErrorGeolizacion.min.js') }}" type="text/javascript"></script>
</section>