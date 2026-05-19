<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas'; // Especificar tabla
    
    protected $fillable = ['funcion_id', 'cliente_nombre', 'cliente_email', 'cantidad_asientos', 'codigo_reserva', 'estado'];

    public function funcion()
    {
        return $this->belongsTo(Funcion::class);
    }
}