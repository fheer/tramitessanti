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
          <li class="breadcrumb-item active" aria-current="page">Editar Tramite</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <!--vertical wizard-->
          <div class="row">
            <div class="col-12 ss">
              <div class="card">
                <div class="card-body">
                  <?php echo form_open(base_url().'proceso/aggiornare/editar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
                  <div class="form-group row">
                    <label for="fechaInicio" class="col-sm-3 col-form-label">Fecha Inicio</label>

                    <div class="col-sm-3 input-group date datepicker">
                      <input type="text" name="fechaInicio" value="<?php date_default_timezone_set("America/La_Paz"); echo $procesoTramite['fechaInicio'];?>" readonly>
                      <span class="text-danger"><?php echo form_error('fechaInicio');?></span>
                    </div>
                    <label for="fechaInicio" class="col-sm-1 col-form-label">Fecha Fin</label>
                    <div class="col-sm-3 input-group date datepicker">
                      <input type="date" name="fechaFin" value="<?php date_default_timezone_set("America/La_Paz"); echo $procesoTramite['fechaFin'];?>">
                      <span class="text-danger"><?php echo form_error('fechaFin');?></span>
                    </div>
                    <input type="hidden" name="idtramite" value="<?php echo $procesoTramite['idtramite'];?>">
                    <input type="hidden" name="codigo" value="<?php echo $procesoTramite['codigo'];?>">
                    <input type="hidden" name="idpersonatramite" value="<?php echo $personatramite['idpersonatramite'];?>">
                  </div>
                  <div class="form-group row">
                    <label for="idpersona" class="col-sm-3 col-form-label">Solicitante</label>
                    <div class="col-sm-4">
                      <select class="js-example-basic-single w-100" name="idpersona">
                        <option value="<?php echo $persona['idpersona']; ?>"><?php echo $persona['nombreCompleto']; ?></option>
                        <?php foreach ($solicitante as $row) { ?>
                          <option value="<?php echo $row['idpersona']; ?>"><?php echo $row['nombreCompleto']; ?></option>
                        <?php } ?> 
                      </select>
                      <span class="text-danger"><?php echo form_error('idpersona');?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="idtipotramite" class="col-sm-3 col-form-label">Tramite</label>
                    <div class="col-sm-5">
                      <select class="js-example-basic-single w-100" id="idtipotramite" name="idtipotramite">
                        <option value="<?php echo $nombretramite['idtipotramite']; ?>"><?php echo $nombretramite['nombreRequisito']; ?></option>
                        <option value="0">Seleccione tramite</option>
                        <?php foreach ($tipotramite as $row) { ?>
                          <option value="<?php echo $row['idtipotramite']; ?>"><?php echo $row['nombreRequisito']; ?></option>
                        <?php } ?> 
                      </select>
                      <span class="text-danger"><?php echo form_error('idtipotramite');?></span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="idfuncionario" class="col-sm-3 col-form-label">Funcionario</label>
                    <div class="col-sm-5">
                      <select class="js-example-basic-single w-100" name="idfuncionario">
                        <option value="<?php echo $unfuncionario['idpersona']; ?>"><?php echo $unfuncionario['nombreCompleto']; ?></option>
                        <?php foreach ($funcionario as $row) { ?>
                          <option value="<?php echo $row['idusuario']; ?>"><?php echo $row['nombreCompletofunncionario'].' - '.$row['cargo']; ?></option>
                        <?php } ?> 
                      </select>
                      <span class="text-danger"><?php echo form_error('idfuncionario');?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="requisitos" class="col-sm-3 col-form-label">Requisitos</label>
                    <div class="col-sm-5" id="requisitos">
                      <?php
                        $requisitos = explode("#",$procesoTramite['requisitos']);
                        foreach($requistosTramite as $rowRequisito)
                        {
                          if (!empty($rowRequisito['nombreRequisito'])) {
                              if (in_array($rowRequisito['nombreRequisito'], $requisitos)) {
                          $ci = &get_instance();
                          $ci->load->model("Requisito_model");
                          $ci->load->model("ProcesoTramite_model");
                          $idrequisito['idrequisito'] = $ci->Requisito_model->getRequisitoByNombreRequisito($rowRequisito['nombreRequisito']);
                          $imagen = $ci->ProcesoTramite_model->recuperarImages($procesoTramite['idtramite'],$idrequisito['idrequisito']['idrequisito']);
                      ?>
                      <label class="form-check-label"><input type="checkbox" class="form-check-input" name="requisitos[]" value="<?php echo $rowRequisito['nombreRequisito'];?>" checked><?php echo $rowRequisito['nombreRequisito'];?></label><br><br>
                      <img src="<?php echo base_url().'fotos/documentos/'.$imagen['ruta']; ?>" width="60" height="80"><br><br>
                      <input type="file" name="archivos[]">
                      <?php                              
                          }else{
                      ?>
                      <label class="form-check-label"><input type="checkbox" class="form-check-input" name="requisitos[]" value="<?php echo $rowRequisito['nombreRequisito'];?>"><?php echo $rowRequisito['nombreRequisito'];?></label><br><br>
                      <input type="file" name="archivos[]">
                      <?php        
                          }
                        }
                      }
                      ?>                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="direccion" value="<?php echo $procesoTramite['direccion']; ?>">
                      <span class="text-danger"><?php echo form_error('direccion');?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="requisitos" class="col-sm-3 col-form-label">Mapa</label>
                    <div class="col-sm-9">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12">
                              <div id="mapid"></div>                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mapa" class="col-sm-3 col-form-label">Latitud</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="latitud" id="lat" value="<?php echo $procesoTramite['latitud']; ?>" readonly>
                      <span class="text-danger"><?php echo form_error('latitud');?></span>
                      <br>
                    </div>
                    <br>
                    <label for="mapa" class="col-sm-1 col-form-label">Longitud</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="longitud" id="lng" value="<?php echo $procesoTramite['longitud']; ?>" readonly>
                      <span class="text-danger"><?php echo form_error('longitud');?></span>
                      <br>
                    </div>
                  </div>
                  <script src="<?php echo base_url();?>js/editmap.js"></script>


                  <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                  <a href="<?php echo base_url().'proceso/lista'; ?>" class="btn btn-light">Cancelar</a>
                  <?php echo form_close(); ?>
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
  document.getElementById('idtipotramite').onchange = function() {
    /* Referencia al option seleccionado */
    var html = '';
    document.getElementById('requisitos').innerHTML = html;
    var mOption = this.options[this.selectedIndex];
                      // Referencia a los atributos data de la opción seleccionada
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
                    };
</script>
<!-- content-wrapper ends -->

                 



