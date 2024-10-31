<?php

namespace App\Http\Controllers;

use App\Models\Gastos;
use App\Models\Ingresos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $totalIngresos = Ingresos::where('estado', '=', '1')->count();
    $montoIngresos = Ingresos::where('estado', '=', '1')->sum('total');

    // Gastos
    $totalGastos = Gastos::where('estado', '=', '1')->count();
    $montoGastos = Gastos::where('estado', '=', '1')->sum('total');

    // Operación
    $operacion = $montoIngresos - $montoGastos;

    // Conteo por Mes (Ingresos)
    $year = Carbon::now()->year;
    $conteoPorMesIngresos = Ingresos::select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total'))
      ->where('estado', '=', '1')
      ->whereYear('created_at', $year)
      ->groupBy(DB::raw('MONTH(created_at)'))
      ->get();

    $labelsIngresos = $conteoPorMesIngresos->pluck('mes')->map(function ($month) {
      return Carbon::createFromDate(null, $month, 1)->format('F');
    });

    $dataIngresos = $conteoPorMesIngresos->pluck('total');

    // Conteo por Mes (Gastos)
    $conteoPorMesGastos = Gastos::select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total'))
      ->where('estado', '=', '1')
      ->whereYear('created_at', $year)
      ->groupBy(DB::raw('MONTH(created_at)'))
      ->get();

    $labelsGastos = $conteoPorMesGastos->pluck('mes')->map(function ($month) {
      return Carbon::createFromDate(null, $month, 1)->format('F');
    });

    $dataGastos = $conteoPorMesGastos->pluck('total');

    return view('dashboard', compact(
      'totalIngresos',
      'montoIngresos',
      'totalGastos',
      'montoGastos',
      'operacion',
      'labelsIngresos',
      'dataIngresos',
      'labelsGastos',
      'dataGastos'
    ));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
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
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
