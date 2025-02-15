@php
    use Spatie\Permission\Models\Permission;
    $permissions = Permission::all();
    $sortedPermissions = $permissions->sortBy('category');

    $groupedPermissions = $sortedPermissions->groupBy('category');

    $groupedPermissions = $groupedPermissions->sortKeys();
@endphp

<div class="row">
    @foreach ($groupedPermissions as $category => $permissionGroup)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">{{ $category ?: 'Sin categoría' }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool text-white" data-toggle="collapse"
                            href="#{{$category}}" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="collapse" id="{{$category}}">
                    <div class="card-body">
                        <div class="d-grid gap-2 mb-3">
                            <button type="button" class="btn btn-outline-success btn-sm select-category"
                                data-category="{{ $category }}">
                                Seleccionar Todos en {{ $category ?: 'Sin categoría' }}
                            </button>
                        </div>
                        @foreach ($permissionGroup as $per)
                            <div class="mb-2">
                                <label class="form-check form-switch">
                                    <input name="permissions[]" type="checkbox" role="switch"
                                        value="{{ $per->name }}" class="form-check-input custom-switch-success"
                                        data-category="{{ $category }}"
                                        {{ $model->permissions->contains($per->id) || collect(old('permissions'))->contains($per->name)
                                            ? 'checked'
                                            : '' }}>
                                    <span class="form-check-label">{{ $per->display_name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    .custom-switch-success:checked {
        background-color: #198754;
        border-color: #198754;
    }

    .custom-switch-success:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }

    .custom-switch-success:focus:not(:checked) {
        border-color: #198754;
    }
</style>

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select-category').click(function(event) {
                event.preventDefault();
                var category = $(this).data('category');
                var checkboxes = $('input[type="checkbox"][data-category="' + category + '"]');
                var allChecked = checkboxes.length === checkboxes.filter(':checked').length;
                checkboxes.prop('checked', !allChecked);
            });
        });
    </script>
@endpush
{{-- <div class="d-grid gap-2 d-md-block">
    <button type="button" class="btn btn-primary btn-sm" id="select-all">Seleccionar Todos</button>
</div>
<br><br>
@foreach ($permissions as $per)
    <div class="col-sm-12">
    	<div class="m-b-10">
	        <label class="form-check form-switch">
	            <input name="permissions[]" type="checkbox" role="switch" value="{{ $per->name }}"  class="form-check-input"
	                {{ $model->permissions->contains($per->id)
	                    || collect( old('permissions') )->contains($per->name)
	                    ? 'checked':'' }}
	            >
	            <span class="form-check-label">{{ $per->display_name }}</span>
	        </label>
    	</div>
    </div>
@endforeach
@push('page_scripts')
    <script>
        $(document).ready(function() {
            let isAllSelected = false;
            $('#select-all').click(function(event) {
                event.preventDefault();
                if(isAllSelected) {
                    $('input[type="checkbox"]').prop('checked', false);
                    isAllSelected = false;
                } else {
                    $('input[type="checkbox"]').prop('checked', true);
                    isAllSelected = true;
                }
            });
        });
    </script>
@endpush --}}
