<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastosRequest;
use App\Models\Clases;
use App\Models\Gastos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GastosController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $gastos = Gastos::orderby('id', 'DESC')
      ->get();
    return view('gastos.index', compact('gastos'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $clases = Clases::where('estado', '=', 1)->orderBy('id', 'DESC')->get();
    $conteo = Gastos::count() + 1;
    $tiempo = date('Ymd') . $conteo;
    return view('gastos.forms.create', compact('clases', 'tiempo'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(GastosRequest $request)
  {
    try {
      DB::beginTransaction();
      // Crear el gasto principal
      // $gasto = Gastos::create($request->only([
      //     'idclase','nrodoc', 'titulo', 'descripcion', 'total'
      // ]));
      $data = $request->all();
      $data['serie'] = '001';
      $gasto = Gastos::create($data);
      // Crear los detalles del gasto
      foreach ($request->detalles as $detalle) {
        $gasto->detalles()->create($detalle);
      }
      DB::commit();
      return redirect()->route('gastos')->with('success', 'Registrado Correctamente!');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->route('gastos')->with('error', $e->getMessage());
      // dd($e->getMessage());
      // dd($request->all());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $gastos = Gastos::with('clase')->findOrFail($id);
    return view('gastos.show', compact('gastos'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $gastos = Gastos::findOrFail($id);
      $gastos->estado = '0';
      $gastos->update();
      DB::commit();
      return redirect()->route('gastos')->with('success', 'Eliminado Correctamente!');
    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->route('gastos')->with('error', $e->getMessage());
    }
  }
}
