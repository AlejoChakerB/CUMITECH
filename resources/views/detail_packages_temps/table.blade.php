<div class="table-responsive">
    <table class="table" id="detailPackagesTemps-table">
        <thead>
        <tr>
            <th>Description</th>
        <th>Cod Uf</th>
        <th>Funcional Unit</th>
        <th>Code Service</th>
        <th>Description Service</th>
        <th>Id Factu</th>
        <th>Quanty</th>
        <th>Recorded Cost</th>
        <th>Unit Cost</th>
        <th>Observation</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($detailPackagesTemps as $detailPackagesTemp)
            <tr>
                <td>{{ $detailPackagesTemp->description }}</td>
            <td>{{ $detailPackagesTemp->cod_uf }}</td>
            <td>{{ $detailPackagesTemp->funcional_unit }}</td>
            <td>{{ $detailPackagesTemp->code_service }}</td>
            <td>{{ $detailPackagesTemp->description_service }}</td>
            <td>{{ $detailPackagesTemp->id_factu }}</td>
            <td>{{ $detailPackagesTemp->quanty }}</td>
            <td>{{ $detailPackagesTemp->recorded_cost }}</td>
            <td>{{ $detailPackagesTemp->unit_cost }}</td>
            <td>{{ $detailPackagesTemp->observation }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['detailPackagesTemps.destroy', $detailPackagesTemp->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('detailPackagesTemps.show', [$detailPackagesTemp->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('detailPackagesTemps.edit', [$detailPackagesTemp->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
