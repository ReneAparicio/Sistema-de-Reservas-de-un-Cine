<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeliculaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|min:3|max:150|unique:peliculas,titulo,' . $this->pelicula,
            'genero' => 'required|in:Acción,Comedia,Drama,Terror,Ciencia Ficción,Aventura',
            'duracion' => 'required|integer|min:1|max:300',
            'clasificacion' => 'required|in:ATP,+13,+18',
            'sinopsis' => 'nullable|string|max:1000',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio',
            'titulo.unique' => 'Ya existe una película con ese título',
            'genero.required' => 'Debe seleccionar un género',
            'duracion.min' => 'La duración debe ser al menos 1 minuto',
            'clasificacion.required' => 'Debe seleccionar una clasificación',
            'imagen.image' => 'El archivo debe ser una imagen',
            'imagen.mimes' => 'La imagen debe ser JPG, PNG, GIF o JPEG',
            'imagen.max' => 'La imagen no debe superar los 2MB'
        ];
    }
}