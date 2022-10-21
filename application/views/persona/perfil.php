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
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php echo base_url().'fotos/usuarios/'.$usuario['foto']; ?>" alt="Perfil" class="img-lg rounded-circle mb-3"/>
                        <div class="d-flex justify-content-between">
                          <button class="btn btn-primary btn-block">Modificar Datos Personales</button>
                        </div>
                      </div>
                      <button class="btn btn-dark btn-block">Modificar Datos de Usuario</button>
                    </div>
                    <div class="col-lg-8 pl-lg-5">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h3><?php echo $persona['nombreCompleto'] ?></h3>
                          <div class="d-flex align-items-center">
                            <h5 class="mb-0 mr-2 text-muted">
                              <?php 
                                echo $actividad;
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
                              <i class="fa fa-copy"></i>
                              Tramites
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="Perfil-feed">
                        <div class="d-flex align-items-start Perfil-feed-item">
                          <img src="../../images/faces/face13.jpg" alt="Perfil" class="img-sm rounded-circle"/>
                          <div class="ml-4">
                            <h6>
                              Mason Beck
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <p>
                              There is no better advertisement campaign that is low cost and also successful at the same time.
                            </p>
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start Perfil-feed-item">
                          <img src="../../images/faces/face16.jpg" alt="Perfil" class="img-sm rounded-circle"/>
                          <div class="ml-4">
                            <h6>
                              Willie Stanley
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <img src="../../images/samples/1280x768/12.jpg" alt="sample" class="rounded mw-100"/>                            
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start Perfil-feed-item">
                          <img src="../../images/faces/face19.html" alt="Perfil" class="img-sm rounded-circle"/>
                          <div class="ml-4">
                            <h6>
                              Dylan Silva
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <p>
                              When I first got into the online advertising business, I was looking for the magical combination 
                              that would put my website into the top search engine rankings
                            </p>
                            <img src="../../images/samples/1280x768/5.jpg" alt="sample" class="rounded mw-100"/>                                                        
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
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