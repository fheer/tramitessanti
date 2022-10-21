<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
            <h3 class="page-title">
              Perfil
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12">
              <?php
              if (!empty($mensaje)) {
                ?>
                <div class="alert alert-danger">
                 <?php echo $mensaje; 
                 if ($modificado==1) {
                   sleep(5);
                 redirect(base_url().'Welcome');
                 }
                 
                 ?>
               </div>
             <?php } ?>
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php if(!empty($usuario)){ echo base_url().'fotos/usuarios/'.$usuario['foto']; }?>" alt="Perfil" class="img-lg rounded-circle mb-3"/>
                        <div class="d-flex justify-content-between">
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8 pl-lg-5">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h3><?php if(!empty($persona)){ echo $persona['nombreCompleto'];} ?></h3>
                          <div class="d-flex align-items-center">
                            <h5 class="mb-0 mr-2 text-muted">
                              <?php 
                                if(!empty($actividad)){
                                  echo $actividad;
                                }
                              ?>
                            </h5>
                          </div>
                        </div>
                        <div>
                          <button class="btn btn-outline-secondary btn-icon">
                            <i class="far fa-envelope"></i>
                          </button>
                        </div>
                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav Perfil-navbar">                        
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <i class="fa fa-cogs"></i>
                              Opciones
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="profile-feed">
                        <div class="d-flex align-items-start profile-feed-item">
                          <?php echo form_open(base_url().'usuario/modificar/'.$this->session->userdata('idPersona'),array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
                          <button class="btn btn-primary btn-block">Modificar Datos Personales</button>
                          <?php echo form_close(); ?>
                        </div>
                        <div class="d-flex align-items-start profile-feed-item">
                          <?php echo form_open(base_url().'usuario/edit/'.$this->session->userdata('token'),array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
                          <button class="btn btn-dark btn-block">Modificar Datos de Usuario</button>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

  </div>
<!-- content-wrapper ends -->