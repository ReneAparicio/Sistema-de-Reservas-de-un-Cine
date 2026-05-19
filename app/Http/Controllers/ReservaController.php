<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $query = Reserva::with('funcion.pelicula');
        
        // BÚSQUEDA POR NOMBRE, EMAIL, CÓDIGO O PELÍCULA
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('cliente_nombre', 'LIKE', "%{$search}%")
                  ->orWhere('cliente_email', 'LIKE', "%{$search}%")
                  ->orWhere('codigo_reserva', 'LIKE', "%{$search}%")
                  ->orWhereHas('funcion.pelicula', function($pelicula) use ($search) {
                      $pelicula->where('titulo', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // FILTRO POR ESTADO
        if ($request->has('estado') && $request->estado != 'todos') {
            $query->where('estado', $request->estado);
        }
        
        // FILTRO POR FECHA - busca en la fecha de la FUNCIÓN
        if ($request->has('fecha') && !empty($request->fecha)) {
            $query->whereHas('funcion', function($funcion) use ($request) {
                $funcion->whereDate('fecha', $request->fecha);
            });
        }
        
        $reservas = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('reservas.index', compact('reservas'));
    }
    
    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);
        
        if ($reserva->estado == 'confirmada') {
            // Devolver los asientos a la función
            $funcion = $reserva->funcion;
            $funcion->asientos_disponibles += $reserva->cantidad_asientos;
            $funcion->save();
            
            // Cancelar reserva
            $reserva->estado = 'cancelada';
            $reserva->save();
            
            return redirect()->route('reservas.index')
                ->with('success', 'Reserva cancelada exitosamente');
        }
        
        return redirect()->route('reservas.index')
            ->with('error', 'No se puede cancelar esta reserva');
    }
    
    public function validar(Request $request)
    {
        $request->validate([
            'codigo_reserva' => 'required|string'
        ]);
        
        $reserva = Reserva::with('funcion.pelicula')
            ->where('codigo_reserva', $request->codigo_reserva)
            ->first();
        
        if (!$reserva) {
            return back()->with('error', '❌ Código de reserva no válido');
        }
        
        if ($reserva->estado == 'cancelada') {
            return back()->with('error', '❌ Esta reserva ha sido cancelada');
        }
        
        // Mensaje con formato HTML para SweetAlert
        $mensaje = "<div style='text-align: left;'>";
        $mensaje .= "<p><strong>👤 Cliente:</strong> {$reserva->cliente_nombre}</p>";
        $mensaje .= "<p><strong>🎬 Película:</strong> {$reserva->funcion->pelicula->titulo}</p>";
        $mensaje .= "<p><strong>📅 Fecha:</strong> " . \Carbon\Carbon::parse($reserva->funcion->fecha)->format('d/m/Y') . "</p>";
        $mensaje .= "<p><strong>⏰ Hora:</strong> " . \Carbon\Carbon::parse($reserva->funcion->hora)->format('h:i A') . "</p>";
        $mensaje .= "<p><strong>🎪 Sala:</strong> {$reserva->funcion->sala}</p>";
        $mensaje .= "<p><strong>🎫 Boletos:</strong> {$reserva->cantidad_asientos}</p>";
        $mensaje .= "<p><strong>🔑 Código:</strong> <code class='bg-dark p-1 rounded'>{$reserva->codigo_reserva}</code></p>";
        $mensaje .= "</div>";
        
        return back()->with('success', $mensaje);
    }
    
    // Ver detalle de una reserva específica
    public function show($id)
    {
        $reserva = Reserva::with('funcion.pelicula')->findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }
}