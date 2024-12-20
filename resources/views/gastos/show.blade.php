@extends('layouts.app')
@section('gasto', 'active')
@section('titulo', 'Gastos')
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
                    <th>DETALLES</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>MONTO</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($gastos->detalles as $detalle)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detalle->detalle }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>S/. {{ $detalle->precio }}</td>
                    <td>S/. {{ $detalle->cantidad * $detalle->precio }}</td>
                  </tr>
                  @endforeach
                </tbody>
                <thead>
                  <tr>
                    <th>#</th>
                    <th colspan="3">TOTAL</th>
                    <th>S/. {{ $gastos->total }}</th>
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