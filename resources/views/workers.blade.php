@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" />

    <style>
        .card {
            width: 100%;
            max-width: 100vw;
            margin: 10px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #startBtn {
            font-size: 1.1rem;
            padding: 10px 25px;
            margin-bottom: 20px;
        }

        #status {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #333;
            text-align: center;
            min-height: 30px;
        }

        #resultado {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px 15px;
        }

        .numero-item {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 10px 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-size: 1rem;
            display: flex;
            justify-content: space-between;
        }

        .numero-item span.indice {
            font-weight: 600;
            color: #007bff; /* celeste */
        }

        .numero-item span.numero {
            font-weight: 600;
            color: #000000; /* negro */
        }
    </style>
@endsection

@section('content')
<section class="contenedor-principal">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="m-0">Actividad Estadistica</h4>
        </div>
        <div class="card-body">
            <p style="font-size: 1.1rem; max-width: 600px; text-align: center;">
                En esta actividad se muestran los primeros 50 numeros aleatoriamente ordenados de forma ascendente, de 100.000 posibilidades.
            </p>

            <button id="startBtn" class="btn btn-primary">Iniciar Cálculo</button>

            <div id="status"></div>

            <div id="resultado">

            </div>
        </div>
    </div>
</section>
@endsection

@section('archivos-js')
<script>
    const startBtn = document.getElementById('startBtn');
    const status = document.getElementById('status');
    const resultado = document.getElementById('resultado');

    let worker;

    startBtn.addEventListener('click', () => {
        status.textContent = 'Generando números y ordenando, espere...';
        resultado.innerHTML = '';
        startBtn.disabled = true;

        if (!worker) {
            worker = new Worker('{{ asset("js/worker.js") }}');
        }

        worker.postMessage({});
        worker.onmessage = function(e) {
            startBtn.disabled = false;

            if (e.data.error) {
                status.textContent = `Error: ${e.data.error}`;
                return;
            }

            const numerosOrdenados = e.data;
            const total = 50;
            const columnas = 5;
            const filas = Math.ceil(total / columnas);

            let htmlItems = '';

            for (let fila = 0; fila < filas; fila++) {
                for (let col = 0; col < columnas; col++) {
                    const index = fila * columnas + col;
                    if (index < total) {
                        htmlItems += `
                            <div class="numero-item">
                                <span class="indice">#${index + 1}</span>
                                <span class="numero">${numerosOrdenados[index]}</span>
                            </div>
                        `;
                    }
                }
            }

            resultado.innerHTML = htmlItems;
            status.textContent = '¡Cálculo terminado! Se muestran los primeros 50 números.';
        };
    });
</script>
@endsection
