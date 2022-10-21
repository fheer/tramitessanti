<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">

      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tramite</li>
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

        <div class="card">
          <div class="card-body">
            <a href="<?php echo base_url();?>asignados/reporte2/<?php echo $tramite['idtramite']; ?>" target="_blank" class="btn btn-info">
          <span class="fa fa-print" aria-hidden="true"></span> Imprimir</a>
            <?php echo form_open(base_url().'asignado/guardar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
            <div class="form-group row">
              
              <input type="hidden" class="form-control" name="idpersonatramite" value="<?php echo $personatramite['idpersonatramite']; ?>">
              <input type="hidden" class="form-control" name="idtramite" value="<?php echo $tramite['idtramite']; ?>">
              <input type="hidden" class="form-control" name="idusuario" value="<?php echo $this->session->userdata('idusuario'); ?>">
              <input type="hidden" class="form-control" name="idpersona" value="<?php echo $personatramite['idpersona']; ?>">
              <label for="codigo" class="col-sm-2 col-form-label">Solicitante</label>
              <label for="" class="col-sm-3 col-form-label"><?php echo $persona['nombreCompleto'];?></label>            
            </div>
            <div class="form-group row">
              <label for="codigo" class="col-sm-2 col-form-label">Nº de Tramite</label>
              <label for="" class="col-sm-3 col-form-label"><?php echo $tramite['codigo'];?></label>  
            </div>
            <div class="form-group row"> 
              <label for="codigo" class="col-sm-2 col-form-label">Trámite</label>
              <label for="" class="col-sm-5 col-form-label"><?php echo $tipotramite['nombreRequisito'];?></label>
            </div>
            <div class="form-group row">
              <label for="idtipotramite" class="col-sm-2 col-form-label">Requisitos</label>
              <a href="<?php echo base_url().'proceso/requisitos/'.$tramite['idtramite']; ?>" target="_blank"> <img src="<?php echo base_url();?>fotos/jpg.png" width="70" height="80"> </a>
            </div>
            <div class="form-group row">
              <label for="idtipotramite" class="col-sm-2 col-form-label">Mensajes</label>
                <div class="col-sm-8">
                  <?php foreach ($observaciones as $row) { ?>
                    <label for="" class="col-sm-12 col-form-label"><?php echo $row['observaciones'];?></label>
                  <?php } ?>
                </div>
              
            </div>
            <div class="form-group row">
              <label for="idtipotramite" class="col-sm-2 col-form-label">Ubicación</label>
                <div class="col-sm-8">
                  <input type="hidden" id="latitud" value="<?php echo $tramite['latitud'];?>">
                  <input type="hidden" id="longitud" value="<?php echo $tramite['longitud'];?>">
                  <div id="mapview" disabled="disabled"></div>
                </div>
            </div>
            <script type="text/javascript">

              var latitud = document.getElementById("latitud").value;
              var longitud = document.getElementById("longitud").value;

              var map = L.map('mapview').setView([latitud, longitud], 18);

              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);

              L.marker([latitud, longitud]).addTo(map).openPopup();

              map.dragging.disable();
              map.touchZoom.disable();
              map.doubleClickZoom.disable();
              map.scrollWheelZoom.disable();
              map.boxZoom.disable();
              map.keyboard.disable();

            </script>
            <?php if ($this->session->userdata('tipo') == 2) { ?>
            <div class="form-group row">
              <label for="idtipotramite" class="col-sm-2 col-form-label">Informe</label>
              <div class="custom-file col-sm-8">
                <input type="file" name="userfile" id="userfile" >
              </div> 
            </div>
            <div class="form-group row">
              <label for="idtipotramite" class="col-sm-4 col-form-label">Observaciones</label>
              <textarea class="form-control" id="observaciones" name="observaciones" rows="4"><?php echo $this->input->post('observaciones'); ?></textarea>  
              <span class="text-danger"><?php echo form_error('observaciones');?></span>  
            </div>
            <div class="form-group row">            
              <div class="form-check form-check-success">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="accion" id="accion1" value="Si" checked>
                  Aprobado &nbsp;&nbsp;&nbsp;&nbsp;
                </label>
              </div>
              <div class="form-check form-check-danger">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="accion" id="accion2" value="No">
                  No &nbsp;&nbsp;&nbsp;&nbsp;
                </label>
              </div>
              <div class="form-check form-check-danger">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="accion" id="accion3" value="Terminado">
                  Terminado 
                </label>
              </div>
            </div>
            
            <script>
              window.addEventListener('load', init, false);
              function init() {
                let div = document.querySelector('#funcionario');
                div.style.visibility = 'visible';
                let boton2 = document.querySelector('#accion2');
                boton2.addEventListener('click', function (e) {
                  if(div.style.visibility === 'visible'){
                    div.style.visibility = 'hidden';
                  }
                }, false);
                let boton3 = document.querySelector('#accion3');
                boton3.addEventListener('click', function (e) {
                  if(div.style.visibility === 'visible'){
                    div.style.visibility = 'hidden';
                  }
                }, false);
                let boton1 = document.querySelector('#accion1');
                boton1.addEventListener('click', function (e) {
                  if(div.style.visibility === 'hidden'){
                    div.style.visibility = 'visible';
                  }
                }, false);
              }
            </script>
            <div class="form-group row" id="funcionario">
              <label for="idfuncionarioNew" class="col-sm-3 col-form-label">Funcionario</label>
              <div class="col-sm-5">
                <select class="js-example-basic-single w-100" name="idusuarioNew" id="idusuarioNew">
                  <?php foreach ($funcionario as $row) { ?>
                    <option value="<?php echo $row['idpersona']; ?>"><?php echo $row['nombreCompleto'].' - '.$row['cargo']; ?></option>
                  <?php } ?> 
                </select>
                <span class="text-danger"><?php echo form_error('idusuarioNew');?></span>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          <?php } ?>
            <a href="<?php echo base_url().'main'; ?>" class="btn btn-light">Cancelar</a>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- content-wrapper ends -->