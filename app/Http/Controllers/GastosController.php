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
    $gastos = Gastos::with('clase') // Cargar la relación 'clase'
        ->orderBy('id', 'DESC')
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
  
          // Validación y manejo del archivo
          $archivoPath = null; // Valor predeterminado en caso de que no se cargue ningún archivo
  
          if ($request->hasFile('archivo')) {
              // Obtener el archivo
              $archivo = $request->file('archivo');
              // Guardar el archivo en la carpeta 'gastos_archivos' en el almacenamiento público
              $archivoPath = $archivo->store('gastos_archivos', 'public');
          }
  
          // Crear el gasto principal
          $data = $request->all();
          $data['serie'] = '001';
          $data['archivo'] = $archivoPath; // Guardar la ruta del archivo en la base de datos
          $gasto = Gastos::create($data); // Crear el gasto
  
          // Crear los detalles del gasto
          foreach ($request->detalles as $detalle) {
              $gasto->detalles()->create($detalle);
          }
  
          DB::commit();
          return redirect()->route('gastos')->with('success', 'Registrado Correctamente!');
      } catch (\Exception $e) {
          DB::rollback();
          return redirect()->route('gastos')->with('error', $e->getMessage());
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
