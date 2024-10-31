@extends('layouts.app')
@section('roles', 'active')
@section('titulo', 'Roles')
@section('contenido')
<section class="content">
    <!-- container-fluid -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">.:. Nuevo - Rol .:. </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-danger">*</label>
                            <label class="form-label">Nombre</label>
                            <input type="text" name="rol" class="form-control @error('rol')is-invalid @enderror" value="{{ old('rol') }}" placeholder="Nombre del rol">
                            @error('rol')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('roles') }}" type="button" class="btn btn-secondary">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
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