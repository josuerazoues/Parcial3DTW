<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/login/bootstrap.min.css') }}">

    <!-- icono del sistema -->
    <link href="{{ asset('images/icono-sistema.png') }}" rel="icon">
    <!-- libreria -->
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />

    <!-- estilo de toast -->
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <!-- estilo de sweet -->
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">

    <!-- estilo del login -->
    <link href="{{ asset('css/InterfazLogin.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="floating-buttons">
        <img src="{{ asset('images/compas.png') }}" class="pos-1">
        <img src="{{ asset('images/laptop.png') }}" class="pos-2">
        <img src="{{ asset('images/mochila.png') }}" class="pos-3">
        <img src="{{ asset('images/pizarra.png') }}" class="pos-4">
        <img src="{{ asset('images/abc.png') }}" class="pos-5">
        <img src="{{ asset('images/ciencias.png') }}" class="pos-6">
        <img src="{{ asset('images/mundo.png') }}" class="pos-7">
        <img src="{{ asset('images/medalla.png') }}" class="pos-8">
        <img src="{{ asset('images/goma.png') }}" class="pos-9">
        <img src="{{ asset('images/libro.png') }}" class="pos-10">
        <img src="{{ asset('images/cuaderno.png') }}" class="pos-11">
        <img src="{{ asset('images/regla.png') }}" class="pos-12">
        <img src="{{ asset('images/lapiz.png') }}" class="pos-13">
    </div>

    <div class="container">
        <div class="demo-container" style="margin-top: 30px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <div class="p-5 bg-white rounded shadow-lg">
                            <div class="text-center image-size-small position-relative">
                                <img src="{{ asset('images/logo.png') }}" class="p-2">
                            </div>
                            <p class="text-center lead" style="font-weight: bold">Innovando La Educación</p>
                            <form>
                                <label style="margin-top: 10px" class="font-500">Usuario</label>
                                <input class="form-control form-control-lg mb-3" id="usuario" autocomplete="off" type="text">
                                <label class="font-500">Contraseña</label>
                                <input class="form-control form-control-lg" id="password" type="password">

                                <input type="button" value="ACCEDER" style="margin-top: 25px; width: 100%; font-weight: bold" onclick="login()" class="button button-uppercase button-primary button-pill">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>

    <!-- script de las imagenes -->
    <script src="{{ asset('js/InterfazLogin.min.js') }}" type="text/javascript"></script>
</body>
</html>