<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="medicalFees-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Manual de pago</th>
                <th>Tipo</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicalFees as $medicalFee)
            <tr>
                <td><strong>{{ $medicalFee->honorary_code }}</strong></td>
                <td>{{ $medicalFee->payment_manual }}</td>
                <td>
                    @if($medicalFee->fees_type == 256 || $medicalFee->fees_type == 312)
                        <span class="badge text-black" style="background-color:#A3BF18;">ISS</span>
                    @elseif ($medicalFee->fees_type == 'SOAT')
                        <span class="badge text-white" style="background-color:#00B0EB; text-color: white;">{{ $medicalFee->fees_type }}</span>
                    @elseif ($medicalFee->fees_type == 'INST')
                    <span class="badge text-white" style="background-color:#FA773E; text-color: white;">{{ $medicalFee->fees_type }}</span>
                    @endif
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['medicalFees.destroy', $medicalFee->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('update_medicalFees')
                            <a href="{{ route('medicalFees.edit', [$medicalFee->id]) }}" class='btn btn-default btn-xs' title="Modificar">
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_medicalFees')
                            {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn
                            btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')", 'title' => 'Eliminar']) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-4">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $medicalFees->currentPage() }}</strong> de <strong>{{ $medicalFees->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $medicalFees->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
    </div>
</div>
<style>
    .custom-title {
        color: #14ABE3;
        /* Cambia el color del título a rojo */
    }

    .custom-icon::before {
        color: #cf33ff;
        /* Cambia el color del icono a rojo */
    }

    .pagination .page-item .page-link {
        color: #2B3D63;
    }

    .pagination .page-item.active .page-link {
        background-color: #2B3D63;
        border-color: #2B3D63;
        color: white;
    }
</style>