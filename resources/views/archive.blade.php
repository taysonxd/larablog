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
    <div class="row">
        <div class="col-6">
            <span class="h3">                
                Autores
            </span>
            <hr class="divider">
            <ul class="list-unstyled">
                @foreach ($authors as $author)
                    <li class="list-item">{{ $author->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-6">
            <span class="h3">                
                Posts
            </span>
            <hr class="divider">
            <ul class="list-unstyled">
                @foreach ($posts as $post)
                    <li class="list-item">
                        <a href="{{ route('posts.show', $post) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <span class="h3">                
                Categorias
            </span>
            <hr class="divider">
            <ul class="list-unstyled">
                @foreach ($categories as $category)
                    <li class="list-item">
                        <a href="{{ route('categories.show', $category) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-6">
            <span class="h3">                
                Archivo
            </span>
            <hr class="divider">
            <ul class="list-unstyled">
                @foreach ($archive as $item)
                    <li class="list-item">
                        <a class="text-capitalize" href="{{ route('pages.home', [ 'month' => $item->month, 'year' => $item->year ]) }}">
                            {{ $item->year }} {{ $item->monthName }} ({{ $item->posts }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection