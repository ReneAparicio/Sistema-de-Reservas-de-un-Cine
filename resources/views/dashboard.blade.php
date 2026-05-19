@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
<!-- Tarjetas de resumen -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-gradient-primary text-white shadow" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Películas</h6>
                        <h2 class="mb-0">{{ DB::table('peliculas')->count() }}</h2>
                    </div>
                    <i class="fas fa-film fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-gradient-success text-white shadow" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Funciones Hoy</h6>
                        <h2 class="mb-0">{{ DB::table('funciones')->whereDate('fecha', today())->count() }}</h2>
                    </div>
                    <i class="fas fa-calendar-day fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-gradient-warning text-white shadow" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Asientos Vendidos</h6>
                        <h2 class="mb-0">
                            @php
                                $vendidos = DB::table('reservas')
                                    ->where('estado', 'confirmada')
                                    ->sum('cantidad_asientos');
                            @endphp
                            {{ $vendidos }}
                        </h2>
                    </div>
                    <i class="fas fa-chair fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-gradient-info text-white shadow" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Ingresos Estimados</h6>
                        <h2 class="mb-0">
                            @php
                                $ingresos = DB::table('reservas')
                                    ->join('funciones', 'reservas.funcion_id', '=', 'funciones.id')
                                    ->where('reservas.estado', 'confirmada')
                                    ->sum(DB::raw('reservas.cantidad_asientos * funciones.precio'));
                            @endphp
                            ${{ number_format($ingresos, 0) }}
                        </h2>
                    </div>
                    <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Funciones del día -->
<div class="row">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5><i class="fas fa-clock"></i> Funciones de Hoy</h5>
            </div>
            <div class="card-body">
                @php
                    $funcionesHoy = DB::table('funciones')
                        ->join('peliculas', 'funciones.pelicula_id', '=', 'peliculas.id')
                        ->whereDate('funciones.fecha', today())
                        ->orderBy('funciones.hora')
                        ->select('funciones.*', 'peliculas.titulo as pelicula_titulo', 'peliculas.imagen')
                        ->get();
                @endphp
                
                @if($funcionesHoy->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Póster</th>
                                    <th>Película</th>
                                    <th>Hora</th>
                                    <th>Sala</th>
                                    <th>Disponibles</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($funcionesHoy as $funcion)
                                <tr>
                                    <td width="50">
                                        <img src="{{ $funcion->imagen ? asset('storage/' . $funcion->imagen) : 'https://via.placeholder.com/50x70' }}" 
                                             style="width: 40px; height: 50px; object-fit: cover; border-radius: 5px;">
                                    </td>
                                    <td>{{ $funcion->pelicula_titulo }}</td>
                                    <td><strong>{{ \Carbon\Carbon::parse($funcion->hora)->format('h:i A') }}</strong></td>
                                    <td>Sala {{ $funcion->sala }}</td>
                                    <td>
                                        <span class="badge {{ $funcion->asientos_disponibles > 10 ? 'bg-success' : ($funcion->asientos_disponibles > 0 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $funcion->asientos_disponibles }}/{{ $funcion->asientos_totales }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('funciones.reservar', $funcion->id) }}" class="btn btn-primary">
                                                <i class="fas fa-ticket-alt"></i> Reservar
                                            </a>
                                            <a href="{{ route('funciones.show', $funcion->id) }}" class="btn btn-info">
                                                <i class="fas fa-users"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-info-circle"></i> No hay funciones programadas para hoy
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Últimas reservas -->
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5><i class="fas fa-receipt"></i> Últimas Reservas</h5>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                @php
                    $ultimasReservas = DB::table('reservas')
                        ->join('funciones', 'reservas.funcion_id', '=', 'funciones.id')
                        ->join('peliculas', 'funciones.pelicula_id', '=', 'peliculas.id')
                        ->orderBy('reservas.created_at', 'desc')
                        ->limit(10)
                        ->select('reservas.*', 'funciones.hora', 'peliculas.titulo as pelicula_titulo')
                        ->get();
                @endphp
                
                @forelse($ultimasReservas as $reserva)
                <div class="border-bottom mb-3 pb-3">
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">{{ \Carbon\Carbon::parse($reserva->created_at)->format('d/m/Y H:i') }}</small>
                        <span class="badge bg-success">{{ $reserva->estado }}</span>
                    </div>
                    <p class="mb-0 fw-bold">{{ $reserva->cliente_nombre }}</p>
                    <small class="text-muted">{{ $reserva->pelicula_titulo }} - {{ \Carbon\Carbon::parse($reserva->hora)->format('h:i A') }}</small>
                    <br>
                    <small class="text-primary">
                        <i class="fas fa-ticket"></i> {{ $reserva->cantidad_asientos }} boletos
                    </small>
                    <br>
                    <small class="text-success">Código: <code>{{ $reserva->codigo_reserva }}</code></small>
                </div>
                @empty
                    <div class="text-center py-3">
                        <i class="fas fa-inbox fa-3x text-muted"></i>
                        <p class="text-muted mt-2">No hay reservas aún</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Validar reserva rápida -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow bg-gradient-dark" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center text-white">
                        <i class="fas fa-qrcode fa-3x"></i>
                        <h5 class="mt-2 mb-0">Validar Reserva</h5>
                    </div>
                    <div class="col-md-9">
                        <form action="{{ route('validar.reserva') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" 
                                       name="codigo_reserva" placeholder="Ingrese el código de reserva (ej: CINE-ABC123)" required>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-circle"></i> Validar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recomendadas (solo 4 películas) -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5><i class="fas fa-star"></i> Recomendadas</h5>
                <p class="mb-0 small">Las más vistas de la semana</p>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        // Limitar a 4 películas recomendadas
                        $peliculasRecomendadas = DB::table('peliculas')->limit(4)->get();
                    @endphp
                    
                    @foreach($peliculasRecomendadas as $pelicula)
                    <div class="col-md-3 text-center mb-3">
                        <div class="position-relative">
                            <img src="{{ $pelicula->imagen ? asset('storage/' . $pelicula->imagen) : 'https://via.placeholder.com/150x200?text=Cine' }}" 
                                 style="width: 120px; height: 160px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                            <div class="position-absolute top-0 start-0 bg-danger text-white rounded px-2 py-1 small" style="margin: -5px 0 0 -5px;">
                                <i class="fas fa-fire"></i>
                            </div>
                        </div>
                        <h6 class="mt-2 mb-0">{{ $pelicula->titulo }}</h6>
                        <small class="text-muted">
                            <i class="fas fa-star text-warning"></i> 
                            <i class="fas fa-star text-warning"></i> 
                            <i class="fas fa-star text-warning"></i> 
                            <i class="fas fa-star text-warning"></i> 
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SWEETALERT PARA VALIDACIÓN -->
@if(session('success') && (str_contains(session('success'), 'Cliente:') || str_contains(session('success'), 'Reserva creada') || str_contains(session('success'), 'exitosamente')))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: '✅ Éxito',
        html: `{!! session('success') !!}`,
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        background: '#1a1a2e',
        color: '#fff',
        iconColor: '#00ff88'
    });
</script>
@elseif(session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: '❌ Error',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif
@endsection