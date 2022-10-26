<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        <a href="<?php echo base_url(); ?>solicitante/nuevo/2" class="btn btn-success"><span class="fa fa-plus-circle" aria-hidden="true"></span> Nuevo Solicitante</a>
        <a href="<?php echo base_url(); ?>funcionario/nuevo/2" class="btn btn-primary"><span class="fa fa-plus-circle" aria-hidden="true"></span> Nuevo Funcionario</a>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Tramite</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <?php
          if (!empty($mensaje)) {
          ?>
            <div class="alert alert-danger">
             <?php echo $mensaje; ?>
           </div>
          <?php } ?>
        <!--vertical wizard-->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <form method="post" action="<?php echo base_url(); ?>proceso/guardar" enctype="multipart/form-data">
                  <div class="form-group row">
                    <label for="idtipotramite" class="col-sm-3 col-form-label">Tramite</label>
                    <div class="col-sm-5">
                      <select class="js-example-basic-single w-100" id="idtipotramite" name="idtipotramite">
                        <option value="0">Seleccione tramite</option>
                        <?php //foreach ($tipotramite as $row) { ?>
                          <option value="<?php echo $tipotramite['idtipotramite']; ?>"><?php echo $tipotramite['nombreRequisito']; ?></option>
                        <?php //} ?>
                      </select>
                      <span class="text-danger"><?php echo form_error('idtipotramite');?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fechaInicio" class="col-sm-3 col-form-label">Fecha de Inicio</label>

                    <div class="col-sm-2 input-group date datepicker">
                      <input type="text" name="fechaInicio" id="fechaInicio" class="form-control" value="<?php date_default_timezone_set("America/La_Paz"); echo date('d-m-Y');?>" readonly>
                      <span class="text-danger"><?php echo form_error('fechaInicio');?></span>
                    </div>
                    <label for="fechaFin" class="col-sm-3 col-form-label">Fecha Tentativa de Conclusión</label>

                    <div class="col-sm-2 input-group date datepicker">
                      <input type="text" name="fechaFin" id="fechaFin" readonly>
                      <span class="text-danger"><?php echo form_error('fechaFin');?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="idpersona" class="col-sm-3 col-form-label">Solicitante</label>
                    <div class="col-sm-4">
                      <select class="js-example-basic-single w-100" name="idpersona" id="idpersona">
                        <?php //foreach ($persona as $row) { ?>
                          <option value="<?php echo $persona['idpersona']; ?>"><?php echo $persona['nombreCompleto']; ?></option>
                        <?php //} ?>
                      </select>
                      <span class="text-danger"><?php echo form_error('idpersona');?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="idfuncionario" class="col-sm-3 col-form-label">Funcionario</label>
                    <div class="col-sm-5">
                      <select class="js-example-basic-single w-100" name="idfuncionario">
                        <?php foreach ($funcionario as $row) { 
                          if ($this->session->userdata('idusuario') != $row['idpersona']) {
                        ?>
                          <option value="<?php echo $row['idpersona']; ?>"><?php echo $row['nombreCompletofunncionario'].' - '.$row['cargo']; ?></option>
                        <?php } } ?> 
                      </select>
                      <span class="text-danger"><?php echo form_error('idfuncionario');?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="requisitos" class="col-sm-3 col-form-label">Requisitos</label>
                    <div class="col-sm-5" id="requisitos">
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="direccion" value="<?php echo $this->input->post('direccion'); ?>" placeholder="Zona, calle , número">
                      <span class="text-danger"><?php echo form_error('direccion');?></span>
                      <br>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="requisitos" class="col-sm-3 col-form-label">Mapa</label>
                    <div class="col-sm-9">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-body">
                                <div id="mapid"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <script src="<?php echo base_url();?>js/addmap.js"></script>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mapa" class="col-sm-3 col-form-label">Latitud</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="latitud" id="lat" value="<?php echo $this->input->post('latitud'); ?>" placeholder="Latitud" readonly> 
                      <span class="text-danger"><?php echo form_error('latitud');?></span>
                      <br>
                    </div>
                    <br>
                    <label for="mapa" class="col-sm-1 col-form-label">Longitud</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="longitud" id="lng" value="<?php echo $this->input->post('longitud'); ?>" placeholder="Longitud" readonly>
                      <span class="text-danger"><?php echo form_error('longitud');?></span>
                      <br>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                  <a href="<?php echo base_url().'proceso/lista'; ?>" class="btn btn-light">Cancelar</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--Fin vertical wizard-->
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
  var fecha = new Date();
  document.getElementById('idtipotramite').onchange = function() {
    /* Referencia al option seleccionado */
    var html = '';
    document.getElementById('requisitos').innerHTML = html;
    var mOption = this.options[this.selectedIndex];
    var mData = mOption.dataset;
      $.ajax({
        url: baseurl+"proceso/cargarrequisitos/" + this.value,
        method:"POST",
        success: function(data) {
          const parsedMessage = JSON.parse(data);
          for (var i = 0; i < parsedMessage.length; i++) {
            html += '<label class="form-check-label"><input type="checkbox" class="form-check-input" name="requisitos[]" value="'+ parsedMessage[i].nombreRequisito +'">'+ parsedMessage[i].nombreRequisito +' </label>';
            html += '<br><br>';
            html += '<input type="file" name="archivos[]">';
            html += '<br><br>';
          }
          document.getElementById('requisitos').innerHTML = html;
        }
      });
      $.ajax({
        url: baseurl+"proceso/sumardias/" + this.value,
        method:"POST",
        success: function(data) {
          const parsedData = JSON.parse(data);
          for (var i = 0; i < parsedData.length; i++) {
            var estimado = parseInt(parsedData[i].tiempoEstimado);
            var d = new Date();
            var sumaD = sumarDias(d, estimado);

          }
          var fecha = sumaD.toLocaleDateString();
          var newdate = fecha.split("-").reverse().join("-");
          document.getElementById('fechaFin').value = sumaD.toLocaleDateString();

        }
      });

      function sumarDias(fecha, dias){
        fecha.setDate(fecha.getDate() + dias);
        return fecha;
      }
    };
</script>
