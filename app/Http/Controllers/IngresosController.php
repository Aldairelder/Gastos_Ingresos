<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresosRequest;
use App\Models\Clases;
use App\Models\Entidades;
use App\Models\Ingresos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Ingresos::orderby('id', 'DESC')->get();
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
            
            // Obtener los datos del request
            $data = $request->all();
            $data['serie'] = '001';  // Asignar una serie fija (puedes ajustarlo si es necesario)
            
            // Verificar si se subió un archivo
            if ($request->hasFile('archivo')) {
                $archivo = $request->file('archivo');
                // Guardar el archivo en la carpeta 'ingresos_archivos' en el almacenamiento público
                $archivoPath = $archivo->store('ingresos_archivos', 'public');
                // Agregar la ruta del archivo a los datos
                $data['archivo'] = $archivoPath;
            }

            // Crear el registro de ingresos
            $ingresos = Ingresos::create($data);

            // Crear los detalles del ingreso
            foreach ($request->detalles as $detalle) {
                $ingresos->detalles()->create($detalle);
            }

            DB::commit();
            return redirect()->route('ingresos')->with('success', 'Registrado Correctamente!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('ingresos')->with('error', 'Error: ' . $e->getMessage());
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
     * Remove the specified resource from storage (cancelar el ingreso).
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $ingresos = Ingresos::findOrFail($id);
            $ingresos->estado = '0';  // Cambiar el estado a "Cancelado"
            $ingresos->save();  // Guardar el cambio

            DB::commit();  // Confirmar la transacción

            return redirect()->route('ingresos')->with('success', 'Ingreso cancelado correctamente!');
        } catch (Exception $e) {
            DB::rollback();  // Revertir la transacción si ocurre un error
            return redirect()->route('ingresos')->with('error', 'Error al cancelar el ingreso: ' . $e->getMessage());
        }
    }
}
