@foreach ($roles as $role)
  <div class="checkbox">                        
    <label for="{{ $role->name }}" class="mb-0">
      <input type="checkbox" id="{{ $role->name }}" name="roles[]" value="{{ $role->name }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
      {{ $role->name }}
    </label>
    <span class="d-block ml-3 text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</span>
  </div>
@endforeach