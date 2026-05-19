@extends('layouts.app')

@section('title', 'Películas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-video"></i> Catálogo de Películas</h2>
    <a href="{{ route('peliculas.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nueva Película
    </a>
</div>

<div class="row">
    @foreach($peliculas as $pelicula)
    <div class="col-md-4 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm">
            <!-- IMAGEN ARRIBA - ESTO ES LO NUEVO -->
            <div class="card-img-top-wrapper" style="height: 350px; overflow: hidden; background: #000;">
                <img src="{{ $pelicula->imagen_url }}" 
                     class="card-img-top w-100 h-100" 
                     alt="{{ $pelicula->titulo }}" 
                     style="object-fit: cover; object-position: center;">
            </div>
            
            <div class="card-body">
                <h5 class="card-title text-truncate">{{ $pelicula->titulo }}</h5>
                <p class="card-text small">
                    <strong>🎭 Género:</strong> {{ $pelicula->genero }}<br>
                    <strong>⏱️ Duración:</strong> {{ $pelicula->duracion }} min<br>
                    <strong>🔞 Clasificación:</strong> {{ $pelicula->clasificacion }}
                </p>
            </div>
            <div class="card-footer bg-transparent">
                <div class="btn-group w-100" role="group">
                    <a href="{{ route('peliculas.show', $pelicula->id) }}" class="btn btn-sm btn-outline-info">
                        <i class="fas fa-eye"></i> Ver
                    </a>
                    <a href="{{ route('peliculas.edit', $pelicula->id) }}" class="btn btn-sm btn-outline-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('peliculas.destroy', $pelicula->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar esta película?')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection