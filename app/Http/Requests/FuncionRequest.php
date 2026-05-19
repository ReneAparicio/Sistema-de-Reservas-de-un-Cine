<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelicula_id' => 'required|exists:peliculas,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'sala' => 'required|integer|min:1|max:10',
            'precio' => 'required|numeric|min:0|max:100',
            'asientos_totales' => 'required|integer|min:1|max:200',
            'asientos_disponibles' => 'required|integer|min:0|lte:asientos_totales'
        ];
    }

    public function messages(): array
    {
        return [
            'fecha.after_or_equal' => 'La fecha no puede ser anterior a hoy',
            'sala.min' => 'La sala debe ser entre 1 y 10',
            'asientos_disponibles.lte' => 'Los asientos disponibles no pueden superar los totales'
        ];
    }
}