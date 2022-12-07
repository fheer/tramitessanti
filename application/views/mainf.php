
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
                  //if ($espacios==7) {
                    $tipo = $this->session->userdata('tipo');
                    if ($tipo==2) {
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
                    
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
      
        </div>
        <!-- content-wrapper ends -->