<script type="text/javascript">
  function confirm_modal(id,activo)
  {
    var url = '<?php echo base_url() . "predio/eliminar/" ;?>';
    $("#url-delete").attr('href', url+id+'/'+activo);
    jQuery('#modal-4').modal('show', {backdrop: 'static'});
  }
</script>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        <a href="<?php echo base_url(); ?>predio/nuevo" class="btn btn-success"><span class="fa fa-plus-circle" aria-hidden="true"></span> Nuevo Datos Predio</a>
        <a href="<?php echo base_url();?>imprimir/predio" target="_blank" class="btn btn-info">
          <span class="fa fa-print" aria-hidden="true"></span> Imprimir Lista</a>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lista Predios</li>
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
                    <th>Propietario</th>
                    <th>Codigo Catastral</th>
                    <th>Nº Trámite</th>
                    <th>Croquis</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  $ci = &get_instance();
                  $ci->load->model("Persona_model");
                  $ci->load->model("Tramite_model");
                  $ci->load->model("PersonaTramite_model");
                  foreach ($predio  as $row) {
                    //$tramite= $ci->Tramite_model->getTramite($row['idtramite']);
                    //$personatramite= $ci->PersonaTramite_model->getPersonaTramite($row['idtramite']);
                  ?>
                    <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td><?php echo $row['solicitante'];?></td>
                      <td><?php echo $row['codigocatastral'];?></td>
                      <td><?php echo $row['codigotramite'];?></td>
                      <td><img src="<?php echo base_url().'fotos/datostecnicos/'.$row['croquis'];?>" width="80" height="100"></td>
                      <td>
                        <?php
                        if ($row['estado']==1) {
                          ?>
                          <span class='badge badge-success badge-pill'>Activo</span>
                          <?php
                        }else{
                          ?>
                          <span class="badge badge-warning badge-pill">Inactivo</span>
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
                               <a href="<?php echo base_url().'predio/editar/'.$row['idpredio']; ?>"
                              title="Modificar informacion" onClick="">
                              &nbsp <i style="color:#555;" class="fa fa-edit"></i> Modificar
                            </a>
                              <?php } ?>
                          </li>
                          <li>
                            <?php
                            if ($row['estado']==1) {
                              ?>
                               <a href="#"
                               title="Estado Requisito" onClick="return confirm_modal(<?php echo $row['idpredio']; ?>,0)">
                                &nbsp <i style="color:red;" class="fa fa-exclamation-triangle"></i> Inactivo
                              </a>
                              <?php
                            }else{
                              ?>
                              <a href="#"
                               title="Estado Requisito" onClick="return confirm_modal(<?php echo $row['idpredio']; ?>,1)">
                                &nbsp <i style="color:green;" class="fa fa-exclamation-triangle"></i> Activo
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
        <h5 class="modal-title" id="exampleModalLabel">Requisito</h5>
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