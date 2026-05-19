@extends('layouts.app')

@section('title', 'Agregar Película')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-plus"></i> Agregar Nueva Película</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('peliculas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Género *</label>
                        <select class="form-control @error('genero') is-invalid @enderror" 
                                id="genero" name="genero" required>
                            <option value="">Seleccione...</option>
                            <option value="Acción">Acción</option>
                            <option value="Comedia">Comedia</option>
                            <option value="Drama">Drama</option>
                            <option value="Terror">Terror</option>
                            <option value="Ciencia Ficción">Ciencia Ficción</option>
                            <option value="Aventura">Aventura</option>
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
                                       id="duracion" name="duracion" value="{{ old('duracion') }}" required>
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
                                    <option value="ATP">ATP (Todos públicos)</option>
                                    <option value="+13">Mayores de 13 años</option>
                                    <option value="+18">Mayores de 18 años</option>
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
                                  id="sinopsis" name="sinopsis" rows="3">{{ old('sinopsis') }}</textarea>
                        @error('sinopsis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Póster de la Película</label>
                        <input type="file" class="form-control @error('imagen') is-invalid @enderror" 
                               id="imagen" name="imagen" accept="image/*">
                        <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Máximo 2MB</small>
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Película</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection