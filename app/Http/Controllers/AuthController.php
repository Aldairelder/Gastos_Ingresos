<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }

  public function loginAction(request $request)
  {
    // VALIDAR LAS CAJAS DE TEXTO -> name="NombreCajatexto"
    Validator::make($request->all(), [
      'usuario'  => 'required',
      'password' => 'required',
    ])->validate();

    $credentials = [
      'usuario'  => $request->input('usuario'),
      'password' => $request->input('password'),
    ];

    if (!Auth::attempt($credentials, $request->boolean('remember'))) {
      throw ValidationException::withMessages([
        'usuario' => trans('auth.failed'),
      ]);
    }

    $request->session()->regenerate();

    // Obtener los datos del personal de acuerdo al usuario logeado
    $user = Auth::user();
    $user->load('trabajador');

    // Puedes acceder a los datos de personal usando $user->personal
    // Ejemplo: $user->personal->nombres, $user->personal->apellidos, etc.

    return redirect()->route('dashboard', ['user' => $user]);
  }

  public function logout(request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    return redirect('/');
  }

  public function profile()
  {
    return view('profile');
  }
}
