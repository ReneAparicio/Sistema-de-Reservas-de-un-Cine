<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    protected $table = 'funciones'; // Especificar tabla
    
    protected $fillable = ['pelicula_id', 'fecha', 'hora', 'sala', 'precio', 'asientos_totales', 'asientos_disponibles'];

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}