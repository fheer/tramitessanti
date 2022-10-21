<script type="text/javascript">
  function confirm_modal(id,activo)
  {
      var url = '<?php echo base_url() . "proceso/cambiar/" ;?>';
      $("#url-delete").attr('href', url+id+'/'+activo);
      jQuery('#modal-4').modal('show', {backdrop: 'static'});

  }
</script> 
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lista Tramites</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <?php echo form_open(base_url().'seguimiento/buscar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
      <div class="form-group" align="center">
          <label for="idactividad" class="col-sm-12 col-form-label">C.I.</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="ci" value="<?php echo $this->input->post('ci'); ?>">
            <span class="text-danger"><?php echo form_error('ci');?></span>
          </div>
          <div class="col-sm-3">

          </div>
          <br>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-primary mr-2">Buscar</button>
          </div>
          <?php
          if (!empty($tramite)) {
            foreach ($tramite as $row) {
              $idtramite = $row['idtramite'];
            }
            //print_r($idtramite);
          ?>
          <div class="page-header">
            <nav aria-label="breadcrumb">
              <div class="pull-right">
                <a href="<?php echo base_url();?>asignados/imprimir/<?php echo $idtramite; ?>" target="_blank" class="btn btn-info">
                <span class="fa fa-print" aria-hidden="true"></span> Imprimir Resumen</a>
              </div>
            </nav>
          </div>
          <?php } ?>
          <!--
           
          -->
          
      </div>
      <?php echo form_close(); ?>
        <div class="row">      
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>N° de Tramite</th>
                    <th>Solicitante</th>
                    <th>Funcionario</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Informe</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($tramite)) {
                  ?>
                  <?php $i = 1; 
                  $ciInstance = &get_instance();
                  $ciInstance->load->model("Persona_model");
                  $ciInstance->load->model("Cargo_model");
                  $ciInstance->load->model("Actividad_model");

                  foreach ($tramite  as $row) 
                  {
                    
                    $idsolicitante = $row['idpersona'];
                    $idfuncionario = $row['idfuncionario'];
                    
                    $funcionario = $ciInstance->Persona_model->getPersonaByIdfuncionario($idfuncionario);
                    //print_r($funcionario);
                    if ($funcionario['tipoPersona'] == 2) {
                      $cargo = $ciInstance->Cargo_model->getCargo($funcionario['idcargo']);
                    }else{
                      $cargo = $ciInstance->Actividad_model->sacaActividad($funcionario['idactividad']);
                    }
                    
                    ///*
                      $solicitante = $ciInstance->Persona_model->getPersonaId($idsolicitante);
                    //*/
                      //echo $idfuncionario;
                  ?>
                    <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td><?php echo $row['codigo'];?></td>
                      <td><?php echo $persona['nombreCompleto'];?></td>
                      <td><?php
                      if ($funcionario['tipoPersona']==2) {
                         echo $funcionario['nombreCompleto']. ' - ' . $cargo['cargo'];
                      }
                      ?>                      
                      </td>
                      <td><?php echo $row['fechaInicio']; ?></td>
                      <td><?php echo $row['fechaFin']; ?></td>
                      <td><a href="<?php echo base_url().'proceso/pdf/'.str_replace('.pdf', '', $row['pdf']); ?>" target="_blank"> <img src="<?php echo base_url();?>fotos/pdf.png"> </a></td>                          
                </tr>                       
                <?php $i++; } ?>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<!-- Modal -->
<div class="modal fade" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Esta seguro que quiere realizar esta operación?.
      </div>
      <div class="modal-footer">
        <a href="#" id="url-delete" class="btn btn-danger btn-sm"><i class="fa fa-check">&nbsp;</i>Aceptar</a>
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>