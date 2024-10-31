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
      'detalles.*.detalle'  => 'required|string|max:255',
      'detalles.*.cantidad' => 'required|integer',
      'detalles.*.precio'   => 'required|numeric',
    ];
  }

  public function messages(): array
  {
    return [
      'idclase.required'   => 'Seleccionar una clase',
      'identidad.required' => 'Seleccionar una entidad',
      'titulo.required'    => 'Introducir un nombre para este ingreso'
    ];
  }

  public function attributes(): array
  {
    return [
      'idclase'   => 'seleccionar una clase',
      'identidad' => 'seleccionar una entidad',
      'titulo'    => 'nombre del ingreso',
    ];
  }
}
