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
		@if(session('flash'))
			<div class="alert alert-success">{{ session('flash') }}</div>
		@endif
		@if( $post->photos->count() )
			<div class="row">
				<div class="card card-outline card-primary">
					<div class="card-body">
						<div class="row">
							@foreach ($post->photos as $photo)
								<div class="col-md-1">
									<form method="post" action="{{ route('admin.photos.destroy', $photo) }}">
										@method('delete')
										@csrf
										<button class="btn btn-xs btn-danger" style="position: absolute;">
											<i class="fa fa-times"></i>
										</button>
										<img class="w-100" src="{{ url($photo->url) }}" alt="">
									</form>	
								</div>										
							@endforeach	
						</div>
					</div>
				</div>
			</div>
		@endif
		<form method="POST" action="{{ route('admin.posts.update', $post) }}">
			@csrf
			@method('PUT')
			<div class="row">			
				<div class="col-md-8">
					<div class="card card-outline card-primary">						
						<div class="card-body">
							<div class="form-group">
								<label for="">Titulo de la publicación</label>
								<input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" placeholder="Ingresa aqui el titulo">
							</div>
							<div class="form-group">
								<label for="">Contenido de la publicación</label>
								<textarea name="body" id="body" class="form-control" cols="15" rows="8" placeholder="Ingresa el contenido de la publicación">{{ old('body', $post->body) }}</textarea>
							</div>
							<div class="form-group">
								<label for="">Contenido embebido (iframe)</label>
								<textarea name="iframe" id="iframe" class="form-control" cols="15" rows="2" placeholder="Ingresa el contenido embebido (iframe) de audio o video">{{ old('iframe', $post->iframe) }}</textarea>
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
									<input type="text" name="published_at" class="form-control datetimepicker-input" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : NULL ) }}" data-target="#reservationdate"/>
									<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="">Categorias</label>
								<select name="category_id" class="form-control" value="{{ old('category_id', ) }}">
									<option value="">Selecciona una categoria</option>
									@foreach ($categories as $category)
										<option {{ old('category_id', $post->category_id) === $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Etiquetas</label>
								<select name="tags[]" class="select2 w-100" data-placeholder="Selecciona una o mas etiquetas" multiple="multiple">
									@foreach ($tags as $tag)
										<option {{ collect(old('tags', $post->tags->pluck('id') ) )->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Extracto de la publicación</label>
								<textarea name="excerpt" id="excerpt" class="form-control" cols="15" rows="2" placeholder="Ingresa un extracto de la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
							</div>
							<div class="form-group">
								<div class="dropzone"></div>
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

  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endpush

@push('scripts')
	<script src="/adminlte/plugins/moment/moment.min.js"></script>
  	<!-- Tempusdominus Bootstrap 4 -->
	<script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- Select2 -->
	<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

	<script>
		$('#body').summernote({
			height: 369
		});

	    $('.select2').select2({
	      theme: 'bootstrap4'
	    })

		$('#reservationdate').datetimepicker({
	        format: 'L'
	    });

	    const myDropzone = new Dropzone('.dropzone', {
	    	url : '/admin/posts/{{ $post->url }}/photos',
	    	acceptedFiles : 'image/*',
	    	maxFilesize : 2,
	    	paramName : 'photo',
	    	headers : {
	    		"X-CSRF-TOKEN" :  '{{ csrf_token() }}'
	    	},
	    	dictDefaultMessage : 'Arrastra aqui las fotos que quieras subir'
	    });

	    myDropzone.on('error', function(file, res) {
	    	const msg = res.errors.photo[0];
	    	$('.dz-error-message:last > span').text(msg);
	    });

	    Dropzone.autoDiscover = false;
	</script>
@endpush
	
