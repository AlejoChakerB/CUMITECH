@foreach ($roles as $role)
    <div class="col-sm-12">
    	<div class="m-b-10">
	        <label class="custom-control custom-checkbox">
	            <input name="roles[]" type="checkbox" value="{{ $role->name }}"  class="custom-control-input"
	                {{ $user->roles->contains($role->id) ? 'checked':'' }}>
	             <span class="custom-control-label">{{ $role->display_name }}</span>	            
	        </label>
	    </div>
    </div>
@endforeach

