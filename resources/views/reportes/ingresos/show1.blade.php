@extends('layouts.app')

@section('ingreso', 'active')
@section('titulo', 'Detalle de Ingreso')
@section('contenido')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        
        <div class="invoice p-3 mb-3">
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-globe"></i>
                <small class="float-right">Emitido : <b>{{ $ingresos->created_at }}</b></small>
              </h4>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <address>
                DOCUMENTO DE IDENTIFICACIÓN<br>
                Serie : <b>{{ $ingresos->serie }}</b><br>
                Documento : <b>#{{ $ingresos->nrodoc }}</b><br>
                Título : <b>{{ $ingresos->titulo }}</b><br>
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <address>
                ENTIDAD<br>
                Nombre: <b>{{ $ingresos->entidad->entidad }}</b><br>
                Documento: <b>#{{ $ingresos->entidad->nrodoc }}</b><br>
                Correo Electrónico: <b>{{ $ingresos->entidad->email }}</b><br>
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <address>
                CLASE<br>
                Tipo: <b>{{ $ingresos->clase->clase ?? 'Sin Clase' }}</b><br>
              </address>
            </div>
          </div>

          <div class="row col-md-12 mb-3">
            <address>
              DESCRIPCIÓN<br>
              <b>{{ $ingresos->descripcion }}</b>
            </address>
          </div>

          <div class="row">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>DOCUMENTO</th>
                    <th>DETALLE</th> <!-- Coloca la columna DETALLE al lado de DOCUMENTO -->
                    <th>TIPO</th>
                    <th>REGISTRADO</th>
                    <th>ESTADO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>MONTO</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    // Inicializamos el total a cero
                    $total = 0;
                  @endphp
                  
                  @foreach ($ingresos->detalles as $detalle)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td><strong>{{ $ingresos->serie }}</strong> I {{ $ingresos->nrodoc }}</td>
                      <td>{{ $detalle->detalle }}</td> <!-- Muestra el detalle del ingreso -->
                      <td>{{ $ingresos->clase->clase ?? 'Sin Clase' }}</td>
                      <td>{{ $ingresos->created_at->diffForHumans() }}</td>
                      <td>
                        @if ($ingresos->estado == 1)
                          <span class="right badge badge-success">EMITIDO</span>
                        @else
                          <span class="right badge badge-danger">CANCELADO</span>
                        @endif
                      </td>
                      <td>{{ $detalle->cantidad }}</td>
                      <td>S/. {{ number_format($detalle->precio, 2) }}</td>
                      <td>S/. {{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>

                      @php
                        // Sumamos el monto de este detalle al total
                        $total += $detalle->cantidad * $detalle->precio;
                      @endphp
                    </tr>
                  @endforeach
                </tbody>
                <thead>
                  <tr>
                    <th>#</th>
                    <th colspan="7">TOTAL</th>
                    <th>S/. {{ number_format($total, 2) }}</th> <!-- Total general -->
                  </tr>
                </thead>
              </table>
            </div>
          </div>

          <div class="row no-print">
            <div class="col-12">
              <a href="{{ route('detalledereporte') }}" class="btn btn-default float-right" style="margin-right: 5px;">REGRESAR</a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>

@endsection