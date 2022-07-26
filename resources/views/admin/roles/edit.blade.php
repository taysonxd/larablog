@extends('admin.layout')

@section('content-header')
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
            	ROLES
            	<small>Editar role</small>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}"><i class="fa fa-list"></i> Roles</a></li>
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
						<form class="row my-3" method="POST" action="{{ route('admin.roles.update', $role) }}">
							@method('PUT')
							@include('admin.roles.form')
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