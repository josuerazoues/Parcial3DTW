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

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f0e1;
            height: 100%;
            margin: 0;
            position: relative;
        }

        .demo-container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .btn-lg {
            padding: 12px 26px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        ::placeholder {
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .form-control-lg {
            font-size: 16px;
            padding: 25px 20px;
        }

        .font-500 {
            font-weight: 500;
        }

        .image-size-small {
            width: 200px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .image-size-small img {
            width: 200px;
        }

        .floating-buttons {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .floating-buttons img {
            position: absolute;
            width: 80px;
            opacity: 0.35;
            pointer-events: none;
        }

        .pos-1 { top: 5%; left: 5%; }
        .pos-2 { top: 10%; right: 10%; }
        .pos-3 { bottom: 10%; left: 8%; }
        .pos-4 { top: 15%; right: 30%; }
        .pos-5 { bottom: 5%; right: 10%; }
        .pos-6 { top: 20%; left: 80%; }
        .pos-7 { bottom: 18%; right: 30%; }
        .pos-8 { top: 65%; left: 5%; }
        .pos-9 { bottom: 30%; right: 5%; }
        .pos-10 { top: 75%; left: 10%; }
        .pos-11 { top: 25%; right: 45%; }
        .pos-12 { bottom: 15%; left: 70%; }
        .pos-13 { top: 22%; left: 20%; }
    </style>
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

    <script type="text/javascript">
        var input = document.getElementById("password");
        input.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                login();
            }
        });

        function login() {
            var usuario = document.getElementById('usuario').value;
            var password = document.getElementById('password').value;

            if (usuario === '') {
                toastr.error('Usuario es requerido');
                return;
            }

            if (password === '') {
                toastr.error('Contraseña es requerida');
                return;
            }

            openLoading();

            let formData = new FormData();
            formData.append('usuario', usuario);
            formData.append('password', password);

            axios.post('/admin/login', formData)
                .then((response) => {
                    closeLoading();
                    verificar(response);
                })
                .catch((error) => {
                    toastr.error('error al iniciar sesión');
                    closeLoading();
                });
        }

        function verificar(response) {
            if (response.data.success === 0) {
                toastr.error('Validación incorrecta');
            } else if (response.data.success === 1) {
                window.location = response.data.ruta;
            } else if (response.data.success === 2) {
                toastr.error('Contraseña incorrecta');
            } else if (response.data.success === 3) {
                toastr.error('Usuario no encontrado');
            } else if (response.data.success === 5) {
                Swal.fire({
                    title: 'Usuario Bloqueado',
                    text: "Contactar a la administración",
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                });
            } else {
                toastr.error('Error al iniciar sesión');
            }
        }
    </script>
</body>

</html>