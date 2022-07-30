@extends('admin.layout')

@section('content-header')
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
            	PERMISOS
            	<small>Editar permiso</small>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}"><i class="fa fa-list"></i> Permisos</a></li>
              <li class="breadcrumb-item active">Editar</li>
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
						<form class="row my-3" method="POST" action="{{ route('admin.permissions.update', $permission) }}">
							@method('PUT')
							@csrf
							<div class="form-group row">
								<label for="inputName" class="col-sm-5 col-form-label">Identificador</label>
								<input type="text" class="form-control" id="inputName" value="{{ $permission->name }}" placeholder="Identificador" disabled>
							</div>
							<div class="form-group row">
								<label for="display_name" class="col-sm-5 col-form-label">Nombre</label>
								<input type="text" name="display_name" class="form-control" id="display_name" placeholder="Nombre" value="{{ old('display_name', $permission->display_name) }}">
							</div>
							<div class="form-group row">
								<div class="col-12">
									<button type="submit" class="btn btn-block btn-primary">Actualizar</button>
								</div>
							</div>
						</form>                  
					</div>
				</div>
			</div>
	    </div>
	</div>
@endsection