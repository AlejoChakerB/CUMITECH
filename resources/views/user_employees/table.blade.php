<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="userEmployees-table">
        <thead>
            <tr>
                <th>Id usuario</th>
                <th>Usuario</th>
                <th>Id empleado</th>
                <th>Empleado</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userEmployees as $userEmployee)
                <tr>
                    <td>{{ $userEmployee->id_user }}</td>
                    <td>{{ $userEmployee->id_user ? $userEmployee->user->name : 'Sin ID' }}
                        <br>
                        <small style="color: #A2C61E"><strong>USUARIO: {{ $userEmployee->id_user ? $userEmployee->user->email : 'Sin ID' }}</strong></small>
                    </td>
                    <td>{{ $userEmployee->id_employees }}</td>
                    <td>{{ $userEmployee->id_employees ? $userEmployee->employe->name : 'Sin ID' }}
                        <br>
                        <small style="color: #A2C61E"><strong>DNI: {{ $userEmployee->id_employees ? $userEmployee->employe->dni : 'Sin ID' }}</strong></small>
                    </td>
                    <td width="120">
                        {!! Form::open(['route' => ['userEmployees.destroy', $userEmployee->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_userEmployees')
                                <a href="{{ route('userEmployees.show', [$userEmployee->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_userEmployees')
                                <a href="{{ route('userEmployees.edit', [$userEmployee->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_userEmployees')
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
    <div class="d-flex justify-content-between mb-4">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $userEmployees->currentPage() }}</strong> de <strong>{{ $userEmployees->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $userEmployees->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
    </div>
</div>

<style>
    .pagination .page-item .page-link{
        color: #2B3D63;
    }
    .pagination .page-item.active .page-link {
        background-color: #2B3D63;
        border-color: #2B3D63;
        color: white;
    }
</style>
