<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRolResquest;
use App\Http\Requests\UpdateRolResquest;
use App\Models\Rol;
use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $roles = Roles::where('estado', '=', 1)->orderby('id', 'DESC')->get();
    return view('roles.index', compact('roles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('roles.forms.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreRolResquest $request)
  {
    try {
      DB::beginTransaction();
      Roles::create($request->all());
      DB::commit();
      return redirect()->route('roles')->with('success', 'Registrado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('roles')->with('error', $e->getMessage());
    }
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
    $roles = Roles::findOrFail($id);
    return view('roles.forms.update', compact('roles'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateRolResquest $request, string $id)
  {
    try {
      DB::beginTransaction();
      $roles = Roles::findOrFail($id);
      $roles->update($request->all());
      DB::commit();
      return redirect()->route('roles')->with('success', 'Modificado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('roles')->with('error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();
      $rol = Roles::findOrFild($id);
      $rol->estado = 0;
      $rol->update();
      DB::commit();
      return redirect()->route('roles')->with('success', 'Eliminado Correctamente!');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('roles')->with('success', $e->getMessage());
    }
  }
}
