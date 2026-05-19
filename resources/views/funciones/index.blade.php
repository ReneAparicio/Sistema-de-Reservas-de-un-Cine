@extends('layouts.app')

@section('title', 'Funciones')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-calendar-alt"></i> Funciones de Cine</h2>
    <a href="{{ route('funciones.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Agregar Función
    </a>
</div>

<!-- Filtro rápido por fecha -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label fw-bold">🎬 Filtrar por fecha:</label>
                <select id="filtroFecha" class="form-select" onchange="filtrarPorFecha()">
                    <option value="hoy">📅 Hoy ({{ date('d/m/Y') }})</option>
                    <option value="manana">🌟 Mañana ({{ date('d/m/Y', strtotime('+1 day')) }})</option>
                    <option value="todas">🎞️ Todas las funciones</option>
                </select>
            </div>
        </div>
    </div>
</div>

@php
    $peliculasConFunciones = \App\Models\Pelicula::with(['funciones' => function($q) {
        $q->orderBy('fecha')->orderBy('hora');
    }])->get();
@endphp

@foreach($peliculasConFunciones as $pelicula)
    @if($pelicula->funciones->count() > 0)
    <div class="card shadow mb-4">
        <div class="card-header bg-gradient-primary text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="d-flex align-items-center">
                <img src="{{ $pelicula->imagen_url }}" 
                     alt="{{ $pelicula->titulo }}"
                     style="width: 50px; height: 70px; object-fit: cover; border-radius: 8px; margin-right: 15px;">
                <div>
                    <h4 class="mb-0">{{ $pelicula->titulo }}</h4>
                    <small>
                        <i class="fas fa-clock"></i> {{ $pelicula->duracion }} min | 
                        <i class="fas fa-tag"></i> {{ $pelicula->genero }} |
                        <i class="fas fa-certificate"></i> {{ $pelicula->clasificacion }}
                    </small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($pelicula->funciones->sortBy('fecha') as $funcion)
                <div class="col-md-6 col-lg-4 mb-3 funcion-item" data-fecha="{{ $funcion->fecha }}">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge bg-primary mb-2">
                                        <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($funcion->fecha)->format('d/m/Y') }}
                                    </span>
                                    <h5 class="mb-2">
                                        <i class="fas fa-clock text-primary"></i> {{ \Carbon\Carbon::parse($funcion->hora)->format('h:i A') }}
                                    </h5>
                                    <p class="mb-1">
                                        <i class="fas fa-video"></i> Sala {{ $funcion->sala }}<br>
                                        <i class="fas fa-dollar-sign text-success"></i> <strong>${{ number_format($funcion->precio, 2) }}</strong>
                                    </p>
                                    <div class="mt-2">
                                        <div class="progress" style="height: 8px;">
                                            @php
                                                $ocupacion = (($funcion->asientos_totales - $funcion->asientos_disponibles) / $funcion->asientos_totales) * 100;
                                            @endphp
                                            <div class="progress-bar {{ $ocupacion > 80 ? 'bg-danger' : ($ocupacion > 50 ? 'bg-warning' : 'bg-success') }}" 
                                                 style="width: {{ $ocupacion }}%"></div>
                                        </div>
                                        <small class="text-muted">
                                            💺 {{ $funcion->asientos_disponibles }}/{{ $funcion->asientos_totales }} disponibles
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100">
                                <a href="{{ route('funciones.reservar', $funcion->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-ticket-alt"></i> Reservar
                                </a>
                                <a href="{{ route('funciones.show', $funcion->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('funciones.edit', $funcion->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endforeach

@if($peliculasConFunciones->where('funciones')->count() == 0)
    <div class="alert alert-info text-center">
        <i class="fas fa-info-circle"></i> No hay mas funciones programadas
    </div>
@endif

<script>
function filtrarPorFecha() {
    const filtro = document.getElementById('filtroFecha').value;
    const hoy = '{{ date("Y-m-d") }}';
    const manana = '{{ date("Y-m-d", strtotime("+1 day")) }}';
    
    document.querySelectorAll('.funcion-item').forEach(item => {
        const fechaItem = item.getAttribute('data-fecha');
        
        if (filtro === 'hoy') {
            item.style.display = fechaItem === hoy ? '' : 'none';
        } else if (filtro === 'manana') {
            item.style.display = fechaItem === manana ? '' : 'none';
        } else {
            item.style.display = '';
        }
    });
}
</script>
@endsection