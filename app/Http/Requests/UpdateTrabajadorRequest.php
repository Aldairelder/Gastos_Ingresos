<?php

namespace App\Http\Requests;

use App\Models\Trabajador;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTrabajadorRequest extends FormRequest
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
      'nrodoc'    => 'required|unique:trabajador,nrodoc,' . $id,
      'nombres'   => 'required',
      'apellidos' => 'required',
      'telefono'  => 'required|unique:trabajador,telefono,' . $id,
      'email'     => 'required|email|unique:trabajador,email,' . $id,
    ];
  }

  public function withValidator($validator)
  {
    $validator->after(function ($validator) {
      if ($this->isDuplicateName()) {
        $validator->errors()
          ->add('nombres', 'El trabajador con estos nombres y apellidos ya existe.')
          ->add('apellidos', 'El trabajador con estos nombres y apellidos ya existe.');;
      }
    });
  }

  protected function isDuplicateName()
  {
    $id = $this->route('id');
    return Trabajador::where('nombres', $this->nombres)
      ->where('apellidos', $this->apellidos)
      ->where('id', '!=', $id)
      ->exists();
  }

  public function messages(): array
  {
    return [
      'nrodoc.required'    => 'El número de identificación es obligatorio',
      'nombres.required'   => 'Los nombres del trabajador es obligatorio',
      'apellidos.required' => 'Los apellidos del trabajador es obligatorio',
      'telefono.required'  => 'El eelefonó es obligatorio',
      'email.required'     => 'El correo electronico es obligatorio'
    ];
  }

  public function attributes(): array
  {
    return [
      'nrodoc'    => 'número de identificación',
      'nombres'   => 'nombres del trabajador',
      'apellidos' => 'apellidos del trabajador',
      'telefono'  => 'numero de telefono',
      'email'     => 'correo electronico'
    ];
  }
}
