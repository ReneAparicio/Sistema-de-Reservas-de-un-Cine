@extends('layouts.app')

@section('title', 'Editar Función')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Editar Función: {{ $funcion->pelicula->titulo }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('funciones.update', $funcion->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="pelicula_id" class="form-label">Película *</label>
                        <select class="form-control @error('pelicula_id') is-invalid @enderror" 
                                id="pelicula_id" name="pelicula_id" required>
                            <option value="">Seleccione una película...</option>
                            @foreach($peliculas as $pelicula)
                                <option value="{{ $pelicula->id }}" 
                                    {{ old('pelicula_id', $funcion->pelicula_id) == $pelicula->id ? 'selected' : '' }}>
                                    {{ $pelicula->titulo }}
                                </option>
                            @endforeach
                        </select>
                        @error('pelicula_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" name="fecha" value="{{ old('fecha', $funcion->fecha) }}" required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hora" class="form-label">Hora *</label>
                                <input type="time" class="form-control @error('hora') is-invalid @enderror" 
                                       id="hora" name="hora" value="{{ old('hora', $funcion->hora) }}" required>
                                @error('hora')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sala" class="form-label">Sala *</label>
                                <input type="number" class="form-control @error('sala') is-invalid @enderror" 
                                       id="sala" name="sala" value="{{ old('sala', $funcion->sala) }}" min="1" max="10" required>
                                @error('sala')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio $ *</label>
                                <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" 
                                       id="precio" name="precio" value="{{ old('precio', $funcion->precio) }}" required>
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="asientos_totales" class="form-label">Asientos Totales *</label>
                                <input type="number" class="form-control @error('asientos_totales') is-invalid @enderror" 
                                       id="asientos_totales" name="asientos_totales" value="{{ old('asientos_totales', $funcion->asientos_totales) }}" required>
                                @error('asientos_totales')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="asientos_disponibles" class="form-label">Asientos Disponibles *</label>
                        <input type="number" class="form-control @error('asientos_disponibles') is-invalid @enderror" 
                               id="asientos_disponibles" name="asientos_disponibles" value="{{ old('asientos_disponibles', $funcion->asientos_disponibles) }}" required>
                        @error('asientos_disponibles')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <a href="{{ route('funciones.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Función</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection