<?php

namespace App\Http\Controllers;

use App\Models\Ingreso; // Asegúrate de que este modelo esté correctamente importado
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IngresosExport;

class ExportController extends Controller
{
    /**
     * Exportar los ingresos a un archivo Excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel()
    {
        return Excel::download(new IngresosExport, 'ingresos.xlsx');
    }
}
