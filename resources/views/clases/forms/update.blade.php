@extends('layouts.app')
@section('clase', 'active')
@section('titulo', 'Clases')
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
        <form action="{{ route('clases.update', ['id' => $clase->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="text-danger">*</label>
              <label class="form-label">Clasificación</label>
              <input type="text" name="clase" class="form-control @error('clase')is-invalid @enderror" placeholder="Nombre de la Clasificación" value="{{ old('clase',$clase->clase) }}">
              @error('clase')
              <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Descripcion</label>
              <input type="text" name="descripcion" class="form-control @error('descripcion')is-invalid @enderror" placeholder="Descripcion" value="{{ old('descripcion') }}" value="{{ $clase->clase }}">
              @error('descripcion')
              <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col">
              <a href="{{ route('clases') }}" type="button" class="btn btn-secondary">Regresar</a>
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