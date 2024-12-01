<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresosRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'idclase'             => 'required|integer',
      'identidad'           => 'required|integer',
      'nrodoc'              => 'required|string|max:15',
      'titulo'              => 'required|string|max:255',
      'descripcion'         => 'nullable|string',
      'total'               => 'required|numeric',
      'archivo'             => 'nullable|file|mimes:pdf,jpg,png,docx|max:10240', // Validación para el archivo
      'detalles.*.detalle'  => 'required|string|max:255',
      'detalles.*.cantidad' => 'required|integer',
      'detalles.*.precio'   => 'required|numeric',
    ];
  }

  /**
   * Custom messages for validation errors.
   */
  public function messages(): array
  {
    return [
      'idclase.required'    => 'Seleccionar una clase',
      'identidad.required'  => 'Seleccionar una entidad',
      'titulo.required'     => 'Introducir un nombre para este ingreso',
      'archivo.mimes'       => 'El archivo debe ser de tipo: pdf, jpg, png, docx.',
      'archivo.max'         => 'El archivo no debe exceder los 10MB.',
    ];
  }

  /**
   * Custom attribute names for validation.
   */
  public function attributes(): array
  {
    return [
      'idclase'   => 'seleccionar una clase',
      'identidad' => 'seleccionar una entidad',
      'titulo'    => 'nombre del ingreso',
      'archivo'   => 'archivo adjunto',
    ];
  }
}
