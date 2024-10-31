<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.:. Iniciar Sesión .:.</title>
  @include('includes.styles')
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-danger">
      <a href="#" class="brand-link text-center">
        <img src="{{ asset('dist/img/BSNTS.png') }}" alt="Logo de AdminLTE" class="brand-image img-circle elevation-3" style="opacity: .8; max-width: 100px;">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
      </a>
      
      <div class="card-body">
        <form action="{{ route('login.action') }}" method="POST" class="user">
          @csrf
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="row mb-3">
            <div class="col">
              <label class="text-danger">*</label>
              <label class="form-label">Usuario</label>
              <div class="input-group">
                <input name="usuario" type="text" class="form-control form-control-user @error('usuario') is-invalid @enderror" id="exampleInputName" placeholder="Nombre de Usuario">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label class="text-danger">*</label>
              <label class="form-label">Contraseña</label>
              <div class="input-group">
                <input name="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Contraseña">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input name="remember" type="checkbox" id="remember">
                <label for="remember">Recuerdame</label>
              </div>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-warning btn-block">Acceder</button>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  @include('includes.scripts')
</body>

</html>
