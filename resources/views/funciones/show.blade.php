@extends('layouts.app')

@section('title', 'Función - ' . $funcion->pelicula->titulo)

@section('content')
<div class="row">
    <!-- COLUMNA DE LA IMAGEN DEL PÓSTER -->
    <div class="col-md-4">
        <div class="card shadow-lg border-0">
            <div class="card-img-top-wrapper" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-radius: 10px; overflow: hidden;">
                <img src="{{ $funcion->pelicula->imagen_url }}" 
                     class="card-img-top" 
                     alt="{{ $funcion->pelicula->titulo }}"
                     style="width: 100%; height: 450px; object-fit: cover; object-position: center;">
            </div>
            <div class="card-body text-center bg-dark text-white rounded-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-star text-warning"></i>
                    {{ $funcion->pelicula->genero }}
                    <i class="fas fa-star text-warning"></i>
                </h5>
                <small class="text-muted">
                    <i class="fas fa-clock"></i> {{ $funcion->pelicula->duracion }} minutos
                    <i class="fas fa-certificate ms-2"></i> {{ $funcion->pelicula->clasificacion }}
                </small>
            </div>
        </div>
    </div>

    <!-- COLUMNA DE LA INFORMACIÓN DE LA FUNCIÓN -->
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h4><i class="fas fa-film"></i> {{ $funcion->pelicula->titulo }}</h4>
                <p class="mb-0 small">{{ $funcion->pelicula->sinopsis ? Str::limit($funcion->pelicula->sinopsis, 100) : 'Sin sinopsis disponible' }}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box p-3 rounded" style="background: #f8f9fa;">
                            <p class="mb-2"><strong><i class="fas fa-calendar-alt text-primary"></i> Fecha:</strong> {{ \Carbon\Carbon::parse($funcion->fecha)->format('d/m/Y') }}</p>
                            <p class="mb-2"><strong><i class="fas fa-clock text-primary"></i> Hora:</strong> {{ \Carbon\Carbon::parse($funcion->hora)->format('h:i A') }}</p>
                            <p class="mb-2"><strong><i class="fas fa-video text-primary"></i> Sala:</strong> Sala {{ $funcion->sala }}</p>
                            <p class="mb-0"><strong><i class="fas fa-dollar-sign text-primary"></i> Precio:</strong> ${{ number_format($funcion->precio, 2) }} por boleto</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert {{ $funcion->asientos_disponibles > 10 ? 'alert-success' : ($funcion->asientos_disponibles > 0 ? 'alert-warning' : 'alert-danger') }} text-center shadow-sm">
                            <i class="fas fa-chair fa-2x"></i>
                            <h3 class="mb-0 mt-2">{{ $funcion->asientos_disponibles }}</h3>
                            <strong>Asientos Disponibles</strong>
                            <hr class="my-2">
                            <small>Total: {{ $funcion->asientos_totales }} asientos</small>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 p-3 rounded" style="background: #e8f4f8;">
                    <h5><i class="fas fa-info-circle text-info"></i> Sinopsis Completa:</h5>
                    <p class="mb-0">{{ $funcion->pelicula->sinopsis ?: 'Sin sinopsis disponible' }}</p>
                </div>

                <!-- Progreso de ocupación -->
                <div class="mt-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-chart-line"></i> Ocupación de la Sala
                    </label>
                    <div class="progress" style="height: 25px;">
                        @php
                            $ocupacion = (($funcion->asientos_totales - $funcion->asientos_disponibles) / $funcion->asientos_totales) * 100;
                        @endphp
                        <div class="progress-bar {{ $ocupacion > 80 ? 'bg-danger' : ($ocupacion > 50 ? 'bg-warning' : 'bg-success') }}"
                             role="progressbar"
                             style="width: {{ $ocupacion }}%;"
                             aria-valuenow="{{ $ocupacion }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {{ number_format($ocupacion, 1) }}% Ocupado
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="btn-group w-100" role="group">
                    @if($funcion->asientos_disponibles > 0)
                        <a href="{{ route('funciones.reservar', $funcion->id) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-ticket-alt"></i> Reservar Boletos
                        </a>
                    @endif
                    <a href="{{ route('funciones.edit', $funcion->id) }}" class="btn btn-warning btn-lg">
                        <i class="fas fa-edit"></i> Editar Función
                    </a>
                    <form action="{{ route('funciones.destroy', $funcion->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('¿Eliminar esta función? Se eliminarán también todas las reservas asociadas.')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                    <a href="{{ route('funciones.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECCIÓN DE RESERVAS REALIZADAS -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-info text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <h5><i class="fas fa-users"></i> Reservas Realizadas para esta Función</h5>
                <small>Total: {{ $funcion->reservas->count() }} reservas | {{ $funcion->reservas->sum('cantidad_asientos') }} boletos vendidos</small>
            </div>
            <div class="card-body">
                @if($funcion->reservas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Cliente</th>
                                    <th>Email</th>
                                    <th>Boletos</th>
                                    <th>Fecha Reserva</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($funcion->reservas as $reserva)
                                <tr>
                                    <td><code class="bg-light p-1 rounded">{{ $reserva->codigo_reserva }}</code></td>
                                    <td><strong>{{ $reserva->cliente_nombre }}</strong></td>
                                    <td>{{ $reserva->cliente_email }}</td>
                                    <td><span class="badge bg-primary">{{ $reserva->cantidad_asientos }}</span></td>
                                    <td><small>{{ $reserva->created_at->format('d/m/Y H:i') }}</small></td>
                                    <td>
                                        <span class="badge {{ $reserva->estado == 'confirmada' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $reserva->estado }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($reserva->estado == 'confirmada')
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    onclick="confirmarCancelacion('{{ $reserva->id }}', '{{ $reserva->cliente_nombre }}')">
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                            <form id="cancelar-form-{{ $reserva->id }}" 
                                                  action="{{ route('reservas.cancelar', $reserva->id) }}" 
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-ticket-alt fa-4x text-muted"></i>
                        <h5 class="text-muted mt-3">No hay reservas para esta función</h5>
                        <p class="text-muted">¡Anímate y haz la primera reserva!</p>
                        <a href="{{ route('funciones.reservar', $funcion->id) }}" class="btn btn-primary">
                            <i class="fas fa-ticket-alt"></i> Reservar Boletos
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmarCancelacion(id, nombre) {
    if (confirm(`¿Estás seguro de cancelar la reserva de ${nombre}?`)) {
        document.getElementById(`cancelar-form-${id}`).submit();
    }
}
</script>
@endpush
@endsection