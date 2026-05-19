<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pelicula extends Model
{
    protected $table = 'peliculas'; // Especificar tabla
    
    protected $fillable = ['titulo', 'genero', 'duracion', 'clasificacion', 'sinopsis', 'imagen'];

    public function funciones()
    {
        return $this->hasMany(Funcion::class);
    }
    
    public function getImagenUrlAttribute()
    {
        if ($this->imagen && Storage::disk('public')->exists($this->imagen)) {
            return asset('storage/' . $this->imagen);
        }
        return 'https://via.placeholder.com/300x450?text=Sin+Póster';
    }
}