@extends('layouts.app')

@section('header')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
            </div>
        </div>
    </header>
@endsection

@section('content')
    @if( isset($title) )
        <h3>{{ $title }}</h3>
    @endif
    <!-- Featured blog post-->
    <div class="card mb-4">
        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
        <div class="card-body">
            <div class="small text-muted">January 1, 2022</div>
            <h2 class="card-title">Featured Post Title</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
            <a class="btn btn-primary" href="#!">Read more →</a>
        </div>
    </div>
    <!-- Nested row for non-featured blog posts-->
    <div class="row">
        <div class="col">
            <div class="card-deck">
                <!-- Blog post-->
                @foreach ($posts as $post)
                    <div class="card mb-4">
                        @if( $post->photos->count() === 1 )
                            <a href="#!"><img class="card-img-top" src="{{ url($post->photos->first()->url) }}" alt="..." /></a>
                        @elseif( $post->photos->count() > 1 )
                            <section>
                                <div class="row container gal-container">
                                    @foreach( $post->photos->take(4) as $photo )
                                        <div class="{{ $loop->iteration === 1 ? 'col-md-8 col-sm-12 co-xs-12' : 'col-md-4 col-sm-6 co-xs-12' }} gal-item">
                                            <div class="box">
                                                @if( $loop->iteration === 4 )
                                                    <div class="overlay">{{ $post->photos->count() }} Fotos</div>
                                                @endif
                                                <img src="{{ url($photo->url) }}">
                                                {{-- <div class="modal fade" id="1" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <div class="modal-body">
                                                                <img src="http://nabeel.co.in/files/bootsnipp/gallery/1.jpg">
                                                            </div>
                                                            <div class="col-md-12 description">
                                                                <h4>This is the first one on my Gallery</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @elseif($post->iframe)
                            <div class="video">
                                {!! $post->iframe !!}
                            </div>
                        @endif
                        <div class="card-body">
                            <div>
                                @foreach ($post->tags as $tag)
                                    <a class="badge bg-info text-decoration-none link-light" href="{{ route('tags.show', $tag) }}">#{{ $tag->name }}</a>
                                @endforeach
                            </div>        
                            <div class="small text-muted">{{ $post->published_at->format('d M') }}</div>
                            <h2 class="card-title h4">{{ $post->title }}</h2>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            <a class="btn btn-primary" href="{{ route('posts.show', $post) }}">Read more →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Pagination-->
    <nav aria-label="Pagination">
        <hr class="my-0" />
        <ul class="pagination justify-content-center my-4">
            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
            <li class="page-item"><a class="page-link" href="#!">2</a></li>
            <li class="page-item"><a class="page-link" href="#!">3</a></li>
            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
            <li class="page-item"><a class="page-link" href="#!">15</a></li>
            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
        </ul>
    </nav>        
@endsection