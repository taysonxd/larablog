@extends('admin.layout')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">
          PERFIL DE USUARIO
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Usuarios</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    @if(session('flash'))
      <div class="alert alert-success">{{ session('flash') }}</div>
    @endif
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="/adminlte/img/user4-128x128.jpg" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{ $user->name }}</h3>

          <p class="text-muted text-center">{{ $user->getRoleNames()->implode(', ') }}</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Email</b> <a class="float-right">{{ $user->email }}</a>
            </li>
            <li class="list-group-item">
              <b>Publicaciones</b> <a class="float-right">{{ $user->posts()->count() }}</a>
            </li>
            <li class="list-group-item">
              <b>Roles</b> <a class="float-right">{{ $user->getRoleNames()->implode(', ') }}</a>
            </li>
          </ul>

          <a href="#settings" data-toggle="tab" class="btn btn-primary btn-block"><b>Editar</b></a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Publicaciones</a></li>
            <li class="nav-item"><a class="nav-link" href="#roles" data-toggle="tab">Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="#additionalPermissions" data-toggle="tab">Permisos adicionales</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Información de perfil</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <!-- Post -->
              @forelse ($user->posts as $post)
                <div class="post pb-0">
                  <div class="user-block">
                    <h5 class="post-title mb-0">
                      <a href="#">{{ $post->title }}</a>
                    </h5>
                    <small class="published_date">Publicado el {{ $post->published_at->format('d-m-Y') }}</small>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    {{ $post->excerpt }}
                  </p>
                </div>
              @empty
                <small class="text-muted">No tiene ninguna publicación</small>
              @endforelse
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="roles">
              <!-- The timeline -->
              <div class="timeline timeline-inverse">
                @forelse ($user->roles as $role)
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-user bg-info"></i>
                    <div class="timeline-item">
                      <h3 class="timeline-header border-1"><a href="#">{{ $role->name }}</a></h3>
                      <div class="timeline-body">
                        @if( $role->permissions->count() )
                          {{ $role->permissions->pluck('name')->implode(', ') }}
                        @else
                          <small class="text-muted">No tiene permisos asignados</small>
                        @endif
                      </div>
                    </div>                    
                  </div>
                  <!-- END timeline item -->
                @empty
                  <small class="text-muted">No tiene roles asignados</small>
                @endforelse                
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="additionalPermissions">
              <!-- The timeline -->
              @if ( $user->permissions->count() )
                <div class="timeline timeline-inverse">
                  @foreach ($user->permissions as $permission)
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-bars bg-info"></i>
                      <div class="timeline-item">
                        <h3 class="timeline-header border-1"><a href="#">{{ $permission->name }}</a></h3>
                      </div>                    
                    </div>
                    <!-- END timeline item -->
                  @endforeach
                </div>
              @else
                <small class="text-muted">No tiene permisos adicionales</small>
              @endif
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="settings">
              
              @include('admin.partials.errorMessages')
              
              <div class="row">
                <div class="col-12 col-md-6">
                  <h5>Datos personales</h5>
                  <form class="form-horizontal my-3" method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-5 col-form-label">Name</label>
                      <div class="col-7">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ old('name', $user->name) }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-5 col-form-label">Email</label>
                      <div class="col-7">
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('email', $user->email) }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-5 col-form-label">Contraseña</label>
                      <div class="col-7">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña">
                        <span class="text-muted">Si desea actualizar su contraseña rellene el campo</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="password_confirmation" class="col-sm-5 col-form-label">Repita su contraseña</label>
                      <div class="col-7">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Repita su contraseña">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-12">
                        <button type="submit" class="btn btn-block btn-primary">Guardar</button>
                      </div>
                    </div>
                  </form>                  
                </div>
                <div class="col-12 col-md-6">
                  <h5>Roles</h5>
                  <div class="form-group">
                    @role('Admin')                    
                      <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
                        @csrf
                        @method('PUT')
                        @include('admin.partials.rolesCheckboxes')    
                        <button type="submit" class="btn btn-block btn-primary">Actualizar roles</button>
                      </form>                    
                    @else
                      <ul class="list-group">
                        @forelse ($user->roles as $role)                        
                          <li class="list-group-item py-2">{{ $role->name }}</li>
                        @empty
                          <li class="list-group-item py-2">No tiene roles.</li>
                        @endforelse
                      </ul>
                    @endrole
                  </div>
                  <h5>Permisos adicionales</h5>
                  <div class="form-group">
                    @role('Admin')
                      <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
                        @csrf
                        @method('PUT')
                        @include('admin.partials.permissionsCheckboxes', [ 'model' => $user ])
                        <button type="submit" class="btn btn-block btn-primary">Actualizar permisos</button>
                      </form>
                    @else
                      <ul class="list-group">
                        @forelse ($user->permissions as $permission)                        
                          <li class="list-group-item">{{ $permission->name }}</li>
                        @empty
                          <li class="list-group-item">No tiene permisos adicionales.</li>
                        @endforelse
                      </ul>
                    @endrole
                  </div>
                </div>                
              </div>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
@endsection