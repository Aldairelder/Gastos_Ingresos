@extends('layouts.app')
@section('usuario', 'active')
@section('titulo', 'Usuarios')
@section('contenido')
    <section class="content">
        <!-- container-fluid -->
        <div class="container-fluid">
            {{-- <div class="row"> --}}
            {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">.:. Nuevo - Registro .:.</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Trabajador</label>
                                <select id="pidtrabajador" class="form-control select2">
                                    <option selected disabled>SELECCIONAR...</option>
                                    @foreach ($trabajadores as $rs)
                                        <option value="{{ $rs->id }}_{{ $rs->nrodoc }}_{{ $rs->nrodoc }}">
                                            {{ $rs->nrodoc . ' I ' . $rs->nombres . ' ' . $rs->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" name="idtrabajador" id="idtrabajador">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Tipo de Usuario</label>
                                <select id="idrol" name="idrol" class="form-control select2">
                                    <option selected disabled>SELECCIONAR...</option>
                                    @foreach ($roles as $rs)
                                        <option value="{{ $rs->id }}">{{ $rs->rol }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control"
                                    placeholder="Nombre del Usuario" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Contraseña del Usuario" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('usuarios') }}" type="button" class="btn btn-secondary">Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!--/. container-fluid -->
    </section>
@endsection
@push('scripts')
    <script>
        $("#pidtrabajador").change(mostrarValores);

        function mostrarValores() {
            datosArticulo = document.getElementById('pidtrabajador').value.split('_');
            $("#usuario").val(datosArticulo[2]);
            $("#password").val(datosArticulo[1]);
            $("#idtrabajador").val(datosArticulo[0]);
        }
    </script>
@endpush
