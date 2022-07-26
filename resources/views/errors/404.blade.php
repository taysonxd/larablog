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
    <h3>Pagina no encontrada</h3>
    <div class="row">
        <div class="col">
            <div class="card-deck">
                <!-- Blog post-->
                Regresar a <a href="{{ route('pages.home') }}">Inicio</a>
            </div>
        </div>
    </div>
@endsection