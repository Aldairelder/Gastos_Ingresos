@extends('layouts.app')
@section('roles', 'active')
@section('titulo', 'Roles')
@section('contenido')
<section class="content">
    <!-- container-fluid -->
    <div class="container-fluid">
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="icon fas fa-ban"></i>
            <strong>ERROR!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">.:. Asignando Permisos | <strong>{{ $arrPermisoRol['rol'] }}</strong> .:.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('permisos.store', $arrPermisoRol['idrol']) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <table id="example2" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th>MÓDULO</th>
                                        <th style="width: 150px" class="text-center">VER</th>
                                        <th style="width: 150px" class="text-center">CREAR</th>
                                        <th style="width: 150px" class="text-center">EDITAR</th>
                                        <th style="width: 150px" class="text-center">BORRAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($arrPermisoRol['modulo'] as $modulo)
                                    @php
                                    $permisos = $modulo['permisos'];
                                    $rCheck = $permisos['r'] == 1 ? 'checked' : '';
                                    $wCheck = $permisos['w'] == 1 ? 'checked' : '';
                                    $uCheck = $permisos['u'] == 1 ? 'checked' : '';
                                    $dCheck = $permisos['d'] == 1 ? 'checked' : '';
                                    $idmod = $modulo['id'];
                                    @endphp
                                    <tr>
                                        <td class="align-middle">
                                            <input type="hidden" name="idrol" value="idrol" value="{{ $arrPermisoRol['idrol'] }}" required>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $modulo['modulo'] }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="toggle-flip text-center">
                                                <input type="checkbox" name="permissions[{{ $idmod }}][r]" {{ $rCheck }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="toggle-flip text-center">
                                                <input type="checkbox" name="permissions[{{ $idmod }}][w]" {{ $wCheck }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="toggle-flip text-center">
                                                <input type="checkbox" name="permissions[{{ $idmod }}][u]" {{ $uCheck }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="toggle-flip text-center">
                                                <input type="checkbox" name="permissions[{{ $idmod }}][d]" {{ $dCheck }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th>MÓDULO</th>
                                        <th style="width: 150px" class="text-center">VER</th>
                                        <th style="width: 150px" class="text-center">CREAR</th>
                                        <th style="width: 150px" class="text-center">EDITAR</th>
                                        <th style="width: 150px" class="text-center">BORRAR</th>
                                    </tr>
                                </tfoot>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="guardar">
                            <a href="{{ route('roles') }}" type="button" class="btn btn-secondary">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!--/. container-fluid -->
</section>
@endsection