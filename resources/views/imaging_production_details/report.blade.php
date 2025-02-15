@extends('layouts.app')

@section('content')
<div>
    <a class="btn btn-default buttom-left" title="Generar QR" id="qr">
        <i class="fas fa-qrcode"></i><span>Generar QR</span>
    </a>
    <div id="app">
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</div>
<div class="mt-3">
    <iframe title="COSTOS UNITARIOS" width="100%" height="900px" src="https://app.powerbi.com/view?r=eyJrIjoiZDI4MjBkY2UtMmE2Yy00MTI4LWFiNDAtNjgyYTU4MWNhMDJhIiwidCI6Ijk4NGRkMTg1LWM4MDMtNGRhMS05NzRmLTcxZTQwYzc0ZWNjZCJ9&pageName=ReportSection47bc28d2ce4d597aa7c3" frameborder="0" allowFullScreen="true"></iframe>
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

<script>
    document.getElementById('qr').addEventListener('click', function() {
        Swal.fire({
            imageUrl: "https://www.codigos-qr.com/qr/php/qr_img.php?d=https%3A%2F%2Fapp.powerbi.com%2Fview%3Fr%3DeyJrIjoiZDI4MjBkY2UtMmE2Yy00MTI4LWFiNDAtNjgyYTU4MWNhMDJhIiwidCI6Ijk4NGRkMTg1LWM4MDMtNGRhMS05NzRmLTcxZTQwYzc0ZWNjZCJ9%26pageName%3DReportSection47bc28d2ce4d597aa7c3&s=8&e=m",
            imageAlt: "QR",
            showConfirmButton: false
        });
    });
</script>

@endsection

