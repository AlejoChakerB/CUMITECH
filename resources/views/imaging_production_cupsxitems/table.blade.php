<div class="table-responsive">
    <table class="table" id="imagingProductionCupsxitems-table">
        <thead>
        <tr>
            <th>Servicio</th>
            <th>Categoria</th>
            <th>Insumos</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($imagingProductionCupsxitems as $imagingProductionCupsxitems)
            <tr>
                <td>{{ $imagingProductionCupsxitems->service }}</td>
            <td>{{ $imagingProductionCupsxitems->category }}</td>
            <td>{{ $imagingProductionCupsxitems->items }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['imagingProductionCupsxitems.destroy', $imagingProductionCupsxitems->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('imagingProductionCupsxitems.show', [$imagingProductionCupsxitems->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('imagingProductionCupsxitems.edit', [$imagingProductionCupsxitems->id]) }}"
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
