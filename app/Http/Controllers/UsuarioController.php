<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Roles;
use App\Models\Trabajador;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $usuarios = User::where('id', '!=', Auth::id())
      ->where('id', '!=', 1)
      ->select('id', 'usuario', 'estado', 'created_at')
      ->orderBy('id', 'DESC')
      ->get();
    return view('usuarios.index', compact('usuarios'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $trabajadores = Trabajador::doesntHave('usuario')
      ->orderBy('nombres', 'DESC')
      ->get();
    $roles = Roles::where('estado', '=', 1)
      ->orderBy('rol', 'DESC')
      ->get();
    return view('usuarios.forms.create', compact('trabajadores', 'roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      DB::beginTransaction();
      User::create([
        'idrol' => $request->idrol,
        'idtrabajador' => $request->idtrabajador,
        'usuario' => $request->usuario,
        'password' => Hash::make($request->password),
        'estado' => 0
      ]);
      DB::commit();
      return redirect()->route('usuarios')->with('success', 'Registrado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('usuarios')->with('success', $e->getMessage());
    }
  }

  public function show(string $id)
  {
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $usuarios = User::findOrFail($id);
      $usuarios->estado = 0;
      $usuarios->update();
      DB::commit();
      return redirect()->route('usuarios')->with('success', 'Desactivado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('usuarios')->with('error', $e->getMessage());
    }
  }

  public function active(string $id)
  {
    try {
      DB::beginTransaction();
      $usuarios = User::findOrFail($id);
      $usuarios->estado = 1;
      $usuarios->update();
      DB::commit();
      return redirect()->route('usuarios')->with('success', 'Activado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('usuarios')->with('error', $e->getMessage());
    }
  }
}
