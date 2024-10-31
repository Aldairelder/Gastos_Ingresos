<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasesRequest;
use App\Http\Requests\StoreClasesRequest;
use App\Http\Requests\UpdateClasesRequest;
use App\Models\Clases;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $clases = Clases::where('estado', '=', 1)->orderby('id', 'DESC')->get();
    return view('clases.index', compact('clases'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('clases.forms.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreClasesRequest $request)
  {
    try {
      DB::beginTransaction();
      Clases::create($request->all());
      DB::commit();
      return redirect()->route('clases')->with('success', 'Registrado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('clases')->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $clase = Clases::findOrFail($id);
    return view('clases.forms.update', compact('clase'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateClasesRequest $request, string $id)
  {
    try {
      DB::beginTransaction();
      $clase = Clases::findOrFail($id);
      $clase->update($request->all());
      DB::commit();
      return redirect()->route('clases')->with('success', 'Modificado Correctamente!');
    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->route('clases')->with('error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $clase = Clases::findOrFilf($id);
      $clase->estado = '0';
      $clase->update();
      return redirect()->route('clases')->with('success', 'Eliminado Correctamente!');
      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->route('clases')->with('error', $e->getMessage());
    }
  }
}
