@extends('layouts.app')
@section('dashboard', 'active')
@section('titulo', 'Dashboard')
@section('contenido')
<section class="content">
  <!-- container-fluid -->
  <div class="container-fluid">
    <!-- Row 1: Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-2 col-md-6 col-sm-12">
        <!-- INGRESOS -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>INGRESOS</h3>
            <h3>{{ $totalIngresos }}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-arrow-down-c"></i>
            <i class="ion ion-arrow-down-c"></i>
            <i class="ion ion-arrow-down-c"></i>
          </div>
          <a href="{{ route('ingresos') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <!-- RECAUDADO -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>RECAUDADO</h3>
            <h3>+ S/.{{ $montoIngresos }}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
            <i class="ion ion-stats-bars"></i>
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer nav-link text-black disabled"><i><br></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-12">
        <!-- GASTOS -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>GASTOS</h3>
            <h3>{{ $totalGastos }}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-arrow-up-c"></i>
            <i class="ion ion-arrow-up-c"></i>
            <i class="ion ion-arrow-up-c"></i>
          </div>
          <a href="{{ route('gastos') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <!-- DESEMBOLSAR -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>DESEMBOLSAR</h3>
            <h3>- S/.{{ $montoGastos }}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
            <i class="ion ion-pie-graph"></i>
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer nav-link text-black disabled"><i><br></i></a>
        </div>
      </div>
      <div class="col-lg-2">
        <!-- MONTO NETO -->
        <div class="small-box text-white" style="background-color: seagreen">
          <div class="inner">
            <h3>MONTO NETO</h3>
            <h3>+ S/.{{ $operacion}}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
            <i class="ion ion-cash"></i>
            <i class="ion ion-cash"></i>
          </div>
          <a href="#" class="small-box-footer nav-link text-black disabled"><i><br></i></a>
        </div>
      </div>
    </div>
    <!-- Row 2: Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              ESTADISTICAS
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link disabled bg-success" href="#sales-chart" data-toggle="tab">+</a>
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Donut Chart -->
              <div class="chart tab-pane active" id="donut-chart" style="position: relative; height: 300px;">
                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>

      <!-- Right col -->
      <section class="col-lg-5 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              INGRESOS VS GASTOS
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link disabled bg-success" href="#sales-chart" data-toggle="tab">+</a>
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Donut Chart -->
              <div class="chart tab-pane active" id="donut-chart" style="position: relative; height: 300px;">
                <canvas id="donut-chart-canvas" height="300" style="height: 300px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>

    </div>
  </div>
  <!--/. container-fluid -->
</section>
@endsection