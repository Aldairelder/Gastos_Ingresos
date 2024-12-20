@extends('layouts.app')
@section('usuario', 'active')
@section('titulo', 'Usuarios')
@section('contenido')
<section class="content">
  <!-- container-fluid -->
  <div class="container-fluid">
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="icon fas fa-check"></i>
      <strong>Success!</strong> {{ Session::get('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">.:. Listado - Usuarios .:.</h3>
        <div class="card-tools">
          <div class="btn btn-tool">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Añadir</a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="table-responsive">
          <table id="example2" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <th style="width: 50px">#</th>
                <th>USUARIO</th>
                <th>TIPO DE USUARIO</th>
                <th>STATUS</th>
                <th>REGISTRADO</th>
                <th style="width: 50px"></th>
              </tr>
            </thead>
            <tbody>
              @if ($usuarios->count() > 0)
              @foreach ($usuarios as $rs)
              <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $rs->usuario }}</td>
                <td class="align-middle">{{ $rs->rol->rol }}</td>
                <td class="align-middle">
                  @if ($rs->estado == 1)
                  <span class="right badge badge-success">DISPONIBLE</span>
                  @else
                  <span class="right badge badge-danger">BLOQUEADO</span>
                  @endif
                </td>
                <td class="align-middle" title="{{ $rs->created_at }}">{{ $rs->created_at->diffForHumans() }}</td>
                <td class="align-middle">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="" data-target="#modal-show-{{ $rs->id }}" type="button" data-toggle="modal" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    @if ($rs->estado == 1)
                    <a data-target="#modal-delete-{{ $rs->id }}" type="button" data-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    @else
                    <a data-target="#modal-active-{{ $rs->id }}" type="button" data-toggle="modal" class="btn btn-success"><i class="fas fa-check"></i></a>
                    @endif
                  </div>
                </td>
              </tr>
              @include('usuarios.modal.active')
              @include('usuarios.modal.delete')
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="6">Sin registros existentes..</td>
              </tr>
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 50px">#</th>
                <th>USUARIO</th>
                <th>TIPO DE USUARIO</th>
                <th>STATUS</th>
                <th>REGISTRADO</th>
                <th style="width: 50px"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!--/. container-fluid -->
</section>
@endsection