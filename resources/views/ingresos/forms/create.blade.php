@extends('layouts.app')
@section('ingreso', 'active')
@section('titulo', 'Ingresos')
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
            <!-- /.card -->
            <form action="{{ route('ingresos.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">.:. Información - Registro .:. </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="text-danger">*</label>
                                        <label class="form-label">Numero</label>
                                        <input type="text" name="nrodoc" class="form-control"
                                            placeholder="Numero de Identificacion" value="{{ $tiempo }}" readonly>
                                        @error('nrodoc')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="text-danger">*</label>
                                        <label class="form-label">Titulo</label>
                                        <input type="text" name="titulo" class="form-control"
                                            placeholder="Nombre del titulo del Ingreso" value="{{ old('titulo') }}">
                                        @error('titulo')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="text-danger">*</label>
                                        <label class="form-label">Clase</label>
                                        <select name="idclase" id="idclase"
                                            class="form-control select2 @error('idclase')is-invalid @enderror">
                                            <option selected disabled>SELECCIONAR</option>
                                            @foreach ($clases as $rs)
                                                <option value="{{ $rs->id }}">{{ $rs->clase }}</option>
                                            @endforeach
                                        </select>
                                        @error('idclase')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="text-danger">*</label>
                                        <label class="form-label">Entidad</label>
                                        <select name="identidad" id="identidad"
                                            class="form-control select2 @error('identidad')is-invalid @enderror">
                                            <option selected disabled>BUSCAR...</option>
                                            @foreach ($entidades as $rs)
                                                <option value="{{ $rs->id }}">
                                                    {{ $rs->nrodoc . ' I ' . $rs->entidad }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('identidad')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Descripcion</label>
                                        <input type="text" name="descripcion" class="form-control"
                                            placeholder="Descripción breve del Ingreso">
                                        @error('descripcion')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Campo para subir el archivo -->
                                    <div class="col-md-12">
                                        <label class="form-label">Archivo (PDF)</label>
                                        <input type="file" name="archivo" class="form-control @error('archivo') is-invalid @enderror" accept="application/pdf">
                                        @error('archivo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><strong>S/.</strong></span>
                                            </div>
                                            <input class="form-control" type="number" name="total" id="total"
                                                readonly value="0.00">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('gastos') }}" type="button"
                                            class="btn btn-secondary">Regresar</a>
                                        <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">.:. Detalles - Registro .:. </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="text-danger">*</label>
                                        <label class="form-label">Detalles</label>
                                        <input type="text" name="pdetalle" id="pdetalle" class="form-control"
                                            placeholder="Registro">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="text-danger">*</label>
                                        <label class="form-label">Cantidad</label>
                                        <input type="number" name="pcantidad" id="pcantidad" class="form-control"
                                            placeholder="0.00" min="0">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="text-danger">*</label>
                                        <label class="form-label">Precio</label>
                                        <input type="number" name="pprecio" id="pprecio" class="form-control"
                                            placeholder="0.00" min="0">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <button type="button" id="bt_add" class="btn btn-info">Añadir</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover" id="detalles">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px" class="align-middle">#</th>
                                                        <th>DETALLES</th>
                                                        <th style="width: 150px" class="text-center">CANTIDAD</th>
                                                        <th style="width: 150px" class="text-center">PRECIO</th>
                                                        <th style="width: 150px" class="text-center">MONTO</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="align-middle" style="width: 50px">#</th>
                                                        <th class="align-middle" colspan="3">TOTAL</th>
                                                        <th class="align-middle text-center" id="total_venta">
                                                            <strong>S/ 0.00</strong>
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <form>
        </div>
        <!--/. container-fluid -->
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#bt_add").click(function() {
                agregar();
            });
        });

        var cont = 0;
        subtotal = [];
        total = 0;

        $("#guardar").hide();

        function agregar() {
            detalle = $("#pdetalle").val();
            cantidad = $("#pcantidad").val();
            precio = $("#pprecio").val();

            if (detalle != '' && cantidad != '' && cantidad > 0 && precio != '') {

                subtotal[cont] = (cantidad * precio);
                total = total + subtotal[cont];

                var fila;
                fila = '<tr class="selected" id="fila' + cont + '">';
                fila += '<td><button type="button" class="btn btn-danger" onclick="eliminar(' + cont +
                    ');"><i class="fas fa-trash-alt"></i></button></td>';
                fila += '<td><input type="hidden" name="detalles[' + cont + '][detalle]" value="' + detalle + '">' +
                    detalle + '</td>';
                fila += '<td class="text-center"><input type="hidden" name="detalles[' + cont + '][cantidad]" value="' +
                    cantidad + '">' + cantidad + '</td>';
                fila += '<td class="text-center"><input type="hidden" name="detalles[' + cont + '][precio]" value="' + precio +
                    '">' + precio + '</td>';
                fila += '<td class="text-center">' + (cantidad * precio) + '</td>';
                fila += '</tr>';

                cont++;
                limpiar();
                evaluar();
                $('#detalles').append(fila);

            } else {
                alert("Error, revisar los datos del detalle.");
            }
        }

        function limpiar() {
            $("#pdetalle").val("");
            $("#pcantidad").val("");
            $("#pprecio").val("");
        }

        function evaluar() {
            if (cont > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }

            $("#total_venta").html('<strong>S/ ' + total.toFixed(2) + '</strong>');
            $("#total").val(total.toFixed(2));
        }

        function eliminar(index) {
            total = total - subtotal[index];
            $("#total_venta").html('<strong>S/ ' + total.toFixed(2) + '</strong>');
            $("#total").val(total.toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
@endpush
