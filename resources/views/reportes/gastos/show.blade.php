@extends('layouts.app')
@section('gasto', 'active')
@section('titulo', 'Detalle de Gastos')
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
                <small class="float-right">Emitido : <b>{{ $gastos->created_at }}</b></small>
              </h4>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <address>
                DOCUMENTO DE IDENTIFICACIÓN<br>
                Serie : <b>{{ $gastos->serie }}</b><br>
                Documento : <b> #{{ $gastos->nrodoc }}</b><br>
                Titulo : <b>{{ $gastos->titulo }}</b><br>
              </address>
            </div>
          </div>
          <div class="row col-md-12 mb-3">
            <address>
              DESCRIPCION<br>
              <b>{{ $gastos->descripcion }}</b>
            </address>
          </div>
          <div class="row">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>DOCUMENTO</th>
                    <th>TIPO</th>
                    <th>GASTO</th>
                    <th>STATUS</th>
                    <th>FECHA</th>
                    <th>CANTIDAD</th> <!-- Cantidad -->
                    <th>PRECIO</th> <!-- Precio por unidad -->
                
                    <th>MONTO</th> <!-- Monto calculado (Cantidad * Precio) -->
                  </tr>
                </thead>
                <tbody>
                  @foreach ($gastos->detalles as $detalle)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $gastos->serie }}</strong> I {{ $gastos->nrodoc }}</td> <!-- Documento -->
                    <td>{{ $gastos->clase->clase ?? 'Sin Clase' }}</td> <!-- Tipo -->
                    <td>{{ $gastos->titulo }}</td> <!-- Gasto -->
                    <td>
                      @if ($gastos->estado == 1)
                        <span class="right badge badge-success">EMITIDO</span>
                      @else
                        <span class="right badge badge-danger">CANCELADO</span>
                      @endif
                    </td> <!-- Status -->
                    <td>{{ $gastos->created_at }}</td> <!-- Fecha -->
                    <td>{{ $detalle->cantidad }}</td> <!-- Cantidad -->
                    <td>S/. {{ number_format($detalle->precio, 2) }}</td> <!-- Precio por unidad -->
                    <td>S/. {{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td> <!-- Monto calculado -->
                  </tr>
                  @endforeach
                </tbody>
                <thead>
                  <tr>
                    <th>#</th>
                    <th colspan="7">TOTAL</th>
                    <th colspan="2">S/. {{ number_format($gastos->total, 2) }}</th> <!-- Total general -->
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div class="row no-print">
            <div class="col-12">
              <a href="{{ route('gastos') }}" rel="noopener" class="btn btn-default float-right" style="margin-right: 5px;">REGRESAR</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection