@extends('layouts.app')
@section('ingreso', 'active')
@section('titulo', 'Ingresos')
@section('contenido')
<section class="content">
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
          <a class="btn btn-light" onclick="window.print()">IMPRIMIR</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="ingresosTable" class="table table-striped table-bordered table-condensed table-hover">
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
                  <td class="align-middle"><strong>{{ $rs->serie }}</strong> I {{ $rs->nrodoc }}</td>
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
                      <a href="{{ route('ingresos.show', $rs->id) }}" class="btn btn-info"><i class="fas fa-eye">VER</i></a>
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
    </div>
  </div>
</section>

<!-- Incluir DataTables y configurarlo -->
@push('scripts')
<!-- Estilos de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<!-- jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {
    $('#ingresosTable').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "search": "Buscar:",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }
    });
  });
</script>
@endpush
@endsection
