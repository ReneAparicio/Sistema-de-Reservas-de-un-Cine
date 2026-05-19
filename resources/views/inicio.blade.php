@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="row align-items-center">
    <div class="col-md-6">
        <h1 class="display-4">🎬 ¡Bienvenido a CineReservas!</h1>
        <p class="lead">La mejor experiencia cinematográfica te espera. Reserva tus boletos de manera rápida y sencilla.</p>
        <hr class="my-4">
        <p>Disfruta de las mejores películas en nuestras salas premium.</p>
        <a href="{{ route('funciones.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-ticket-alt"></i> Ver funciones disponibles
        </a>
        <a href="{{ route('peliculas.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-film"></i> Ver catálogo
        </a>
    </div>
    <div class="col-md-6">
        <img src="https://via.placeholder.com/500x400?text=Cine+Reservas" alt="Cine" class="img-fluid rounded">
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-4 text-center">
        <i class="fas fa-ticket-alt fa-3x text-primary"></i>
        <h3>Fácil Reserva</h3>
        <p>Reserva tus boletos en pocos pasos</p>
    </div>
    <div class="col-md-4 text-center">
        <i class="fas fa-credit-card fa-3x text-success"></i>
        <h3>Pago Seguro</h3>
        <p>Múltiples métodos de pago</p>
    </div>
    <div class="col-md-4 text-center">
        <i class="fas fa-star fa-3x text-warning"></i>
        <h3>Mejores Películas</h3>
        <p>Los estrenos más esperados</p>
    </div>
</div>
@endsection