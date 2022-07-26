@csrf
<div class="form-group row">
	<label for="inputName" class="col-sm-5 col-form-label">Identificador</label>
	@if ($role->exists)
		<input type="text" class="form-control" id="inputName" value="{{ $role->name }}" placeholder="Identificador" disabled>
	@else
		<input type="text" name="name" class="form-control" id="inputName" placeholder="Identificador" value="{{ old('name') }}">
	@endif
</div>
<div class="form-group row">
	<label for="display_name" class="col-sm-5 col-form-label">Nombre</label>
	<input type="text" name="display_name" class="form-control" id="display_name" placeholder="Nombre" value="{{ old('display_name', $role->display_name) }}">
</div>
<div class="form-group row">
	<label for="inputEmail" class="col-sm-5 col-form-label">Guard</label>
	<select name="guard_name" class="custom-select" id="guard_name">
		@foreach (config('auth.guards') as $guard_name => $objectGuard)
			<option
				{{ $guard_name == old('guard_name', $role->guard_name) ? 'selected' : '' }}
				value="{{ $guard_name }}"
			>
				{{ $guard_name }}
			</option>
		@endforeach
	</select>
</div>
<div class="form-group row">								
	<label class="col-sm-5 col-form-label">Permisos</label>
	@include('admin.partials.permissionsCheckboxes', [ 'model' => $role ])
</div>