<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="articles-table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Costo promedio</th>
                <th>Ultimo costo</th>
                <th>Reutilizable</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->item_code }}</td>
                <td>{{ $article->description }}
                <br>
                <small style="color: #A2C61E"><strong>{{ $article->type }}</strong></small>
                </td>
                <td>{{ number_format($article->average_cost, 0, ',', '.'); }}</td>
                <td>{{ number_format($article->last_cost, 0, ',', '.'); }}</td>
                <td>{{ $article->usage_quantity }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('update_articles')
                            <a href="{{ route('articles.edit', [$article->id]) }}" class='btn btn-default btn-xs' title="Modificar">
                               <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_articulos')
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
            Página <strong>{{ $articles->currentPage() }}</strong> de <strong>{{ $articles->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $articles->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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