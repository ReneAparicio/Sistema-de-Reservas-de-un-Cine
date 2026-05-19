@extends('layouts.app')

@section('title', 'Nueva Reserva')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4><i class="fas fa-ticket-alt"></i> Nueva Reserva - Mostrador</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5>{{ $funcion->pelicula->titulo }}</h5>
                    <p class="mb-0">
                        📅 {{ \Carbon\Carbon::parse($funcion->fecha)->format('d/m/Y') }} | 
                        ⏰ {{ \Carbon\Carbon::parse($funcion->hora)->format('h:i A') }} | 
                        🎪 Sala {{ $funcion->sala }}
                    </p>
                    <p class="mb-0 mt-2">
                        💰 Precio: ${{ number_format($funcion->precio, 2) }} por boleto<br>
                        💺 Asientos disponibles: <strong>{{ $funcion->asientos_disponibles }}</strong>
                    </p>
                </div>

                <form action="{{ route('funciones.procesarReserva', $funcion->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="cliente_nombre" class="form-label">Nombre del Cliente *</label>
                        <input type="text" class="form-control form-control-lg @error('cliente_nombre') is-invalid @enderror" 
                               id="cliente_nombre" name="cliente_nombre" value="{{ old('cliente_nombre') }}" required autofocus>
                        @error('cliente_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cliente_email" class="form-label">Email del Cliente *</label>
                        <input type="email" class="form-control form-control-lg @error('cliente_email') is-invalid @enderror" 
                               id="cliente_email" name="cliente_email" value="{{ old('cliente_email') }}" required>
                        @error('cliente_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cantidad_asientos" class="form-label">Cantidad de Boletos *</label>
                        <input type="number" class="form-control form-control-lg @error('cantidad_asientos') is-invalid @enderror" 
                               id="cantidad_asientos" name="cantidad_asientos" 
                               value="{{ old('cantidad_asientos', 1) }}" 
                               min="1" max="{{ $funcion->asientos_disponibles }}" required>
                        <small class="text-muted">Máximo: {{ $funcion->asientos_disponibles }} boletos</small>
                        @error('cantidad_asientos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-check-circle"></i> Confirmar Reserva
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection