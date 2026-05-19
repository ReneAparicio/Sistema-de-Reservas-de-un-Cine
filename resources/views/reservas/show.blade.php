@extends('layouts.app')

@section('title', 'Detalle de Reserva')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4><i class="fas fa-ticket-alt"></i> Detalle de Reserva</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>📝 Código:</strong></p>
                        <h5><code class="bg-light p-2 rounded">{{ $reserva->codigo_reserva }}</code></h5>
                        
                        <p class="mt-3"><strong>👤 Cliente:</strong></p>
                        <h5>{{ $reserva->cliente_nombre }}</h5>
                        
                        <p><strong>📧 Email:</strong></p>
                        <p>{{ $reserva->cliente_email }}</p>
                        
                        <p><strong>🎫 Boletos:</strong></p>
                        <p>{{ $reserva->cantidad_asientos }} boletos</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>🎬 Película:</strong></p>
                        <h5>{{ $reserva->funcion->pelicula->titulo }}</h5>
                        
                        <p><strong>📅 Fecha:</strong></p>
                        <p>{{ \Carbon\Carbon::parse($reserva->funcion->fecha)->format('d/m/Y') }}</p>
                        
                        <p><strong>⏰ Hora:</strong></p>
                        <p>{{ \Carbon\Carbon::parse($reserva->funcion->hora)->format('h:i A') }}</p>
                        
                        <p><strong>🎪 Sala:</strong></p>
                        <p>Sala {{ $reserva->funcion->sala }}</p>
                    </div>
                </div>
                
                <div class="alert alert-info mt-3">
                    <strong>📌 Estado:</strong>
                    <span class="badge {{ $reserva->estado == 'confirmada' ? 'bg-success' : 'bg-danger' }} fs-6">
                        {{ $reserva->estado == 'confirmada' ? 'CONFIRMADA' : 'CANCELADA' }}
                    </span>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a Reservas
                </a>
                @if($reserva->estado == 'confirmada')
                <button type="button" class="btn btn-danger" 
                        onclick="if(confirm('¿Cancelar esta reserva?')) document.getElementById('cancel-form').submit();">
                    <i class="fas fa-times"></i> Cancelar Reserva
                </button>
                <form id="cancel-form" action="{{ route('reservas.cancelar', $reserva->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection