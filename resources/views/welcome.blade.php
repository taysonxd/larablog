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
                        
                        @include( $post->viewType('welcome') )
                        
                        <div class="card-body">
                            
                            @include('layouts.partials.tags')
                            
                            <div class="small text-muted">
                                {{ $post->published_at->format('d M') }} / {{ $post->owner->name }}
                            </div>
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