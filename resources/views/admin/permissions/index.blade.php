@extends('admin.layout')

@section('content-header')
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
            	PERMISOS
            	<small>Listado</small>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Permisos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->	  	
   	</div><!-- /.container-fluid -->
@endsection

@section('content')
	<div class="container-fluid">
		@if(session('flash'))
			<div class="alert alert-success">{{ session('flash') }}</div>
		@endif
		<div class="card">
	      <div class="card-header">
	        <h3 class="card-title">Listado de permisos</h3>
	      </div>
	      <!-- /.card-header -->
	      <div class="card-body">
	        <table id="permissionsTable" class="table table-bordered table-striped">
	          <thead>
	          <tr>
	            <th>Id</th>
	            <th>Identificador</th>
	            <th>Nombre</th>
	            <th>Guard</th>
	            <th>Acciones</th>
	          </tr>
	          </thead>
	          <tbody>
	          	@foreach($permissions as $permission)
	          		<tr>
	          			<td>
	          				{{ $permission->id }}
	          			</td>
	          			<td>
	          				{{ $permission->name }}
	          			</td>
	          			<td>
	          				{{ $permission->display_name }}
	          			</td>
	          			<td>
	          				{{ $permission->guard_name }}
	          			</td>
	          			<td>
	          				@can('update', $permission)
		          				<a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-xs btn-primary">
		          					<i class="fa fa-pencil-ruler"></i>
		          				</a>
	          				@endcan
	          			</td>
	          		</tr>
	          	@endforeach
	          </tbody>
	        </table>
	      </div>
	      <!-- /.card-body -->
	    </div>
	</div>
@endsection

@push('styles')
  	<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  	<link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  	<link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@push('scripts')
	<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$(function () {
			$("#rolesTable").DataTable();
		});
	</script>
@endpush