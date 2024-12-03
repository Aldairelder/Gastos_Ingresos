@extends('layouts.app')

@section('ingreso', 'active')
@section('titulo', 'Listado de Ingresos')
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
        <h3 class="card-title ">.:. Reporte - Ingresos .:. </h3>
        <div class="card-tools">
          <div class="btn-group">
            <!-- Botón de Imprimir -->
            <a class="btn btn-light pull-right no-print" onclick="javascript:window.print()" style="background-color: rgb(135, 135, 211); padding: 5px; border-radius: 5px;">
              <img src="{{ asset('dist/img/imprimir.png') }}" alt="Imprimir" style="width: 30px; height: auto;">
            </a>
            <!-- Botón de Exportar a Excel -->
            <button id="exportarExcel" class="btn btn-light pull-right no-print" style="background-color: rgb(42, 100, 56); padding: 5px; border-radius: 5px;">
              <img src="{{ asset('dist/img/excel.png') }}" alt="Excel" style="width: 30px; height: auto;">
            </button>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <!-- Formulario para Filtrar por Fechas -->
        <div class="row mb-3">
          <div class="col-md-4 no-print">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" id="fecha_inicio" class="form-control">
          </div>
          <div class="col-md-4 no-print">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" id="fecha_fin" class="form-control">
          </div>
          <div class="col-md-4 d-flex align-items-end no-print">
            <button id="filtrar" class="btn btn-info">Filtrar</button>
          </div>
        </div>

        <div class="table-responsive">
          <table id="example1" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <tr>
                <th style="width: 50px">#</th>
                <th>DOCUMENTO</th>
                <th>TIPO</th>
                <th>INGRESO</th>
                <th>TOTAL</th>
                <th>STATUS</th>
                <th>PDF</th>
                <th>FECHA</th>
                <th class="no-print" style="width: 50px"></th>
              </tr>
            </thead>
            <tbody id="ingreso-list">
            @if ($ingresos->count() > 0)
              @foreach ($ingresos as $rs)
              <tr data-fecha="{{ $rs->created_at->toDateString() }}">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle"><strong>{{ $rs->serie}}</strong> I {{ $rs->nrodoc }}</td>
                <td class="align-middle">{{ $rs->clase->clase ?? 'Sin Clase' }}</td>
                <td class="align-middle">{{ $rs->titulo }}</td>
                <td class="align-middle">{{ 'S/. ' . number_format($rs->total, 2) }}</td>
                <td class="align-middle">
                  @if ($rs->estado == 1)
                  <span class="right badge badge-success">EMITIDO</span>
                  @else
                  <span class="right badge badge-danger">CANCELADO</span>
                  @endif
                </td>
                <td class="align-middle">
                  @if ($rs->archivo)
                    <a href="{{ asset('storage/' . $rs->archivo) }}" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>
                  @else
                    <span>No disponible</span>
                  @endif
                </td>
                <td class="align-middle">{{ $rs->created_at }}</td>
                <td class="align-middle no-print">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('ingresos.show', $rs->id) }}" type="button" class="btn btn-info" style="font-size: 12px; padding: 4px 10px;"><i class="fas fa-eye">VER</i></a>
                  </div>
                </td>
              </tr>
              @includeIf('ingresos.modal.delete')
              @endforeach
            @else
            <tr>
              <td class="text-center" colspan="8">Sin registros existentes..</td>
            </tr>
            @endif
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 50px">#</th>
                <th>DOCUMENTO</th>
                <th>TIPO</th>
                <th>INGRESO</th>
                <th>TOTAL</th>
                <th>STATUS</th>
                <th>PDF</th>
                <th>FECHA</th>
                <th class="no-print" style="width: 50px"></th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

<!-- Estilos de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script>
  $(document).ready(function() {
    // Inicializar DataTable
    const table = $('#example1').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron registros",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ registros en total)",
        "search": "Buscar:"
      },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "initComplete": function() {
        $('.dataTables_paginate').addClass('no-print');
        $('.dataTables_length').addClass('no-print');
        $('.dataTables_filter').addClass('no-print');
        $('.dataTables_info').addClass('no-print');
      }
    });

    // Filtrar por fechas
    $('#filtrar').on('click', function() {
      const fechaInicio = $('#fecha_inicio').val();
      const fechaFin = $('#fecha_fin').val();

      $('#ingreso-list tr').each(function() {
        const fechaRegistro = $(this).data('fecha');
        if (fechaInicio && fechaFin) {
          if (fechaRegistro >= fechaInicio && fechaRegistro <= fechaFin) {
            $(this).show();
          } else {
            $(this).hide();
          }
        } else {
          $(this).show(); // Si no hay filtro de fecha, mostrar todos
        }
      });
    });

    // Función para exportar a Excel
    $('#exportarExcel').on('click', function() {
      // Eliminar la columna 'VER' (última columna) de la tabla antes de exportar
      var tableClone = $('#example1').clone();
      tableClone.find('td:last-child, th:last-child').remove(); // Eliminar última columna (columna 'VER')

      // Crear una hoja de Excel con el título antes de la tabla
      var ws = XLSX.utils.aoa_to_sheet([['.:. Listado - Ingresos .:.']]);
      var wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, 'Ingresos');

      // Convertir la tabla en formato de arreglo de filas (sin la columna 'VER')
      var tableData = [];
      tableClone.find('tr').each(function() {
        var row = [];
        $(this).find('th, td').each(function() {
          row.push($(this).text().trim());
        });
        tableData.push(row);
      });

      // Agregar los datos de la tabla a la hoja de Excel
      XLSX.utils.sheet_add_aoa(wb.Sheets['Ingresos'], tableData, { origin: 'A2' });

      // Descargar el archivo Excel
      XLSX.writeFile(wb, 'ingresos.xlsx');
    });
  });
</script>
@endpush