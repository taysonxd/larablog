@foreach ($permissions as $id => $name)
  <div class="checkbox">                        
    <label for="{{ $name }}">
      <input type="checkbox" id="{{ $name }}" name="permissions[]" value="{{ $name }}"
      		{{ 	$model->permissions->contains($id)
      			|| collect( old('permissiones', $role->permissions) )->contains($name)
      			? 'checked'
      			: ''
      		}}>
      {{ $name }}
    </label>
  </div>
@endforeach