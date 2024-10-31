<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolResquest extends FormRequest
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
      'rol' => 'required|string|max:50|min:5|unique:rol,rol,null'
    ];
  }

  public function messages(): array
  {
    return [
      'rol.required' => 'El nombre para el rol es obligatorio.'
    ];
  }

  public function attributes(): array
  {
    return [
      'rol' => 'nombre del rol',
    ];
  }
}
