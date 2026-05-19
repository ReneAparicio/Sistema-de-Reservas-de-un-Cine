@extends('layouts.app')

@section('title', 'Todas las Reservas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-ticket-alt"></i> Todas las Reservas</h2>
    <span class="badge bg-primary fs-6">{{ $reservas->total() }} reservas totales</span>
</div>

<!-- BARRA DE BÚSQUEDA Y FILTROS -->
<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white">
        <h5><i class="fas fa-search"></i> Buscar Reservas</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('reservas.index') }}" class="row g-3">
            <div class="col-md-5">
                <label class="form-label fw-bold">🔍 Buscar por:</label>
                <input type="text" name="search" class="form-control form-control-lg" 
                       placeholder="Nombre, email, código o película..." 
                       value="{{ request('search') }}">
                <small class="text-muted">Ej: Carlos, cine.com, CINE-MAN-001, Inception</small>
            </div>
            
            <div class="col-md-3">
                <label class="form-label fw-bold">📌 Estado:</label>
                <select name="estado" class="form-select">
                    <option value="todos" {{ request('estado') == 'todos' ? 'selected' : '' }}>Todos</option>
                    <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmadas</option>
                    <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Canceladas</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <label class="form-label fw-bold">📅 Fecha:</label>
                <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
            </div>
            
            <div class="col-md-2 d-flex align-items-end">
                <div class="d-grid gap-2 w-100">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                    <a href="{{ route('reservas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Limpiar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- TABLA DE RESERVAS -->
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Película</th>
                        <th>Fecha/Hora</th>
                        <th>Sala</th>
                        <th>Boletos</th>
                        <th>Estado</th>
                        <th>Fecha Reserva</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $reserva)
                    <tr class="{{ $reserva->estado == 'cancelada' ? 'table-danger' : '' }}">
                        <td>
                            <code class="bg-light p-1 rounded">{{ $reserva->codigo_reserva }}</code>
                            <button class="btn btn-sm btn-outline-secondary ms-1" onclick="copiarCodigo('{{ $reserva->codigo_reserva }}')" title="Copiar código">
                                <i class="fas fa-copy"></i>
                            </button>
                        </td>
                        <td><strong>{{ $reserva->cliente_nombre }}</strong></td>
                        <td>{{ $reserva->cliente_email }}</td>
                        <td>{{ $reserva->funcion->pelicula->titulo }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($reserva->funcion->fecha)->format('d/m/Y') }}<br>
                            <small>{{ \Carbon\Carbon::parse($reserva->funcion->hora)->format('h:i A') }}</small>
                        </td>
                        <td>Sala {{ $reserva->funcion->sala }}</td>
                        <td>
                            <span class="badge bg-info">{{ $reserva->cantidad_asientos }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $reserva->estado == 'confirmada' ? 'bg-success' : 'bg-danger' }} fs-6">
                                {{ $reserva->estado == 'confirmada' ? '✓ Confirmada' : '✗ Cancelada' }}
                            </span>
                        </td>
                        <td>
                            <small>{{ $reserva->created_at->format('d/m/Y H:i') }}</small>
                        </td>
                        <td>
                            @if($reserva->estado == 'confirmada')
                            <button type="button" class="btn btn-sm btn-danger" 
                                    onclick="confirmarCancelacion('{{ $reserva->id }}', '{{ $reserva->cliente_nombre }}')">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <form id="cancelar-form-{{ $reserva->id }}" 
                                  action="{{ route('reservas.cancelar', $reserva->id) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted"></i>
                            <h5 class="text-muted mt-3">No se encontraron reservas</h5>
                            <p class="text-muted">Prueba con otros filtros de búsqueda</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- PAGINACIÓN CORREGIDA -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reservas->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<style>
/* Estilos para la paginación */
.pagination {
    display: flex;
    justify-content: center;
    gap: 5px;
    flex-wrap: wrap;
}

.pagination .page-item {
    margin: 0 2px;
}

.pagination .page-link {
    border-radius: 8px !important;
    padding: 8px 14px;
    font-size: 14px;
    color: #4a5568;
    background-color: #fff;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background-color: #667eea;
    color: white;
    border-color: #667eea;
    transform: translateY(-1px);
}

.pagination .active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: #667eea;
}

.pagination .disabled .page-link {
    color: #cbd5e0;
    background-color: #f7fafc;
    cursor: not-allowed;
}

.pagination .page-link i {
    font-size: 12px;
}
</style>

<script>
function copiarCodigo(codigo) {
    navigator.clipboard.writeText(codigo);
    alert('📋 Código copiado: ' + codigo);
}

function confirmarCancelacion(id, nombre) {
    if (confirm(`¿Estás seguro de cancelar la reserva de ${nombre}? Esta acción devolverá los asientos disponibles.`)) {
        document.getElementById(`cancelar-form-${id}`).submit();
    }
}
</script>
@endsection