<!DOCTYPE html>
<html lang="resources/views/welcome.blade.php">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.:. Iniciar Sesión .:.</title>
  <title>{{ config('app.name') }}</title>
  @include('includes.styles')
</head>

<body class="hold-transition login-page">
  <div class="login-box"> <!-- /.login-logo -->
    <div class="card card-outline card-danger">
      <div class="card-header text-center">
        <a href="" class="h1"><b>Mober</b>'<b>s</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Iniciar sesión</p>
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
                <input name="usuario" type="text" class="form-control form-control-user @error('usuario')is-invalid @enderror" id="exampleInputName" placeholder="Nombre de Usuario">
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
                <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="exampleInputPassword" placeholder="Contraseña">
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