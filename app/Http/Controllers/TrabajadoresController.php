<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrabajadorRequest;
use App\Http\Requests\UpdateTrabajadorRequest;
use App\Models\Trabajador;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrabajadoresController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $idusers = Auth::id();
    $idtrabajador  = User::where('idtrabajador', $idusers)->value('id');
    $trabajadores = Trabajador::with('usuario')
      ->where('estado', 1)
      ->where('id', '!=', $idtrabajador)
      ->where('id', '!=', 1)
      ->orderByDesc('id')
      ->get();
    return view('trabajadores.index', compact('trabajadores'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('trabajadores.forms.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreTrabajadorRequest $request)
  {
    try {
      DB::beginTransaction();
      Trabajador::create($request->all());
      DB::commit();
      return redirect()->route('trabajadores')->with('success', 'Registrado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('trabajadores')->with('error', $e->getMessage());
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $trabajador = Trabajador::findOrFail($id);
    return view('trabajadores.forms.update', compact('trabajador'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateTrabajadorRequest $request, string $id)
  {
    try {
      DB::beginTransaction();
      $trabajador = Trabajador::findOrFail($id);
      $trabajador->update($request->all());
      DB::commit();
      return redirect()->route('trabajadores')->with('success', 'Modificado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('trabajadores')->with('success', $e->getMessage());
    }
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $trabajador = Trabajador::findOrFail($id);
      $trabajador->estado = 0;
      $trabajador->update();
      DB::commit();
      return redirect()->route('trabajadores')->with('success', 'Eliminado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('trabajadores')->with('error', $e->getMessage());
    }
  }
}
