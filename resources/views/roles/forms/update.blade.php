@extends('layouts.app')
@section('entidades', 'menu-open')
@section('roles', 'active')
@section('titulo', 'Roles')
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
                    <form action="{{ route('roles.update', $roles->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-danger">*</label>
                                <label class="form-label">Clasificación</label>
                                <input type="text" name="rol" class="form-control @error('rol')is-invalid @enderror"
                                    placeholder="Nombre de la Clasificación" value="{{ old('rol', $roles->rol) }}">
                                @error('rol')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Descripcion</label>
                                <input type="text" name="descripcion"
                                    class="form-control @error('descripcion')is-invalid @enderror" placeholder="Descripcion"
                                    value="{{ old('descripcion') }}" value="{{ $roles->descripcion }}">
                                @error('descripcion')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('roles') }}" type="button" class="btn btn-secondary">Regresar</a>
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
@endpush
