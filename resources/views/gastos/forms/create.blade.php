@extends('layouts.app')
@section('gasto', 'active')
@section('titulo', 'Gastos')
@section('contenido')
    <section class="content">
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
            <form action="{{ route('gastos.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">.:. Información - Registro .:.</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Documento</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input style="width: 100px" class="input-group-text" id="nrodoc"
                                                    name="nrodoc" value="{{ $tiempo }}" readonly>
                                            </div>
                                            <input type="text" name="titulo"
                                                class="form-control @error('titulo')is-invalid @enderror"
                                                placeholder="Nombre del Gasto" value="{{ old('titulo') }}">
                                            @error('titulo')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Clase</label>
                                        <select name="idclase" id="idclase"
                                            class="form-control select2 @error('idclase')is-invalid @enderror" required>
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
                                        <label class="form-label">Descripcion</label>
                                        <input type="text" name="descripcion"
                                            class="form-control @error('descripcion')is-invalid @enderror"
                                            placeholder="Descripcion">
                                        @error('descripcion')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Campo para el archivo -->
                                    <div class="col-md-12">
                                        <label class="form-label">Archivo</label>
                                        <input type="file" name="archivo" id="archivo" class="form-control @error('archivo')is-invalid @enderror">
                                        @error('archivo')
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">.:. Detalles - Registro .:.</h3>
                            </div>
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
                                        <button type="button" id="bt_add" class="btn btn-info">Agregar</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="detalles">
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
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                    ');"><i class="fas fa-trash"></i></button></td>';
                fila += '<td><input class="form-control" type="text" name="detalles[' + cont + '][detalle]" value="' +
                    detalle + '" readonly></td>';
                fila += '<td class="align-middle text-center"><input class="form-control" type="number" name="detalles[' +
                    cont + '][cantidad]" value="' + cantidad + '" readonly></td>';
                fila += '<td class="align-middle text-center"><input class="form-control" type="number" name="detalles[' +
                    cont + '][precio]" value="' + parseFloat(precio).toFixed(2) + '" readonly></td>'
                fila += '<td class="align-middle text-center"><strong>S/ ' + parseFloat(subtotal[cont]).toFixed(2) +
                    '</strong></td>';
                fila += '</tr>';
                cont++;
                limpiar();
                $('#total_venta').html("<strong>S/ " + parseFloat(total).toFixed(2) + "</strong>");
                $('#total').val(parseFloat(total).toFixed(2));

                evaluar();
                $('#detalles').append(fila);

            } else {
                alert('Competar todos los campos (*)');
            }

        }

        function limpiar() {
            $('#pdetalle').val("");
            $('#pcantidad').val("");
            $('#pprecio').val("");
        }

        function evaluar() {
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index) {
            total = total - subtotal[index];
            $('#total_venta').html("<strong>S/ " + parseFloat(total).toFixed(2) + "</strong>");
            $('#total').val(parseFloat(total).toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
@endpush
