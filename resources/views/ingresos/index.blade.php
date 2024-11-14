@extends('layouts.app')
@section('ingreso', 'active')
@section('titulo', 'Ingresos')
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
        <h3 class="card-title">.:. Listado - Ingresos .:. </h3>
        <div class="card-tools">
          <div class="btn btn-tool">
            <a href="{{ route('ingresos.create') }}" class="btn btn-primary">Añadir</a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <th style="width: 50px">#</th>
                <th>DOCUMENTO</th>
                <th>INGRESO</th>
                <th>TOTAL</th>
                <th>STATUS</th>
                <th>REGISTRADO</th>
                <th style="width: 50px"></th>
              </tr>
            </thead>
            <tbody>
            @if ($ingresos->count() > 0)
              @foreach ($ingresos as $rs)
              <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle"><strong>{{ $rs->serie}}</strong> I {{ $rs->nrodoc }}</td>
                <td class="align-middle">{{ $rs->titulo }}</td>
                <td class="align-middle">{{ $rs->total }}</td>
                <td class="align-middle">
                  @if ($rs->estado == 1)
                  <span class="right badge badge-success">EMITIDO</span>
                  @else
                  <span class="right badge badge-danger">CANCELADO</span>
                  @endif
                </td>
                <td class="align-middle" title="{{ $rs->created_at }}">{{ $rs->created_at->diffForHumans() }}</td>
                <td class="align-middle">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('ingresos.show', $rs->id) }}" type="button" class="btn btn-info"><i class="fas fa-eye"></i>VER</a>
                    <a data-target="#modal-delete-{{ $rs->id }}" type="button" data-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
              @include('ingresos.modal.delete')
              @endforeach
              @else
              <tr>
                <td class="text-center" colspan="7">Sin registros existentes..</td>
              </tr>
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 50px">#</th>
                <th>DOCUMENTO</th>
                <th>INGRESO</th>
                <th>TOTAL</th>
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