<!-- grafico -->
<?php
//print_r($grafico);
?>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Tipo de Trámites'],
      <?php 
      foreach ($grafico as $row) {
        echo "['" .$row['tipoTramite'].' -- Cantidad: '.$row['cantidad']."', " .$row['cantidad']."],";
      }
      ?>
      ]);

    var options = {
      title: 'Reporte por Tipo de Trámites'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);    

    document.getElementById('variable').value=chart.getImageURI();
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
                    <h4>Reporte por Tipo Trámites Gráfico</h4>
                    <br>
                    <h5>De: <?php echo $de; ?> Hasta: <?php echo $hasta; ?></h5>
                  </div>
                </div>
                <div class="card-body">
                  <div id="piechart" style="width: 100%; height: 500px;"></div>
                </div>
                <form action="<?php echo base_url();?>ProcesoTramite/reporteGraficoTipoPdf" method="post"> 
                  <input type="hidden" name="variable" id="variable" >
                  <input type="hidden" name="de"value="<?php echo $de; ?>" >
                  <input type="hidden" name="hasta" value="<?php echo $hasta; ?>">
                <div align="center">

                  <input type="submit" value="Ver" class="btn btn-success mt-5 mr-5 float-right"/>
                </div>
              </form>
            </div>            
          </div>
        </div>
      </div>
    </div>
</div>
<!-- content-wrapper ends -->