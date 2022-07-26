@extends('admin.layout')

@section('content-header')
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
            	USUARIOS
            	<small>Crear usuario</small>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Usuarios</a></li>
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->	  	
   	</div><!-- /.container-fluid -->
@endsection

@section('content')
	<div class="container-fluid">
		
		@include('admin.partials.errorMessages')
		
		<div class="row">			
			<div class="col-md-8">
				<div class="card card-outline card-primary">
					<div class="card-body">						
						<form class="row my-3" method="POST" action="{{ route('admin.users.store') }}">
							@csrf
							<div class="form-group row">
								<label for="inputName" class="col-sm-5 col-form-label">Name</label>
								<div class="col-7">
									<input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ old('name') }}">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail" class="col-sm-5 col-form-label">Email</label>
								<div class="col-7">
									<input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('email') }}">
								</div>
							</div>
							<div class="form-group col-md-6">								
								<label>Roles</label>
								@include('admin.partials.rolesCheckboxes')
							</div>
							<div class="form-group col-md-6">								
								<label>Permisos</label>
                  				@include('admin.partials.permissionsCheckboxes', [ 'model' => $User ])
							</div>
							<div class="form-group">								
								<span class="text-muted">La contraseña sera generada automaticamente y enviada al usuario.</span>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<button type="submit" class="btn btn-block btn-primary">Guardar</button>
								</div>
							</div>
						</form>                  
					</div>
				</div>
			</div>
	    </div>
	</div>
@endsection