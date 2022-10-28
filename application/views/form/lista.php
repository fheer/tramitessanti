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
      <div class="pull-right">
        <!--<a href="<?php echo base_url();?>imprimir/procesotramite" target="_blank" class="btn btn-info">
          <span class="fa fa-print" aria-hidden="true"></span> Imprimir Lista</a>
         -->
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Solicitud de Trámite</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">

      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Solicitante</th>
                    <th>Trámite</th>
                    <th>Fecha Solicitud</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($solicitud  as $row)
                  {
                    $ciInstance = &get_instance();
                    $ciInstance->load->model("Persona_model");
                    $ciInstance->load->model("TipoTramite_model");

                    $solicitante = $ciInstance->Persona_model->getPersonaId($row['idpersona']);
                    $tipotramite = $this->TipoTramite_model->getTipoTramiteId($row['idtipotramite']);
                    $newDate = date("d-m-Y", strtotime($row['fecha']));
                  ?>
                    <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td><?php echo $solicitante['nombreCompleto'];?></td>
                      <td><?php echo $tipotramite['nombreRequisito'];?></td>
                      <td><?php echo $newDate; ?></td>
                      <td>
                        <?php
                        if ($row['estado']==1) {
                          ?>
                          <span class='badge badge-success badge-pill'>En curso</span>
                        <?php
                        }
                        ?>
                      </td>
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
                            <?php
                            if ($row['estado']==1) {
                            ?>
                               <a href="<?php echo base_url().'proceso/nuevo-tramite/'.$row['idtipotramite']; ?>/<?php echo $row['idpersona']?>/<?php echo $row['iddatotecnico']?>"
                              title="Modificar informacion" onClick="">
                              &nbsp <i style="color:555;" class="fa fa-plus-circle"></i> Iniciar Trámite
                            </a>
                              <?php } ?>
                          </li>
                        </ul>
                      </div>
                    </span>
                  </td>
                </tr>
                <?php $i++; } ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Cambiar de Estado</h5>
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