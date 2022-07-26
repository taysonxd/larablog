@extends('admin.layout')

@section('content-header')
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
            	USUARIOS
            	<small>Listado</small>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
	        <h3 class="card-title">Listado de usuarios</h3>
	      </div>
	      <!-- /.card-header -->
	      <div class="card-body">
	        <table id="usersTable" class="table table-bordered table-striped">
	          <thead>
	          <tr>
	            <th>Id</th>
	            <th>Nombre</th>
	            <th>Email</th>
	            <th>Roles</th>
	            <th></th>
	          </tr>
	          </thead>
	          <tbody>
	          	@foreach($users as $user)
	          		<tr>
	          			<td>
	          				{{ $user->id }}
	          			</td>
	          			<td>
	          				{{ $user->name }}
	          			</td>
	          			<td>
	          				{{ $user->email }}
	          			</td>
	          			<td>
	          				{{ $user->getRoleNames()->implode(', ') }}
	          			</td>
	          			<td>
	          				<a href="{{ route('admin.users.show', $user) }}" target="_blank" class="btn btn-xs btn-default">
	          					<i class="fa fa-eye"></i>
	          				</a>
	          				<form method="POST" class="d-inline" action="{{ route('admin.users.destroy', $user) }}">
	          					@method('DELETE')
	          					@csrf
	          					<button type="submit" onclick="return confirm('¿Esta seguro de eliminar la publicación?')" class="btn btn-xs btn-danger">
		          					<i class="fa fa-times"></i>
		          				</button>
	          				</form>
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
			$("#usersTable").DataTable();
		});
	</script>
@endpush