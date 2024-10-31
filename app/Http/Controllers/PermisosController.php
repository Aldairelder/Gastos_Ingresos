<?php

namespace App\Http\Controllers;

use App\Models\Modulos;
use App\Models\Permisos;
use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisosController extends Controller
{

  public function index($id)
  {
    $rolid = intval($id);
    if ($rolid > 0) {
      // Obtener los módulos activos
      $modulos = Modulos::where('estado', '=', 1)->get()->toArray();
      // Obtener los permisos del rol
      $permisos = Permisos::where('idrol', '=', $rolid)->get()->toArray();
      // Obtener el rol
      $rol = Roles::findOrFail($rolid)->toArray();
      $arrPermisos = ['r' => 0, 'w' => 0, 'u' => 0, 'd' => 0];
      $arrPermisoRol = ['idrol' => $rolid, 'rol' => $rol['rol']];

      if (empty($permisos)) {
        for ($i = 0; $i < count($modulos); $i++) {
          $modulos[$i]['permisos'] = $arrPermisos;
        }
      } else {
        for ($i = 0; $i < count($modulos); $i++) {
          $arrPermisos = ['r' => 0, 'w' => 0, 'u' => 0, 'd' => 0];
          if (isset($permisos[$i])) {
            $arrPermisos = [
              'r' => $permisos[$i]['r'],
              'w' => $permisos[$i]['w'],
              'u' => $permisos[$i]['u'],
              'd' => $permisos[$i]['d']
            ];
          }
          $modulos[$i]['permisos'] = $arrPermisos;
        }
      }
      $arrPermisoRol['modulo'] = $modulos;

      // Pasar los datos a la vista Blade
      return view('permisos.create', compact('arrPermisoRol'));
    }

    return abort(404);
  }

  public function store(Request $request, $idrol)
  {
    $idrol = intval($idrol);
    $permissions = $request->input('permissions', []);

    try {
      DB::beginTransaction();

      // Eliminar permisos actuales del rol
      Permisos::where('idrol', $idrol)->delete();

      // Insertar los nuevos permisos
      foreach ($permissions as $idmodulo => $permiso) {
        // Determinar el valor de r, w, u, d según el estado del checkbox
        $r = isset($permiso['r']) ? 1 : 0;
        $w = isset($permiso['w']) ? 1 : 0;
        $u = isset($permiso['u']) ? 1 : 0;
        $d = isset($permiso['d']) ? 1 : 0;

        Permisos::create([
          'idrol' => $idrol,
          'idmodulo' => $idmodulo,
          'r' => $r,
          'w' => $w,
          'u' => $u,
          'd' => $d,
        ]);
      }
      DB::commit();
      return redirect()->route('roles')->with('success', 'Permisos actualizados correctamente.');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('roles')->with('error', $e->getMessage());
    }
  }
}
