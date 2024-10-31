<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClasesRequest extends FormRequest
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
      'clase' => 'required|string|min:5|unique:clases,clase'
    ];
  }

  public function messages(): array
  {
    return [
      'clase.required' => 'El nombre para la clase es obligatorio'
    ];
  }

  public function attributes(): array
  {
    return [
      'clase' => 'nombre de la clase',
    ];
  }
}
