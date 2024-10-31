<?php

namespace App\Http\Requests;

use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Foundation\Http\FormRequest;

class StoreEntidadesRequest extends FormRequest
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
      'nrodoc'    => 'required|string|unique:entidades,nrodoc',
      'entidad'   => 'required|string|unique:entidades,entidad',
      'direccion' => 'required',
      'telefono'  => 'required|string|unique:entidades,telefono',
      'email'     => 'required|email|unique:entidades,email'
    ];
  }

  public function messages(): array
  {
    return [
      'nrodoc.required'    => 'El número de identificación es obligatorio',
      'entidad.required'   => 'El nombre de Entidad es obligatorio',
      'direccion.required' => 'La dirección es obligatorio',
      'telefono.required'  => 'El telefonó es obligatorio',
      'email.required'     => 'El correo electronico es obligatorio'
    ];
  }

  public function attributes(): array
  {
    return [
      'nrodoc'    => 'numero de identificación',
      'entidad'   => 'nombre de la entidad',
      'direccion' => 'direccion',
      'telefono'  => 'numero de telefono',
      'email'     => 'correo electronico'
    ];
  }
}
