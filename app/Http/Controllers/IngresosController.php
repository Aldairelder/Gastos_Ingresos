<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresosRequest;
use App\Models\Clases;
use App\Models\Entidades;
use App\Models\Ingresos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngresosController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $ingresos = Ingresos::orderby('id', 'DESC')
      ->get();
    return view('ingresos.index', compact('ingresos'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $clases = Clases::where('estado', '=', 1)->orderBy('id', 'DESC')->get();
    $entidades = Entidades::where('estado', '=', 1)->orderBy('id', 'DESC')->get();
    $conteo = Ingresos::count() + 1;
    $tiempo = date('Ymd') . $conteo;
    return view('ingresos.forms.create', compact('clases', 'entidades', 'tiempo'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(IngresosRequest $request)
  {
    try {
      DB::beginTransaction();
      // Crear el ingreso principal
      // $ingresos = Ingresos::create($request->only([
      //     'idclase', 'identidad', 'nrodoc', 'titulo', 'descripcion', 'total'
      // ]));
      $data = $request->all();
      $data['serie'] = '001';
      $ingresos = Ingresos::create($data);
      // Crear los detalles del ingreso
      foreach ($request->detalles as $detalle) {
        $ingresos->detalles()->create($detalle);
      }
      DB::commit();
      return redirect()->route('ingresos')->with('success', 'Registrado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('ingresos')->with('error', $e->getMessage());
      // dd($e->getMessage());
      // dd($request->all());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $ingresos = Ingresos::with('clase', 'entidad')->findOrFail($id);
    return view('ingresos.show', compact('ingresos'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $ingresos = Ingresos::findOrFail($id);
      $ingresos->estado = '0';
      $ingresos->update();
      return redirect()->route('ingresos')->with('success', 'Eliminado Correctamente!');
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('ingresos')->with('error', $e->getMessage());
    }
  }
}
