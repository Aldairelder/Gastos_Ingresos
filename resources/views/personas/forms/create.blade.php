@extends('layouts.app')
@section('entidades', 'menu-open')
@section('persona', 'active')
@section('titulo', 'Personas')
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
        <form action="{{ route('personas.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="text-danger">*</label>
              <label class="form-label">Numero de Identificación</label>
              <input type="text" name="nrodoc" class="form-control @error('nrodoc')is-invalid @enderror" placeholder="Numero de Identificación" value="{{ old('nrodoc') }}">
              @error('nrodoc')
              <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-danger">*</label>
              <label class="form-label">Nombre de la Persona</label>
              <input type="text" name="entidad" class="form-control @error('entidad')is-invalid @enderror" placeholder="Nombre de la Persona" value="{{ old('entidad') }}">
              @error('entidad')
              <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="text-danger">*</label>
              <label class="form-label">Telefono</label>
              <input type="text" name="telefono" class="form-control @error('telefono')is-invalid @enderror" placeholder="Numero de Telefono" value="{{ old('telefono') }}">
              @error('telefono')
              <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-danger">*</label>
              <label class="form-label">Correo Electronico</label>
              <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" placeholder="Correo Electronico" value="{{ old('email') }}">
              @error('email')
              <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="text-danger">*</label>
              <label class="form-label">Dirección</label>
              <input type="text" name="direccion" class="form-control @error('direccion')is-invalid @enderror" placeholder="Dirección" value="{{ old('direccion') }}">
              @error('direccion')
              <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col">
              <a href="{{ route('personas') }}" type="button" class="btn btn-secondary">Regresar</a>
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