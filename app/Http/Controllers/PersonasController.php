<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntidadesRequest;
use App\Http\Requests\UpdateEntidadesRequest;
use App\Models\Entidades;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonasController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $personas = Entidades::where('estado', '=', 1)
      ->where('tipo', '=', 'P')
      ->orderby('id', 'DESC')
      ->get();
    return view('personas.index', compact('personas'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('personas.forms.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreEntidadesRequest $request)
  {
    try {
      DB::beginTransaction();
      $request->merge(['tipo' => 'P']);
      Entidades::create($request->all());
      DB::commit();
      return redirect()->route('personas')->with('success', 'Registrado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('personas')->with('error', $e->getMessage());
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $persona = Entidades::findOrFail($id);
    return view('personas.forms.update', compact('persona'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateEntidadesRequest $request, string $id)
  {
    try {
      DB::beginTransaction();
      $persona = Entidades::findOrFail($id);
      $persona->update($request->all());
      DB::commit();
      return redirect()->route('personas')->with('success', 'Modificado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('personas')->with('error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $persona = Entidades::findOrFail($id);
      $persona->estado = '0';
      $persona->update();
      DB::commit();
      return redirect()->route('personas')->with('success', 'Eliminado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('personas')->with('error', $e->getMessage());
    }
  }
}
