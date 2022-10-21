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
      <?php
          if (!empty($mensaje)) {
          ?>
            <div class="alert alert-danger">
             <?php echo $mensaje; ?>
           </div>
          <?php } ?>
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
          <br><br>
          <?php
          if (!empty($persona)) {
          ?>
          <div class="page-header">
            <nav aria-label="breadcrumb">
              <div class="pull-right">
                <h4><strong><?php echo 'Solicitante: '. $persona['nombreCompleto']; ?></strong></h4>
              </div>
            </nav>
          </div>
          <?php } ?> 
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
                    <th>Tipo Trámite</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($personatramite)) {
                  ?>
                  <?php
                    $ciTInstance = &get_instance();
                    $ciTInstance->load->model("Tramite_model");
                    $ciTInstance->load->model("Persona_model");
                    $ciTInstance->load->model("TipoTramite_model");
                    $i=1;
                    foreach ($personatramite as $row) {
                    $tramiteBuscar = $ciTInstance->Tramite_model->getTramite($personatramite['idtramite']);
                    $tipotramite = $ciTInstance->TipoTramite_model->getTipoTramiteId($tramiteBuscar['idtipotramite']);
                    //echo $tramiteBuscar['idtipotramite'].'<br>';
                    //print_r($tipotramite);
                    $idpersona = $ciTInstance->Persona_model->getIdPersonaTramite($personatramite['idtramite']);

                    //print_r($idpersona);
                    $originalDate = $tramite['fechaInicio'];
                    $fechaInicio = date("d-m-Y", strtotime($originalDate));
                    $originalDate1 = $tramite['fechaFin'];
                    $fechaFin = date("d-m-Y", strtotime($originalDate1));
                    
                  ?>
                  <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td align="center"><?php echo $tramite['codigo']; ?></td>
                      <td align="center"><?php echo $tipotramite['nombreRequisito']; ?></td>
                      <td align="center"><?php echo $fechaInicio; ?></td>
                      <td align="center"><?php echo $fechaFin; ?></td>
                      <td>
                        <span class="pull-right">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Acciones
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                            <li>
                              <a href="<?php echo base_url().'asignados/imprimir/'.$tramiteBuscar['idtramite']; ?>"
                              title="Imprimir Resumen" target="_blank">
                              &nbsp <i style="color:#555;" class="fa fa-edit"></i> Imprimir Resumen
                              </a>                       
                            </li>
                            <li>
                              <a href="<?php echo base_url().'seguimiento/hoja/'.$idpersona.'/'.$tramiteBuscar['idtramite']; ?>"
                              title="Imprimir Resumen" target="_blank">
                              &nbsp <i style="color:#555;" class="fa fa-edit"></i> Seguimiento
                              </a>                       
                            </li>
                        </ul>
                      </div>
                    </span>
                  </td> 
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