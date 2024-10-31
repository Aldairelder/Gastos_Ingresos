@extends('layouts.app')
@section('trabajador', 'active')
@section('titulo', 'Trabajadores')
@section('contenido')
    <section class="content">
        <!-- container-fluid -->
        <div class="container-fluid">
            {{-- <div class="row"> --}}
            {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">.:. Editar - Registro .:.</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('trabajadores.update', ['id' => $trabajador->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Numero de Identificación</label>
                                <input type="text" name="nrodoc"
                                    class="form-control @error('nrodoc')is-invalid @enderror"
                                    placeholder="Numero de Identificación" value="{{ old('nrodoc',$trabajador->nrodoc) }}">
                                @error('nrodoc')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Nombres</label>
                                <input type="text" name="nombres"
                                    class="form-control @error('nombres')is-invalid @enderror"
                                    placeholder="Nombres" value="{{ old('nombres',$trabajador->nombres) }}">
                                @error('nombres')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Apellidos</label>
                                <input type="text" name="apellidos"
                                    class="form-control @error('apellidos')is-invalid @enderror"
                                    placeholder="Apellidos" value="{{ old('apellidos',$trabajador->apellidos) }}">
                                @error('apellidos')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Telefono</label>
                                <input type="text" name="telefono"
                                    class="form-control @error('telefono')is-invalid @enderror"
                                    placeholder="Telefono" value="{{ old('telefono',$trabajador->telefono) }}">
                                @error('telefono')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Correo Electronico</label>
                                <input type="email" name="email"
                                    class="form-control @error('email')is-invalid @enderror"
                                    placeholder="Correo Electronico" value="{{ old('email',$trabajador->email) }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('trabajadores') }}" type="button" class="btn btn-secondary">Regresar</a>
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