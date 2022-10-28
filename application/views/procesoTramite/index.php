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
        <?php if ($opcion==1) {
        ?>
        <a href="<?php echo base_url();?>imprimir/reporte-en-curso/1" target="_blank" class="btn btn-info">
          <span class="fa fa-print" aria-hidden="true"></span> Imprimir Lista Trámites en Curso</a>
        <?php }else{ ?>
          <a href="<?php echo base_url();?>imprimir/reporte-en-curso/2" target="_blank" class="btn btn-info">
          <span class="fa fa-print" aria-hidden="true"></span> Imprimir Lista Trámites Aprobados</a>
        <?php } ?>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lista Tramites</li>
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
                    <th>N° de Tramite</th>
                    <th>Solicitante</th>
                    <th>Funcionario</th>
                    <th>Fecha Inicio</th>
                    <th>Documentos Presentados</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i = 1;
                                    
                  foreach ($tramite  as $row) 
                  {
                    $ciInstance = &get_instance();
                    $ciInstance->load->model("Persona_model");
                    
                    $personatramite = $ciInstance->Persona_model->getPersonaTramite($row['idtramite']);

                    $idsolicitante = $personatramite['idpersonatramite'];
                    $usuario = $personatramite['idfuncionario'];

                    $solicitante = $ciInstance->Persona_model->getPersonaId($personatramite['idpersona']);
                    $usuario = $ciInstance->Persona_model->getPersonaByIdUsuario($personatramite['idfuncionario']);
                  ?>
                    <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td><?php echo $row['codigo'];?></td>
                      <td><?php echo $solicitante['nombreCompleto'];?></td>
                      <td><?php echo $usuario['nombreCompleto'];?></td>
                      <td><?php echo $row['fechaInicio']; ?></td>
                      <td><a href="<?php echo base_url().'proceso/requisitos/'.$row['idtramite']; ?>" target="_blank"> <img src="<?php echo base_url();?>fotos/jpg.png"> </a></td>
                      <td>
                        <?php 
                        if ($row['estado']==1) {
                          ?>
                          <span class='badge badge-warning badge-pill'>En curso</span>
                          <?php
                        }else{
                          ?>
                          <span class="badge badge-success badge-pill">Aprobado</span>
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
                               <a href="<?php echo base_url().'proceso/aggiornare/'.$row['key']; ?>/1"
                              title="Modificar informacion" onClick="">
                              &nbsp <i style="color:#555;" class="fa fa-edit"></i> Modificar
                            </a>                       
                              <?php } ?>
                          </li>
                          <li>
                            <?php 
                            if ($row['estado']==1) {
                              ?>
                              <a href="<?php echo base_url().'mapa/ver/'.$row['latitud'].'/'.$row['longitud']; ?>"
                              title="Localización" target="_blank">
                              &nbsp <i style="color:#0755E5;" class="fas fa-globe-americas"></i> Ver Mapa
                            </a>                       
                              <?php } ?>
                          </li>
                          <li>                          
                            <?php 
                            if ($row['estado']==1) {
                              ?>
                               <a href="#"
                               title="Estado Tramite" onClick="return confirm_modal(<?php echo $row['idtramite']; ?>,0)">
                                &nbsp <i style="color:green;" class="fa fa-exclamation-triangle"></i> Terminado
                              </a>
                              <?php
                            }?>
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