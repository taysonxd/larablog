@extends('admin.layout')

@section('content-header')
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
            	POSTS
            	<small>Crear publicación</small>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->	  	
   	</div><!-- /.container-fluid -->
@endsection

@section('content')
	<div class="container-fluid">
		<form method="POST" action="{{ route('admin.posts.store') }}">
		@csrf
		<div class="row">			
			<div class="col-md-8">
				<div class="card card-outline card-primary">						
					<div class="card-body">
						<div class="form-group">
							<label for="">Titulo de la publicación</label>
							<input type="text" class="form-control" name="title" placeholder="Ingresa aqui el titulo">
						</div>
						<div class="form-group">
							<label for="">Contenido de la publicación</label>
							<textarea name="body" id="body" class="form-control" cols="15" rows="8" placeholder="Ingresa el contenido de la publicación"></textarea>
						</div>
					</div>
					<!-- /.card-body -->
				</div>	
			</div>
			<div class="col-md-4">
				<div class="card card-outline card-primary">
					<div class="card-body">
						<div class="form-group">
							<label>Fecha de publicación</label>
							<div class="input-group date" id="reservationdate" data-target-input="nearest">
								<input type="text" name="published_at" class="form-control datetimepicker-input" data-target="#reservationdate"/>
								<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="">Categorias</label>
							<select name="category_id" class="select2 form-control">
								<option value="">Selecciona una categoria</option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="">Etiquetas</label>
							<select name="tags[]" class="select2 w-100" data-placeholder="Selecciona una o mas etiquetas" multiple="multiple">
								@foreach ($tags as $tag)
									<option value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="">Extracto de la publicación</label>
							<textarea name="excerpt" id="excerpt" class="form-control" cols="15" rows="2" placeholder="Ingresa un extracto de la publicación"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-block btn-primary">Guardar publicación</button>
						</div>
					</div>
				</div>
			</div>			
		</div>		
		</form>
	</div>
@endsection

@push('styles')
	<!-- Tempusdominus Bootstrap 4 -->
  	<link rel="stylesheet" href="/adminlte//plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  	<!-- summernote -->
  	<link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
  	<!-- Select2 -->
  	<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
  	<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('scripts')
	<script src="/adminlte/plugins/moment/moment.min.js"></script>
  	<!-- Tempusdominus Bootstrap 4 -->
	<script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- Select2 -->
	<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

	<script>
		$('#body').summernote()

	    $('.select2').select2({
	      theme: 'bootstrap4',
	      tags : true
	    })

		$('#reservationdate').datetimepicker({
	        format: 'L'
	    });
	</script>
@endpush
	
