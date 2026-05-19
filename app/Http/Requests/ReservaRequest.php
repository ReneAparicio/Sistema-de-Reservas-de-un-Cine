<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_nombre' => 'required|min:3|max:100|regex:/^[a-zA-Záéíóúñ\s]+$/',
            'cliente_email' => 'required|email|max:100',
            'cantidad_asientos' => 'required|integer|min:1|max:10'
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_nombre.regex' => 'El nombre solo puede contener letras y espacios',
            'cliente_email.email' => 'Ingrese un correo electrónico válido',
            'cantidad_asientos.max' => 'Máximo 10 boletos por reserva'
        ];
    }
}