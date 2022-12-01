<!-- grafico -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php 
            /*
            foreach ($grafico as $row) {
              echo "['" .$row['nombre']."', " .$row['cantidad']."],";
            }
            */
          ?>

          ['Fecha', 'En curso', 'Finalizados'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          <?php 
            if ($situacion == 1) {
          ?>
          title: 'Trámites en curso',
          <?php }else {?>
            title: 'Trámites Finalizados',
          <?php }?>
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<!-- fin grafico -->
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reporte Graficos Trámites</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">

      <div class="col-12">
        <div class="row">      
          <div class="col-12">
            <div class="card">
              <div class="card-title">
                <div class="card-title">
                  <div align="center">
                    <br>
                    <h4>Reporte Trámites Gráfico</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div id="curve_chart" style="width: 900px; height: 500px"></div>
                </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
</div>
<!-- content-wrapper ends -->