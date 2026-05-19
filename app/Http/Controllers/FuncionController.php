<?php

namespace App\Http\Controllers;

use App\Models\Funcion;
use App\Models\Pelicula;
use App\Models\Reserva;
use App\Http\Requests\FuncionRequest;
use App\Http\Requests\ReservaRequest;
use Illuminate\Http\Request;

class FuncionController extends Controller
{
    public function index()
    {
        $funciones = Funcion::with('pelicula')->get();
        return view('funciones.index', compact('funciones'));
    }

    public function create()
    {
        $peliculas = Pelicula::all();
        return view('funciones.create', compact('peliculas'));
    }

    public function store(FuncionRequest $request)
    {
        Funcion::create($request->validated());
        return redirect()->route('funciones.index')->with('success', 'Función creada exitosamente');
    }

    public function show($id)
    {
        $funcion = Funcion::with('pelicula', 'reservas')->findOrFail($id);
        return view('funciones.show', compact('funcion'));
    }

    public function edit($id)
    {
        $funcion = Funcion::findOrFail($id);
        $peliculas = Pelicula::all();
        return view('funciones.edit', compact('funcion', 'peliculas'));
    }

    public function update(FuncionRequest $request, $id)
    {
        $funcion = Funcion::findOrFail($id);
        $funcion->update($request->validated());
        return redirect()->route('funciones.index')->with('success', 'Función actualizada exitosamente');
    }

    public function destroy($id)
    {
        $funcion = Funcion::findOrFail($id);
        
        // Verificar si la función tiene reservas antes de eliminar
        if ($funcion->reservas()->count() > 0) {
            return redirect()->route('funciones.index')
                ->with('error', 'No se puede eliminar la función porque tiene reservas asociadas');
        }
        
        $funcion->delete();
        return redirect()->route('funciones.index')->with('success', 'Función eliminada exitosamente');
    }

    // Método adicional para mostrar formulario de reserva
    public function reservar($id)
    {
        $funcion = Funcion::with('pelicula')->findOrFail($id);
        
        // Verificar si hay asientos disponibles
        if ($funcion->asientos_disponibles <= 0) {
            return redirect()->route('funciones.show', $funcion->id)
                ->with('error', 'Lo sentimos, no hay asientos disponibles para esta función');
        }
        
        return view('funciones.reservar', compact('funcion'));
    }

    // Método para procesar la reserva
    public function procesarReserva(ReservaRequest $request, $id)
    {
        $funcion = Funcion::findOrFail($id);
        
        // Verificar si hay suficientes asientos
        if ($funcion->asientos_disponibles < $request->cantidad_asientos) {
            return back()->with('error', 'No hay suficientes asientos disponibles')
                ->withInput();
        }

        // Generar código único de reserva
        $codigo = 'CINE-' . strtoupper(uniqid());

        // Crear la reserva
        Reserva::create([
            'funcion_id' => $funcion->id,
            'cliente_nombre' => $request->cliente_nombre,
            'cliente_email' => $request->cliente_email,
            'cantidad_asientos' => $request->cantidad_asientos,
            'codigo_reserva' => $codigo,
            'estado' => 'confirmada'
        ]);

        // Actualizar asientos disponibles
        $funcion->asientos_disponibles -= $request->cantidad_asientos;
        $funcion->save();

        return redirect()->route('funciones.show', $funcion->id)
            ->with('success', '✅ Reserva creada exitosamente. Tu código es: ' . $codigo . ' - Preséntalo en la boletería.');
    }
}