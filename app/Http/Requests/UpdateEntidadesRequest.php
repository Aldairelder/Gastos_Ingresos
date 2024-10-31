<?php

namespace App\Http\Requests;

use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEntidadesRequest extends FormRequest
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
    $id = $this->route('id');
    return [
      'nrodoc'    => 'required|integer|unique:entidades,nrodoc,' . $id,
      'entidad'   => 'required|string|unique:entidades,entidad,' . $id,
      'direccion' => 'required',
      'telefono'  => 'required|string|unique:entidades,telefono,' . $id,
      'email'     => 'required|email|unique:entidades,email,' . $id,
    ];
  }

  public function messages(): array
  {
    return [
      'nrodoc'    => 'El Número de Identificación es obligatorio',
      'entidad'   => 'El Nombre de Entidad es obligatorio',
      'direccion' => 'La dirección es obligatorio',
      'telefono'  => 'El Telefonó es obligatorio',
      'email'     => 'El correo electronico es obligatorio'
    ];
  }

  public function attributes(): array
  {
    return [
      'nrodoc'    => 'numero de identificación',
      'entidad'   => 'numero de la entidad',
      'direccion' => 'direccion',
      'telefono'  => 'numero de telefono',
      'email'     => 'correo electronico'
    ];
  }
}
