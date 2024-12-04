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
          </div>
          <a href="#" class="small-box-footer nav-link text-black disabled"><i><br></i></a>
        </div>
      </div>
      <div class="col-lg-2">
        <!-- MONTO NETO -->
        <div class="small-box text-white" style="background-color: seagreen">
          <div class="inner">
            <h3>MONTO NETO</h3>
            <h3>+ S/.{{ $operacion }}</h3>
          </div>
          <div class="icon">
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
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Bar Chart -->
              <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 300px;">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Datos para el gráfico de barras
  var ctx = document.getElementById('barChart').getContext('2d');
  var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['INGRESOS', 'RECAUDADO', 'GASTOS', 'DESEMBOLSAR', 'MONTO NETO'],
      datasets: [{
        label: 'S/. (Monto)',
        data: [
          {{ $totalIngresos }},  // Monto total de INGRESOS
          {{ $montoIngresos }},  // Monto RECAUDADO
          {{ $totalGastos }},    // Monto total de GASTOS
          {{ $montoGastos }},    // Monto DESEMBOLSAR
          {{ $operacion }}       // Monto NETO
        ],
        backgroundColor: [
          'rgba(0, 123, 255, 0.5)', // INGRESOS
          'rgba(40, 167, 69, 0.5)', // RECAUDADO
          'rgba(255, 193, 7, 0.5)', // GASTOS
          'rgba(220, 53, 69, 0.5)', // DESEMBOLSAR
          'rgba(40, 167, 69, 0.7)', // MONTO NETO
        ],
        borderColor: [
          'rgba(0, 123, 255, 1)',
          'rgba(40, 167, 69, 1)',
          'rgba(255, 193, 7, 1)',
          'rgba(220, 53, 69, 1)',
          'rgba(40, 167, 69, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'S/. ' + value.toLocaleString();  // Formatear valores en soles
            }
          }
        }
      }
    }
  });

  // Datos para el gráfico de torta (Ingresos vs Gastos)
  var ingresos = {{ $totalIngresos }};
  var gastos = {{ $totalGastos }};
  var total = ingresos + gastos;
  var ctxDonut = document.getElementById('donut-chart-canvas').getContext('2d');

  var donutChart = new Chart(ctxDonut, {
    type: 'doughnut',
    data: {
      labels: ['INGRESOS', 'GASTOS'],
      datasets: [{
        data: [ingresos, gastos],
        backgroundColor: ['#007bff', '#ffcc00'], // Colores contrastantes para mejor visibilidad
        borderColor: ['#0056b3', '#e0a800'], // Bordes oscuros para el contraste
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              var percentage = Math.round(tooltipItem.raw / total * 100);
              return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString() + ' ( ' + percentage + '% )';
            }
          }
        },
        datalabels: {
          display: true,
          color: '#fff',
          formatter: function(value, context) {
            var percentage = Math.round(value / total * 100);
            return percentage + '%'; // Mostrar porcentaje directamente
          },
          font: {
            weight: 'bold',
            size: 16 // Tamaño de fuente mayor para mejor legibilidad
          }
        }
      }
    }
  });
</script>

@endsection