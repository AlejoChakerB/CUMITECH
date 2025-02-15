@extends('layouts.app')

@section('content')
    <div>
        <div id="app">
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </div>
    <div class="mt-3">
        <iframe title="EJECUCION FINANCIERA" width="100%" height="900px"
            src="https://app.powerbi.com/view?r=eyJrIjoiN2VjYTY5MDAtNTZjOC00ZTQ1LTk1OTMtNTIyNTI4ODljZDM2IiwidCI6Ijk4NGRkMTg1LWM4MDMtNGRhMS05NzRmLTcxZTQwYzc0ZWNjZCJ9"
            frameborder="0" allowFullScreen="true"></iframe>
    </div>

    <style>
        iframe {
            border-radius: 10px;
        }

        .buttom-left {
            background-color: transparent;
            color: #2B3D63;
            box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
            font-size: 15px;
        }

        .buttom-left:hover {
            box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
            /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
        }

        .buttom-left span {
            margin-left: 10px;
        }
    </style>
@endsection

