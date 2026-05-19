@extends('layouts.app')

@section('title', 'Editar ' . $pelicula->titulo)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Editar Película: {{ $pelicula->titulo }}</h4>
            </div>
            <div class="card-body">
                <!-- IMPORTANTE: Agregar enctype="multipart/form-data" -->
                <form action="{{ route('peliculas.update', $pelicula->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo', $pelicula->titulo) }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Género *</label>
                        <select class="form-control @error('genero') is-invalid @enderror" 
                                id="genero" name="genero" required>
                            <option value="">Seleccione...</option>
                            <option value="Acción" {{ old('genero', $pelicula->genero) == 'Acción' ? 'selected' : '' }}>Acción</option>
                            <option value="Comedia" {{ old('genero', $pelicula->genero) == 'Comedia' ? 'selected' : '' }}>Comedia</option>
                            <option value="Drama" {{ old('genero', $pelicula->genero) == 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Terror" {{ old('genero', $pelicula->genero) == 'Terror' ? 'selected' : '' }}>Terror</option>
                            <option value="Ciencia Ficción" {{ old('genero', $pelicula->genero) == 'Ciencia Ficción' ? 'selected' : '' }}>Ciencia Ficción</option>
                            <option value="Aventura" {{ old('genero', $pelicula->genero) == 'Aventura' ? 'selected' : '' }}>Aventura</option>
                        </select>
                        @error('genero')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="duracion" class="form-label">Duración (minutos) *</label>
                                <input type="number" class="form-control @error('duracion') is-invalid @enderror" 
                                       id="duracion" name="duracion" value="{{ old('duracion', $pelicula->duracion) }}" required>
                                @error('duracion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="clasificacion" class="form-label">Clasificación *</label>
                                <select class="form-control @error('clasificacion') is-invalid @enderror" 
                                        id="clasificacion" name="clasificacion" required>
                                    <option value="">Seleccione...</option>
                                    <option value="ATP" {{ old('clasificacion', $pelicula->clasificacion) == 'ATP' ? 'selected' : '' }}>ATP (Todos públicos)</option>
                                    <option value="+13" {{ old('clasificacion', $pelicula->clasificacion) == '+13' ? 'selected' : '' }}>Mayores de 13 años</option>
                                    <option value="+18" {{ old('clasificacion', $pelicula->clasificacion) == '+18' ? 'selected' : '' }}>Mayores de 18 años</option>
                                </select>
                                @error('clasificacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="sinopsis" class="form-label">Sinopsis</label>
                        <textarea class="form-control @error('sinopsis') is-invalid @enderror" 
                                  id="sinopsis" name="sinopsis" rows="3">{{ old('sinopsis', $pelicula->sinopsis) }}</textarea>
                        @error('sinopsis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CAMPO PARA SUBIR IMAGEN - ESTO ES LO QUE FALTABA -->
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Póster de la Película</label>
                        
                        <!-- Mostrar la imagen actual si existe -->
                        @if($pelicula->imagen)
                            <div class="mb-3 text-center">
                                <img src="{{ $pelicula->imagen_url }}" alt="Poster actual" 
                                     style="height: 200px; object-fit: cover; border-radius: 8px;">
                                <p class="text-muted small mt-1">Imagen actual</p>
                            </div>
                        @else
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle"></i> Esta película no tiene póster aún
                            </div>
                        @endif
                        
                        <input type="file" class="form-control @error('imagen') is-invalid @enderror" 
                               id="imagen" name="imagen" accept="image/*">
                        <small class="text-muted">
                            Formatos permitidos: JPG, PNG, GIF. Máximo 2MB.<br>
                            <strong>Dejar en blanco para mantener la imagen actual</strong>
                        </small>
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Película
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection