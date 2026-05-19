@extends('layouts.app')

@section('title', $pelicula->titulo)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-film"></i> {{ $pelicula->titulo }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Género:</strong> {{ $pelicula->genero }}</p>
                        <p><strong>Duración:</strong> {{ $pelicula->duracion }} minutos</p>
                        <p><strong>Clasificación:</strong> {{ $pelicula->clasificacion }}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <strong>🎬 Funciones disponibles:</strong> {{ $pelicula->funciones->count() }}
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <h5>Sinopsis:</h5>
                    <p>{{ $pelicula->sinopsis ?: 'Sin sinopsis disponible' }}</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <a href="{{ route('peliculas.edit', $pelicula->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('peliculas.destroy', $pelicula->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta película?')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                    <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5><i class="fas fa-calendar-alt"></i> Próximas Funciones</h5>
            </div>
            <div class="card-body">
                @if($pelicula->funciones->count() > 0)
                    <ul class="list-group">
                        @foreach($pelicula->funciones->take(5) as $funcion)
                            <li class="list-group-item">
                                <strong>{{ $funcion->fecha }}</strong> - {{ $funcion->hora }}<br>
                                Sala: {{ $funcion->sala }} | Precio: ${{ $funcion->precio }}
                                <a href="{{ route('funciones.reservar', $funcion->id) }}" class="btn btn-sm btn-primary mt-2 w-100">
                                    <i class="fas fa-ticket-alt"></i> Reservar
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No hay funciones programadas</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection