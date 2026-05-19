<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Http\Requests\PeliculaRequest;
use Illuminate\Support\Facades\Storage;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return view('peliculas.index', compact('peliculas'));
    }

    public function create()
    {
        return view('peliculas.create');
    }

    public function store(PeliculaRequest $request)
    {
        $data = $request->validated();
        
        // Subir imagen si existe
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('peliculas', 'public');
        }
        
        Pelicula::create($data);
        return redirect()->route('peliculas.index')->with('success', 'Película creada exitosamente');
    }

    public function show($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('peliculas.show', compact('pelicula'));
    }

    public function edit($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('peliculas.edit', compact('pelicula'));
    }

    public function update(PeliculaRequest $request, $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $data = $request->validated();
        
        // Subir nueva imagen si existe
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($pelicula->imagen) {
                Storage::disk('public')->delete($pelicula->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('peliculas', 'public');
        }
        
        $pelicula->update($data);
        return redirect()->route('peliculas.index')->with('success', 'Película actualizada exitosamente');
    }

    public function destroy($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        
        // Eliminar la imagen asociada
        if ($pelicula->imagen) {
            Storage::disk('public')->delete($pelicula->imagen);
        }
        
        $pelicula->delete();
        return redirect()->route('peliculas.index')->with('success', 'Película eliminada exitosamente');
    }
}