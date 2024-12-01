<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasesController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\ReportGastosController;
use App\Http\Controllers\ReporteIngresosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TrabajadoresController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
  //INICAR - SESSION
  Route::get('/', 'login')->name('login');
  Route::post('login', 'loginAction')->name('login.action');
  //CERRAR - SESSION
  Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

route::middleware('auth')->group(function () {
  // route::get('/dashboard', function () {
  //     return view('dashboard');
  // })->name('dashboard');
  Route::get('/dashboard', [HomeController::class, 'Index'])->name('dashboard');

  Route::controller(ClasesController::class)->prefix('clases')->group(function () {
    Route::get('', 'index')->name('clases');

    Route::get('registro', 'create')->name('clases.create');
    Route::post('store', 'store')->name('clases.store');
    Route::get('show/{id}', 'show')->name('clases.show');
    Route::get('editar/{id}', 'edit')->name('clases.edit');
    Route::put('editar/{id}', 'update')->name('clases.update');
    Route::delete('destroy/{id}', 'destroy')->name('clases.destroy');
  });

  Route::controller(GastosController::class)->prefix('gastos')->group(function () {
    Route::get('', 'index')->name('gastos');

    Route::get('registro', 'create')->name('gastos.create');
    Route::post('store', 'store')->name('gastos.store');
    Route::get('show/{id}', 'show')->name('gastos.show');
    Route::get('editar/{id}', 'edit')->name('gastos.edit');
    Route::put('editar/{id}', 'update')->name('gastos.update');
    Route::delete('destroy/{id}', 'destroy')->name('gastos.destroy');
  });
  Route::controller(ReportGastosController::class)->prefix('reportgastos')->group(function () {
    Route::get('', 'index')->name('reportgastos');
    Route::get('show/{id}', 'show')->name('gastos.show');

  });
  Route::controller(ReporteIngresosController::class)->prefix('reportingresos')->group(function () {
    Route::get('', 'index')->name('reportingresos');
    Route::get('show/{id}', 'show')->name('ingresos.show');

  });
  Route::controller(EmpresasController::class)->prefix('empresas')->group(function () {
    Route::get('', 'index')->name('empresas');

    Route::get('registro', 'create')->name('empresas.create');
    Route::post('store', 'store')->name('empresas.store');
    Route::get('show/{id}', 'show')->name('empresas.show');
    Route::get('editar/{id}', 'edit')->name('empresas.edit');
    Route::put('editar/{id}', 'update')->name('empresas.update');
    Route::delete('destroy/{id}', 'destroy')->name('empresas.destroy');
  });

  Route::controller(PersonasController::class)->prefix('personas')->group(function () {
    Route::get('', 'index')->name('personas');

    Route::get('registro', 'create')->name('personas.create');
    Route::post('store', 'store')->name('personas.store');
    Route::get('show/{id}', 'show')->name('personas.show');
    Route::get('editar/{id}', 'edit')->name('personas.edit');
    Route::put('editar/{id}', 'update')->name('personas.update');
    Route::delete('destroy/{id}', 'destroy')->name('personas.destroy');
  });

  Route::controller(IngresosController::class)->prefix('ingresos')->group(function () {
    Route::get('', 'index')->name('ingresos');

    Route::get('registro', 'create')->name('ingresos.create');
    Route::post('store', 'store')->name('ingresos.store');
    Route::get('show/{id}', 'show')->name('ingresos.show');
    Route::get('editar/{id}', 'edit')->name('ingresos.edit');
    Route::put('editar/{id}', 'update')->name('ingresos.update');
    Route::delete('destroy/{id}', 'destroy')->name('ingresos.destroy');
  });

  Route::controller(TrabajadoresController::class)->prefix('trabajadores')->group(function () {
    Route::get('', 'index')->name('trabajadores');

    Route::get('registro', 'create')->name('trabajadores.create');
    Route::post('store', 'store')->name('trabajadores.store');
    Route::get('show/{id}', 'show')->name('trabajadores.show');
    Route::get('editar/{id}', 'edit')->name('trabajadores.edit');
    Route::put('editar/{id}', 'update')->name('trabajadores.update');
    Route::delete('destroy/{id}', 'destroy')->name('trabajadores.destroy');
  });

  Route::controller(UsuarioController::class)->prefix('usuarios')->group(function () {
    Route::get('', 'index')->name('usuarios');

    Route::get('registro', 'create')->name('usuarios.create');
    Route::post('store', 'store')->name('usuarios.store');
    // Route::get('show/{id}', 'show')->name('usuarios.show');
    // Route::get('editar/{id}', 'edit')->name('usuarios.edit');
    // Route::put('editar/{id}', 'update')->name('usuarios.update');
    Route::delete('destroy/{id}', 'destroy')->name('usuarios.destroy');
    Route::put('active/{id}', 'active')->name('usuarios.active');
  });

  Route::controller(RolesController::class)->prefix('roles')->group(function () {
    Route::get('', 'index')->name('roles');

    Route::get('registro', 'create')->name('roles.create');
    Route::post('store', 'store')->name('roles.store');
    Route::get('show/{id}', 'show')->name('roles.show');
    Route::get('editar/{id}', 'edit')->name('roles.edit');
    Route::put('editar/{id}', 'update')->name('roles.update');
    Route::delete('destroy/{id}', 'destroy')->name('roles.destroy');
    Route::get('key', 'key')->name('roles.key');
  });

  Route::controller(PermisosController::class)->prefix('permisos')->group(function () {
    Route::get('{id}', 'index')->name('permisos');
    Route::post('store/{id}', 'store')->name('permisos.store');
  });

  Route::get('ingresos/{id}/cancelar', [IngresosController::class, 'destroy'])->name('ingresos.cancelar');

});
