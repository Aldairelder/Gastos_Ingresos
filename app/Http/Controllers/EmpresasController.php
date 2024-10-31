<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntidadesRequest;
use App\Http\Requests\UpdateEntidadesRequest;
use App\Models\Entidades;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $empresas = Entidades::where('estado', '=', 1)
      ->where('tipo', '=', 'E')
      ->orderby('id', 'DESC')
      ->get();
    return view('empresas.index', compact('empresas'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('empresas.forms.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreEntidadesRequest $request)
  {
    try {
      DB::beginTransaction();
      $request->merge(['tipo' => 'E']);
      Entidades::create($request->all());
      DB::commit();
      return redirect()->route('empresas')->with('success', 'Registrado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('empresas')->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $empresa = Entidades::findOrFail($id);
    return view('empresas.forms.update', compact('empresa'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateEntidadesRequest $request, string $id)
  {
    try {
      DB::beginTransaction();
      $empresa = Entidades::findOrFail($id);
      $empresa->update($request->all());
      DB::commit();
      return redirect()->route('empresas')->with('success', 'Modificado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('empresas')->with('error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $empresa = Entidades::findOrFail($id);
      $empresa->estado = '0';
      $empresa->update();
      DB::commit();
      return redirect()->route('empresas')->with('success', 'Eliminado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('empresas')->with('error', $e->getMessage());
    }
  }
}
