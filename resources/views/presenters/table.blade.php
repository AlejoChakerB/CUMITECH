<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="presenters-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Presentador</th>
                <th>Cargo</th>
                <th>Stand</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presenters as $presenter)
                <tr>
                    <td>{{ $presenter->id_users_employees }}</td>
                    <td>{{ $presenter->id_users_employees ? $presenter->user_employees->employe->name : 'Sin ID' }}</td>
                    <td>{{ $presenter->id_users_employees ? $presenter->user_employees->employe->work_position : 'Sin ID' }}
                    </td>
                    <td>{{ $presenter->stand }}</td>
                    {{-- <td><img src="data:image/png+xml;base64,{{ $presenter->qr_code }}" alt="QR Code"></td> --}}
                    <td width="120">
                        {!! Form::open(['route' => ['presenters.destroy', $presenter->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_presenters')
                                <a data-bs-toggle="modal" data-bs-target="#qrModal" class="btn btn-default btn-xs"
                                    title="Codigo QR" onclick="loadQRCode('{{ $presenter->qr_code }}')">
                                    <i class="fas fa-qrcode" style="color: #2B3D63;"></i>
                                </a>
                            @endcan
                            @can('update_presenters')
                                <a href="{{ route('presenters.edit', [$presenter->id]) }}" class='btn btn-default btn-xs'>
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_presenters')
                                {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-default btn-xs',
                                    'onclick' => "return confirm('Are you sure?')",
                                ]) !!}
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Código QR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="qr-container">
                    <div class="qr-inner">
                        <img id="qrImage" src="" alt="Código QR" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loadQRCode(qrCode) {
        // Configura el src de la imagen con el valor base64
        document.getElementById('qrImage').src = 'data:image/png+xml;base64,' + qrCode;
    }
</script>
<style>
    .qr-container {
        display: inline-block;
        padding: 10px;
        border-radius: 15px;
        border: 5px;
        background: linear-gradient(180deg,
                rgb(141, 201, 59),
                rgb(20, 166, 222));
    }

    .qr-inner {
        background: white;
        padding: 15px;
        border-radius: 10px;
        display: inline-block;
    }
</style>
