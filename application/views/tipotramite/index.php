<script type="text/javascript">
  function confirm_modal(id,activo)
  {
      var url = '<?php echo base_url() . "nombretramite/eliminar/" ;?>';
      $("#url-delete").attr('href', url+id+'/'+activo);
      jQuery('#modal-4').modal('show', {backdrop: 'static'});

  }
</script> 
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        <a href="<?php echo  base_url();?>tipotramite/nuevo" class="btn btn-outline-info"><span class="fa fa-plus-circle" aria-hidden="true"></span> Nuevo Tipo Trámite</a>
        <a href="<?php echo base_url();?>imprimir/tipotramite" target="_blank" class="btn btn-outline-success">
          <span class="fa fa-print" aria-hidden="true"></span> Imprimir Lista</a>
        
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lista Tipo Tramites</li>
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
                    <th>Tipo Trámite</th>
                    <th>Descripción</th>
                    <th>Tiempo Estimado</th>
                    <th>Norma Legal</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  $ciInstance = &get_instance();
                  $ciInstance->load->model("NormaLegal_model");                       
                  foreach ($tipotramite  as $row) 
                  {
                    $normaLegal = $ciInstance->NormaLegal_model->getNormaLegal($row['idnormalegal']);
                  ?>
                    <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td><?php echo $row['nombre'];?></td>
                      <td><?php echo $row['descripcion'];?></td>
                      <td><?php echo $row['tiempoEstimado'];?></td>
                      <td><?php echo $normaLegal['normalegal']; ?></td>
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
                               <a href="<?php echo base_url().'tipotramite/editar/'.$row['slug']; ?>"
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
                               title="Eliminar Tipo Trámite" onClick="return confirm_modal(<?php echo $row['idtipotramite']; ?>,0)">
                                &nbsp <i style="color:red;" class="fa fa-exclamation-triangle"></i> Inactivo
                              </a>
                              <?php
                            }else{
                              ?>
                              <a href="#"
                               title="Eliminar Tipo Trámite" onClick="return confirm_modal(<?php echo $row['idtipotramite']; ?>,1)">
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
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
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