<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CineReservas - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .asientos-disponibles {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }
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
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="fas fa-film"></i> CineGestor - Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peliculas.index') }}">
                        <i class="fas fa-video"></i> Películas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('funciones.index') }}">
                        <i class="fas fa-calendar-alt"></i> Funciones
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reservas.index') }}">
                        <i class="fas fa-ticket-alt"></i> Reservas
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-4">
        <!-- ALERTAS NORMALES - NO se muestran si el mensaje contiene HTML (validación de reserva) -->
        @if(session('success') && !is_string(session('success')) || (is_string(session('success')) && !str_contains(session('success'), '<div')))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error') && (!is_string(session('error')) || !str_contains(session('error'), '<div')))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">© 2026 CineReservas - Sistema de Reservas de Boletos</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>