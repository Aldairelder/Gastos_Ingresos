<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresosRequest;
use App\Models\Clases;
use App\Models\Entidades;
use App\Models\Ingresos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteIngresosController extends Controller
{
  
  public function index()
  {
    $ingresos = Ingresos::orderby('id', 'DESC')
      ->get();
    return view('reportes.ingresos.index', compact('ingresos'));
  }

  
  
  public function show(string $id)
  {
    $ingresos = Ingresos::with('clase', 'entidad')->findOrFail($id);
    return view('reportes.ingresos.show', compact('ingresos'));
  }

}
