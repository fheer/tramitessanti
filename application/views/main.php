
<!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Tablero
            </h3>
          </div>
          <div class="row grid-margin">
            <div class="col-12">
              <div class="card card-statistics">
                <div class="card-body">
                  <?php
                  $ciU = &get_instance();
                  $ciU->load->model('Usuario_model');
                  $ciU->load->model('Persona_model');
                  $ciU->load->model('ProcesoTramite_model');
                  $cantidadUsuarios = $ciU->Usuario_model->getAllUsuarioCount();
                  $cantidadSolicitantes = $ciU->Persona_model->getSolicitanteCount();
                  $cantidadFuncionarios = $ciU->Persona_model->getFuncionarioCount();
                  $cantidadTramites = $ciU->ProcesoTramite_model->countAllProcesoTramite();
                  $cantidadTramitesFinalizados = $ciU->ProcesoTramite_model->countAllProcesoTramiteFinalizado();
                  $usuario = $ciU->Usuario_model->getUsuario($this->session->userdata('token'));
                  if (!empty($usuario)) {
                    $permisos = explode("#",$usuario['permisos']);
                    $espacios = count($permisos);
                  if ($espacios==7) {
                  ?>
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fa fa-user mr-2"></i>
                          Usuarios
                        </p>
                        <h2><?php echo $cantidadUsuarios; ?></h2>
                        <a href="<?php echo base_url();?>utente" class="badge badge-outline-success badge-pill">Ir...</a>
                      </div>
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                          Solicitantes
                        </p>
                        <h2><?php echo $cantidadSolicitantes; ?></h2>
                        <a href="<?php echo base_url();?>solicitante" class="badge badge-outline-success badge-pill">Ir...</a>
                      </div>
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fas fa-cloud-download-alt mr-2"></i>
                          Funcionarios
                        </p>
                        <h2><?php echo $cantidadFuncionarios; ?></h2>
                        <a href="<?php echo base_url();?>funcionario" class="badge badge-outline-success badge-pill">Ir...</a>
                      </div>
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fas fa-check-circle mr-2"></i>
                          Trámites en Curso
                        </p>
                        <h2><?php echo $cantidadTramites; ?></h2>
                        <a href="<?php echo base_url();?>proceso/lista/1" class="badge badge-outline-success badge-pill" target="_blank">Ir...</a>
                      </div>
                      
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fas fa-chart-line mr-2"></i>
                          Tramites Aprobados
                        </p>
                        <h2><?php echo $cantidadTramitesFinalizados; ?></h2>
                        <a href="<?php echo base_url();?>proceso/lista/2" class="badge badge-outline-success badge-pill" target="_blank">Ir...</a>
                      </div>
                  </div>
                  <a href="">
                    <a href="">
                  <?php }else{ ?>
                      <br><br>
                      <?php
                      if (!empty($persona)) {
                        ?>
                        <div class="page-header">
                          <nav aria-label="breadcrumb">
                            <div class="pull-right">
                              <h4><strong><?php echo 'Usuario: '. $persona['nombreCompleto']; ?></strong></h4>
                            </div>
                          </nav>
                        </div>
                      <?php } ?> 
                    </div>

                  <?php } ?>
                    <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr>
                    <th><font color="white">#</font></th>
                    <th><font color="white">N° de Tramite</font></th>
                    <th><font color="white">Tipo Trámite</font></th>
                    <th><font color="white">Fecha Inicio</font></th>
                    <th><font color="white">Fecha Fin</font></th>
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
                    //print_r($personatramite);
                    foreach ($personatramite as $row) {
                    $tramiteBuscar = $ciTInstance->Tramite_model->getTramite($row['idtramite']);
                    $tipotramite = $ciTInstance->TipoTramite_model->getTipoTramiteId($tramiteBuscar['idtipotramite']);
                    //echo $tramiteBuscar['idtipotramite'].'<br>';
                    $idpersona = $ciTInstance->Persona_model->getIdPersonaTramite($row['idtramite']);

                    //print_r($tramiteBuscar['fechaInicio']);
                    $originalDate = $tramiteBuscar['fechaInicio'];
                    $fechaInicio = date("d-m-Y", strtotime($originalDate));
                    $originalDate1 = $tramiteBuscar['fechaFin'];
                    $fechaFin = date("d-m-Y", strtotime($originalDate1));
                    
                  ?>
                  <tr>
                      <td align="center" ><font color="white"><?php echo $i; ?></font></td>
                      <td align="center"><font color="white"><?php echo $tramiteBuscar['codigo']; ?></font></td>
                      <td align="center"><font color="white"><?php echo $tipotramite['nombreRequisito']; ?></font></td>
                      <td align="center"><font color="white"><?php echo $fechaInicio; ?></font></td>
                      <td align="center"><font color="white"><?php echo $fechaFin; ?></td>
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
                            <li>
                              <a href="<?php echo base_url().'seguimiento/bitacora/'.$tramiteBuscar['idtramite']; ?>"
                              title="Imprimir Resumen" target="_blank">
                              &nbsp <i style="color:#555;" class="fa fa-edit"></i> Bitacora
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
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
      
        </div>
        <!-- content-wrapper ends -->