@extends('layouts.app')

@section('gasto', 'active')
@section('titulo', 'Gastos')
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
        <h3 class="card-title">.:. Listado - Gastos .:. </h3>
        <div class="card-tools">
          <div class="btn btn-tool">
            <a class="btn btn-light pull-right" onclick="javascript:window.print()">IMPRIMIR</a>
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
                <th>TIPO</th>
                <th>GASTO</th>
                <th>TOTAL</th>
                <th>STATUS</th>
                <th>FECHA</th>
                <th style="width: 50px"></th>
              </tr>
            </thead>
            <tbody>
            @if ($gastos->count() > 0)
              @foreach ($gastos as $rs)
              <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                
                <td class="align-middle"><strong>{{ $rs->serie}}</strong> I {{ $rs->nrodoc }}</td>
                <td class="align-middle">{{ $rs->idclase }}</td>
                <td class="align-middle">{{ $rs->titulo }}</td>
                <td class="align-middle">{{ $rs->total }}</td>
                <td class="align-middle">
                  @if ($rs->estado == 1)
                  <span class="right badge badge-success">EMITIDO</span>
                  @else
                  <span class="right badge badge-danger">CANCELADO</span>
                  @endif
                </td>
                <td class="align-middle">{{ $rs->created_at }}</td>
                  <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="{{ route('gastos.show', $rs->id) }}" type="button" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    </div>
                  </td>

              </tr>
              @includeIf('gastos.modal.delete')
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
                <th>TIPO</th>
                <th>GASTO</th>
                <th>TOTAL</th>
                <th>STATUS</th>
                <th>FECHA</th>
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

@push('scripts')
<!-- Incluyendo jQuery y DataTables (con los estilos de Bootstrap para DataTables) -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- Estilos de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron registros",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ registros en total)",
        "search": "Buscar:"
      },
      "paging": true,  // Habilitar paginación
      "lengthChange": true,  // Permitir cambiar el número de registros mostrados por página
      "searching": true,  // Habilitar búsqueda
      "ordering": true,  // Habilitar ordenamiento
      "info": true,  // Mostrar información sobre la tabla
      "autoWidth": false  // Desactivar el ajuste automático de ancho de columna
    });
  });
</script>
@endpush
