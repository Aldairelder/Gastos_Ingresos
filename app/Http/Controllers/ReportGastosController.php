<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastosRequest;
use App\Models\Clases;
use App\Models\Gastos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportGastosController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $gastos = Gastos::orderby('id', 'DESC')
      ->get();
    return view('reportes.gastos.index', compact('gastos'));
  }

  
  public function show(string $id)
  {
    $gastos = Gastos::with('clase')->findOrFail($id);
    return view('reportes.gastos.show', compact('gastos'));
  }

  
 
}
